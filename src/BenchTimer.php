<?php
/** 
 * TaskTimer usage:
 *
 *   $tasks = array();
 *
 *   $timer = new TaskTimer;
 *   $timer->start('task name');
 *
 *   $tasks[] = $timer->end('task name');
 *
 *   $task->printReport();
 *
 * Comparision:
 *
 *   $bench = new SimpleBenchmark;
 *   $benchResult = $bench->compare( $task1 , $task2 , $task3 );
 *   $benchResult->toXml();
 *   $benchResult->toJson();
 *   $benchResult->toGraph();
 *
 */
class BenchTimer 
{
    public $tasks = array();
    public $stacks = array();

    public function start( $taskname = 'default' )
    {
        $task = new BenchTimer\Task( $taskname );
        $this->stacks[] = $task;

        if( isset( $this->tasks[ $taskname ] ) ) {
            throw Exception("Task $taskname is already defined.");
        }
        $this->tasks[ $taskname ] = $task;
    }

    public function end($taskname = 'default')
    {
        $task = $this->tasks[ $taskname ];
        $task->end();
        return $task;
    }

    public function compare()
    {
        $args = func_get_args();

    }

}
