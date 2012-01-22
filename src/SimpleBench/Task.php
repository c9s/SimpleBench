<?php
namespace SimpleBench;

class Task
{
    public $name;
    public $start;
    public $end;
    public $duration;
    public $count;
    public $rate;

    public function __construct( $name )
    {
        $this->name = $name;
        $this->count = 1;
    }

    public function start()
    {
        $this->start = microtime( true );
    }

    public function end()
    {
        $this->end = microtime( true );
        $this->duration = $this->getDuration();
        $this->rate = $this->duration / $this->count;
    }

    public function getDuration() 
    {
        return ($this->end - $this->start);
    }

    public function printReport()
    {
        echo "Task: {$this->name} \n";
        echo "=> Duration: " . ($this->duration) . " sec.\n";
        echo "=> Rate: " . $this->rate . " per sec.\n";
    }

    public function setCount($count)
    {
        $this->count = $count;
    }

}
