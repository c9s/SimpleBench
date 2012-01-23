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

    private $optionGc = false;
    private $info;

    function __construct($options = array())
    {

        /**
         * @see http://www.php.net/manual/en/features.gc.collecting-cycles.php
         * @see http://php.net/manual/en/features.gc.collecting-cycles.php
         * @see http://www.php.net/manual/en/function.gc-collect-cycles.php
         */
        if( isset($options['gc']) )
            $this->optionGc = $options['gc'];
    }


    /**
     * Aggregate system information for different platform 
     */
    public function aggregateSystemInfo()
    {
        $infoClass = '\\SimpleBench\\SystemInfo\\' . PHP_OS;
        spl_autoload_call( $infoClass );
        if( class_exists($infoClass) )
            $this->info = $infoClass::getInfo();
    }

    /**
     * set use-case title
     *
     * @param string $title
     *
     */
    public function setTitle($title)
    {
        return $this->title = $title;
    }


    /**
     * start a task to test the benchmark of solution 
     *
     * @param string $taskname 
     * @return SimpleBench\Task
     */
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


    /**
     * end up a task
     *
     * @param string $taskname
     * @return SimpleBench\Task
     */
    public function end($taskname = 'default')
    {
        $task = $this->tasks[ $taskname ];
        $task->end();

        if( $this->optionGc ) {
            gc_collect_cycles();
        }
        return $task;
    }

    /**
     * get all tasks
     *
     * @return SimpleBench\Task[]
     */
    public function getTasks()
    {
        return $this->tasks;
    }


    /**
     * compare tasks
     *
     * @param SimpleBench\Task ...
     * @return SimpleBench\ComparisonMatrix
     */
    public function compare()
    {
        $tasks = func_get_args();
        if( empty($tasks) )
            $tasks = array_values($this->tasks);

        $comparison = new SimpleBench\ComparisonMatrix( $tasks );
        $comparison->compare();
        return $comparison;
    }

}
