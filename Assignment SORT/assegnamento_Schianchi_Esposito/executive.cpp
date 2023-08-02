//MATRICOLE: Schianchi Giovanni 352863     Esposito Luca 353830

#include <cassert>
#include <iostream>
#include <mutex>
#include <condition_variable>
#include "rt/priority.h"
#include "rt/affinity.h"
#include <chrono>

#define VERBOSE

#include "executive.h"


Executive::Executive(size_t num_tasks, unsigned int frame_length, unsigned int unit_duration)
	: p_tasks(num_tasks), frame_length(frame_length), unit_time(unit_duration), vecState(num_tasks), deadlines(p_tasks.size(), false)
{
}

void Executive::set_periodic_task(size_t task_id, std::function<void()> periodic_task, unsigned int wcet)
{
	assert(task_id < p_tasks.size()); // Fallisce in caso di task_id non corretto (fuori range)
	
	p_tasks[task_id].function = periodic_task;
	p_tasks[task_id].wcet = wcet;
	p_tasks[task_id].id = task_id;
	p_tasks[task_id].stat.max_exec_time = 0.0;
	p_tasks[task_id].stat.avg_exec_time = 0.0;
	
	vecState[task_id].task_id = task_id;
	vecState[task_id].cycle_id = 0;
	
	vecState[task_id].canc_count = 0;
	vecState[task_id].miss_count = 0;
	vecState[task_id].exec_count = 0;
	
	vecState[task_id].avg_exec_time = 0.0;
	vecState[task_id].max_exec_time = 0.0;
	

}
		
void Executive::add_frame(std::vector<size_t> frame)
{
	for (auto & id: frame)
		assert(id < p_tasks.size()); // Fallisce in caso di task_id non corretto (fuori range)
	
	frames.push_back(frame);

	/* ... */
}

void Executive::start()
{
	
	rt::affinity affinity("1");
	
	for (size_t id = 0; id < p_tasks.size(); ++id)
	{
		assert(p_tasks[id].function); // Fallisce se set_periodic_task() non e' stato invocato per questo id
		
		p_tasks[id].thread = std::thread(&Executive::task_function, std::ref(p_tasks[id]));
		rt::set_affinity(p_tasks[id].thread , affinity);
		
		/* ... */
	}
	
	exec_thread = std::thread(&Executive::exec_function, this);
	rt::set_priority(exec_thread , rt::priority::rt_max); //imposto  la priorità massima per exec_thread, va messa MAX e non p
	rt::set_affinity(exec_thread, affinity);
	/* ... */

	if (stats_observer){
		stats_thread = std::thread(&Executive::stats_function, this);
	}
		
}
	
void Executive::wait()
{
	if (stats_thread.joinable())
		stats_thread.join();

	exec_thread.join();
	
	for (auto & pt: p_tasks)
		pt.thread.join();
}

void Executive::task_function(Executive::task_data & task)
{
	while (true) {				
		{
			std::unique_lock<std::mutex> lock(task.mutex);
			
			if(task.state != task_state::PENDING)
				task.state = task_state::IDLE;
				
				
			// Il task attende la ricezione di una notify_one per essere posto in esecuzione
			while(task.state != task_state::PENDING)
				task.cond_var.wait(lock);

			// Una volta giunto a questo punto, il task puo' essere posto in esecuzione
			task.state = task_state::RUNNING;

		}
		
		// Eseguiamo quindi la funzione associata al task
		auto tempoFrameInit = std::chrono::steady_clock::now();
		
		task.function();
		
		auto tempoFrameFinal = std::chrono::steady_clock::now();
		
		
		std::chrono::duration<double, std::milli> elapsed(tempoFrameFinal - tempoFrameInit);
		
		task.stat.avg_exec_time += elapsed.count();
					
		if(task.stat.max_exec_time == 0)
			task.stat.max_exec_time = elapsed.count();
					
		if(elapsed.count() > task.stat.max_exec_time)
			task.stat.max_exec_time = elapsed.count();
		
	}
}

void Executive::exec_function()
{
	/* Frame corrente */
	frame_id = 0;
	
	unsigned int hyperperiod_id = 0;
	

	/* ... */
	
	rt::priority p(rt::priority::rt_max);
	rt::affinity aff("1");
	
	/* Istante assoluto che indica il prossimo risveglio dell'executive */
	auto wakeup = std::chrono::steady_clock::now(); 
	
	while (true)
	{
		
#ifdef VERBOSE
		std::cout << "*** Frame n." << frame_id << (frame_id == 0 ? " ******" : "") << std::endl;
#endif


	    --p;
		
		
		/* Rilascio dei task periodici del frame corrente ... */
		for(size_t numTask = 0; numTask < (frames[frame_id]).size(); ++numTask){
			
			{
				size_t task_id = (frames[frame_id])[numTask];

				if(deadlines[task_id]) {
					vecState[task_id].canc_count++;
					deadlines[task_id] = false; // reset della deadline miss (ovvero permetto successive esecuzioni)
					std::cerr << "Task " << task_id <<": non eseguito perche avvenuta una miss in precedenza" << std::endl;
				}
				else{
					
					std::unique_lock<std::mutex> lock(p_tasks[frames[frame_id][numTask]].mutex);
					
					p_tasks[frames[frame_id][numTask]].state = task_state :: PENDING;

					try
					{
						rt::set_priority(p_tasks[frames[frame_id][numTask]].thread , p);
						--p;
					}
					catch (rt::permission_error & e) {
						std::cerr << "Errore nel setting delle priorita : " << e.what() << std::endl;
						for(unsigned int i = 0; i < p_tasks.size(); ++i) 
							p_tasks[i].thread.detach();
						abort();
					}
					p_tasks[frames[frame_id][numTask]].cond_var.notify_one();
				}
				
			}
			
		}
		
		/* Attesa fino al prossimo inizio frame ... */

		/* Calcolo il nuovo istante assoluto di risveglio dell'executive */
		wakeup += std::chrono::milliseconds((unit_time) * (frame_length));

		/* Attesa assoluta, tale da non pregiudicare la precisione, fino al prossimo inizio frame */
		std::this_thread::sleep_until(wakeup);
		
		for(size_t numTask1 = 0; numTask1 < frames[frame_id].size(); ++numTask1){

			size_t task_id = (frames[frame_id])[numTask1];

			{

				std::unique_lock<std::mutex> lock(p_tasks[frames[frame_id][numTask1]].mutex);

				if ( p_tasks[frames[frame_id][numTask1]].state == task_state :: RUNNING){

					std::cerr << "*** Task " << task_id << ": deadline miss" << std::endl;

					vecState[task_id].miss_count++;
					deadlines[task_id] = true;
				
					p_tasks[frames[frame_id][numTask1]].state = task_state :: MISS;

					try {
						rt::set_priority(p_tasks[frames[frame_id][numTask1]].thread , rt::priority::rt_min);
					}
						
					catch (rt::permission_error & e) {
						std::cerr << " Errore nel setting della priorita " << e.what() << std::endl;
						for(unsigned int i = 0; i < p_tasks.size(); ++i) 
							p_tasks[i].thread.detach();
						abort();
					}
									
				}
				else if(p_tasks[frames[frame_id][numTask1]].state == task_state :: PENDING){
					
					std::cerr << "*** Task " << task_id << ": non eseguito perche avvenuta una miss" << std::endl;
		
					
					p_tasks[frames[frame_id][numTask1]].state = task_state :: IDLE;
					
				}

				else{
					
					std::cout << "num task : "  << task_id << std::endl;
					vecState[task_id].exec_count++;
					
					std::cout << "task num :" << numTask1 << std::endl;
					
						
				}
			}
			
			if(vecState[task_id].exec_count > 0)
				vecState[task_id].avg_exec_time = p_tasks[frames[frame_id][numTask1]].stat.avg_exec_time / vecState[task_id].exec_count;
			else
				vecState[task_id].avg_exec_time = 0;
			
			vecState[task_id].max_exec_time = p_tasks[frames[frame_id][numTask1]].stat.max_exec_time;
			
		}
		
		
		if (++frame_id == frames.size())
		{
			++hyperperiod_id;
			
			std::cout << "--------- Inizio iperperiodo : " << hyperperiod_id << " ------------" << std::endl;
			
			++glob.cycle_count;			

			for(int i=0; i < vecState.size(); i++){

				vecState[i].cycle_id++;
				
				glob.exec_count += vecState[i].exec_count;
				glob.miss_count += vecState[i].miss_count;
				glob.canc_count += vecState[i].canc_count;

				{
					std::unique_lock<std::mutex> lock(mutexBuffer);
					
					buffer.push_back(vecState[i]);

					if(!buffer.empty())
						cond.notify_all();
				}

				vecState[i].exec_count = 0;
				vecState[i].miss_count = 0;
				vecState[i].canc_count = 0;
				vecState[i].avg_exec_time = 0.0;
				vecState[i].max_exec_time = 0.0;
				
				
				p_tasks[i].stat.avg_exec_time = 0.0;
			    p_tasks[i].stat.max_exec_time = 0.0;
				
			}			
			
			frame_id = 0;
			
		}
	}
}

void Executive::set_stats_observer(std::function<void(task_stats const &)> obs)
{
	stats_observer = obs;
}



global_stats Executive::get_global_stats()
{
	
	std::unique_lock<std::mutex> lock(mutexBuffer);
	
	return glob;
	
}

void Executive::stats_function()
{
	while (true)
	{
		{
			task_stats st;
			
			std::unique_lock<std::mutex> lock(mutexBuffer);

			while( buffer.empty() )
				cond.wait(lock);

			st = buffer.front();
			
			buffer.pop_front();
			
			if(stats_observer)
				stats_observer(st);
			
		}
	}
	
}

