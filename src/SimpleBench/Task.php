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

    public $startMem;
    public $endMem;

    public function __construct( $name )
    {
        $this->name = $name;
        $this->count = 1;
    }

    public function start()
    {
        $this->start = microtime( true );
        $this->startMem = memory_get_usage();
    }

    public function end()
    {
        $this->end = microtime( true );
        $this->duration = $this->getDuration();
        $this->rate = $this->count / $this->duration;
        $this->endMem = memory_get_usage();
    }

    public function getDuration() 
    {
        return ($this->end - $this->start);
    }

    public function printReport()
    {
        echo "Task: {$this->name} \n";
        echo "=> Duration: " . ($this->duration) . " sec.\n";
        echo "=> Rate: " . $this->rate . "/s.\n";
        echo "=> Memory: " . $this->endMem - $this->startMem . "M.\n";
    }

    public function setCount($count)
    {
        $this->count = $count;
    }

    public function getData()
    {
        return array(
            'name' => $this->name,
            'count' => $this->count,
            'rate' => $this->rate,
            'duration' => $this->duration,
            'memory' => $this->endMem - $this->startMem,
        );
    }

}
