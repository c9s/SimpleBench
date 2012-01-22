<?php
/** 
 * TaskTimer usage:
 *
 *   $tasks = array();
 *
 *   $timer = new SimpleBench\Task;
 *   $timer->start('task name');
 *
 *   $tasks[] = $timer->end('task name');
 *
 *   $task->printReport();
 *
 * Comparision:
 *
 *   $bench = new SimpleBench;
 *   $benchResult = $bench->compare( $task1 , $task2 , $task3 );
 *   $benchResult->toXml();
 *   $benchResult->toJson();
 *   $benchResult->toGraph();
 *
 */
class SimpleBench 
{
    public $tasks = array();
    public $stacks = array();

    public function start( $taskname = 'default' )
    {
        $task = new SimpleBench\Task( $taskname );
        $this->stacks[] = $task;

        if( isset( $this->tasks[ $taskname ] ) ) {
            throw Exception("Task $taskname is already defined.");
        }
        $this->tasks[ $taskname ] = $task;
        $task->start();
        return $task;
    }

    public function end($taskname = 'default')
    {
        $task = $this->tasks[ $taskname ];
        $task->end();
        return $task;
    }

    public function getTasks()
    {
        return $this->tasks;
    }

    public function compare()
    {
        $tasks = func_get_args();
        $comparison = new SimpleBench\ComparisonMatrix( $tasks );
        $comparison->compare();
        return $comparison;
    }

}
