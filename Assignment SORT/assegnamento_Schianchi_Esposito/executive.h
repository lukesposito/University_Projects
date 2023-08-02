//MATRICOLE: Schianchi Giovanni 352863     Esposito Luca 353830

#ifndef EXECUTIVE_H
#define EXECUTIVE_H

#include <vector>
#include <functional>
#include <chrono>
#include <mutex>
#include <condition_variable>
#include <thread>
#include <deque>


#include "statistics.h"

class Executive
{
	public:
		/* [INIT] Inizializza l'executive, impostando i parametri di scheduling:
			num_tasks: numero totale di task presenti nello schedule;
			frame_length: lunghezza del frame (in quanti temporali);
			unit_duration: durata dell'unita di tempo, in millisecondi (default 10ms).
		*/
		Executive(size_t num_tasks, unsigned int frame_length, unsigned int unit_duration = 10);

		/* [INIT] Imposta il task periodico di indice "task_id" (da invocare durante la creazione dello schedule):
			task_id: indice progressivo del task, nel range [0, num_tasks);
			periodic_task: funzione da eseguire al rilascio del task;
			wcet: tempo di esecuzione di caso peggiore (in quanti temporali).
		*/
		void set_periodic_task(size_t task_id, std::function<void()> periodic_task, unsigned int wcet);
		
		/* [INIT] Lista di task da eseguire in un dato frame (da invocare durante la creazione dello schedule):
			frame: lista degli id corrispondenti ai task da eseguire nel frame, in sequenza
		*/
		void add_frame(std::vector<size_t> frame);
		
		
		/* [STAT] Imposta la funzione da eseguire quanto è pronta una nuova statistica per un task */
		void set_stats_observer(std::function<void(const task_stats &)> obs);
		
		/* [STAT] Ritorna la statistica di funzionamento globale dell'applicazione */
		global_stats get_global_stats();
		

		/* [RUN] Lancia l'applicazione */
		void start();

		/* [RUN] Attende (all'infinito) finchè gira l'applicazione */
		void wait();

	private:
	
	    std::mutex mutexBuffer;
	    
	    std::condition_variable cond;
	
		std::deque<task_stats> buffer;
	
		global_stats glob;
		
		std::vector<task_stats> vecState;
	
		enum task_state {RUNNING, PENDING, MISS , IDLE};
		
		unsigned int frame_id;
	
		struct task_data
		{
			std::function<void()> function;

			unsigned int wcet;

			std::thread thread;
			
			std::mutex mutex;

			std::condition_variable cond_var;
			
			unsigned int id;
			
			std::chrono::steady_clock::time_point deadline;

			task_state state = task_state::IDLE;
			
			task_stats stat;
			
			/* ... */
		};
		
		std::vector<task_data> p_tasks;
		
		std::thread exec_thread;
		
		std::vector< std::vector<size_t> > frames;
		
		const unsigned int frame_length; // lunghezza del frame (in quanti temporali)
		const std::chrono::milliseconds unit_time; // durata dell'unita di tempo (quanto temporale)
		
		/* ... */

		/* Mantengo un vettore di booleani, in cui deadlines[i] = true indica che il task i-esimo ha subìto una deadline miss 
		   Inizializzo il vettore con n valori false, dove n = p_tasks.size() */
		std::vector<bool> deadlines;
		
		static void task_function(task_data & task);
		
		void exec_function();
		
		// statistiche ......

		std::function<void(const task_stats &)> stats_observer;
		std::thread stats_thread;
		void stats_function();

		/* ... */
};

#endif
