<?php
namespace BenchTimer;

class Task
{
    public $name;
    public $start;
    public $end;
    public $duration;

    public function __construct( $name )
    {
        $this->name = $name;
        $this->start = microtime( true );
    }

    public function end()
    {
        $this->end = microtime( true );
        $this->duration = $this->getDuration();
    }

    public function getDuration() 
    {
        return ($this->end - $this->start);
    }

    public function printReport()
    {
        if( $this->name )
            echo "Task: {$this->name} ";
        echo "Duration: " . ($this->end - $this->start) . " sec.\n";
    }
}
