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
    public $n = 1;
    public $title;

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

    public function setN($n)
    {
        echo "n=$n\n";
        $this->n = $n;
    }


    /**
     * set use-case title
     *
     * @param string $title
     *
     */
    public function title($title)
    {
        return $this->title = $title;
    }



    /**
     * Iterating helper
     *
     */
    public function iterate( $taskName, $arg1 = null , $arg2 = null )
    {
        $callback = null;
        $desc = null;
        if( $arg1 && $arg2 ) {
            $desc = $arg1;
            $callback = $arg2;
        } elseif( $arg1 ) {
            $callback = $arg1;
        } else {
            throw new Exception('Require a callback function');
        }

        $task = $this->create( $taskName );
        $task->desc( $desc );

        echo "Runing $taskName - $desc. ";

        $task->count( $this->n );
        $task->start();
        for( $i = 0 ; $i < $this->n;  $i++ ) {
            call_user_func($callback);
        }
        $task->end();

        echo $task->rate . "/s\n";
        return $task;
    }


    /**
     * create a task, but doest start
     *
     * @param string $taskName
     */
    public function create($taskname)
    {
        $task = new SimpleBench\Task( $taskname );
        $this->stacks[] = $task;
        if( isset( $this->tasks[ $taskname ] ) ) {
            throw new Exception("Task $taskname is already defined.");
        }
        $this->tasks[ $taskname ] = $task;
        return $task;
    }

    /**
     * start a task to test the benchmark of solution 
     *
     * @param string $taskname 
     * @return SimpleBench\Task
     */
    public function start( $taskname = 'default' , $desc = null )
    {
        $task = $this->create( $taskname );
        if( $desc )
            $task->desc( $desc );
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
