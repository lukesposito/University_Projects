#include "executive.h"
#include <iostream>

#include "busy_wait.h"

void task0()
{
	std::cout << "Sono il task n.0" << std::endl;
	busy_wait(190);
}

void task1()
{
	std::cout << "Sono il task n.1" << std::endl;
	busy_wait(185);
}
void task2()
{
	std::cout << "Sono il task n.2" << std::endl;
	busy_wait(88);
}

void task3()
{
	std::cout << "Sono il task n.3" << std::endl;
	busy_wait(270);
}

void task4()
{
	std::cout << "Sono il task n.4" << std::endl;
	busy_wait(80);
}

int main()
{
	Executive exec(5, 4, 100); //5 è il numero di frame, 4 è la lunghezza di ogni frame mentre 100 è la dimensione del quanto temporale cioè iperperiodo H

	exec.set_periodic_task(0, task0, 1); // tau_1
	exec.set_periodic_task(1, task1, 2); // tau_2
	exec.set_periodic_task(2, task2, 1); // tau_3,1
	exec.set_periodic_task(3, task3, 3); // tau_3,2
	exec.set_periodic_task(4, task4, 1); // tau_3,3
	
	exec.add_frame({0,1,2}); //in questo frame eseguo prima tau_0 poi tau_1 e poi tau_2
	exec.add_frame({0,3});
	exec.add_frame({0,1});
	exec.add_frame({0,1});
	exec.add_frame({0,1,4});
	
	exec.start();
	exec.wait();
	
	return 0;
}
