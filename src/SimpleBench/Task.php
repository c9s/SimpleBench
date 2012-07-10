<?php
namespace SimpleBench;

class Task
{

    /**
     * @var string task name
     */
    public $name;


    /**
     * @var string task description
     */
    public $desc;



    /**
     * @var integer start time (micro-seconds)
     */
    public $start;

    /**
     * @var integer end time (micro-seconds)
     */
    public $end;

    /**
     * @var integer duration time (micro-seconds)
     */
    public $duration;

    /**
     * @var integer iteration count
     */
    public $count = 1;

    /**
     * @var integer rate 
     */
    public $rate;


    /**
     * @var integer start up memory usage (bytes)
     */
    public $startMem;

    /**
     * @var integer end up memory usage (bytes)
     */
    public $endMem;

    public function __construct( $name )
    {
        $this->name = $name;
        $this->count = 1;
    }

    public function start()
    {
        $this->start = microtime( true );
        $this->startMem = memory_get_usage(true);
    }

    public function end()
    {
        $this->end = microtime( true );
        $this->duration = $this->getDuration();
        $this->rate = $this->count / $this->duration;
        $this->endMem = memory_get_usage(true);
        $this->mem = $this->endMem - $this->startMem;
    }

    public function getDuration() 
    {
        return ($this->end - $this->start);
    }

    public function printReport()
    {
        echo "{$this->name} \n";
        if( $this->desc )
            echo "\t=> Description: " . $this->desc . "\n";
        echo "\t=> Duration: " . ($this->duration) . " sec.\n";
        echo "\t=> Rate: " . $this->rate . "/s.\n";
        echo "\t=> Memory: " . $this->mem . "B.\n";
    }

    public function count($count)
    {
        $this->count = $count;
    }

    public function desc($desc)
    {
        $this->desc = $desc;
    }

    public function getData()
    {
        return array(
            'name' => $this->name,
            'count' => $this->count,
            'rate' => $this->rate,
            'duration' => $this->duration,
            'memory' => $this->mem,
        );
    }

}
