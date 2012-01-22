<?php

namespace SimpleBench;

class ComparisonSet
{
    public $tasks;

    function __construct($tasks = array() )
    {
        $this->tasks = $tasks;
    }

    public function add($task)
    {
        $this->tasks[] = $task;
    }

    public function compare()
    {
        // generate comparison result
        $tasksByDuration = array_merge(array(), $this->tasks );
        usort( $tasksByDuration,  function($a,$b) {
            if( $a->duration == $b->duration )
                return 0;
            return $a->duration > $b->duration ? 1 : -1;
        });
        var_dump( $tasksByDuration ); 


    }
}




