<?php

namespace SimpleBench;

class ComparisonMatrix
{
    public $tasks = array();
    public $matrix = array();
    public $ordering = array();
    public $info;

    function __construct($tasks = array() )
    {
        foreach( $tasks as $t ) {
            $this->add( $t );
        }
    }

    public function add($task)
    {
        $this->tasks[ $task->name ] = $task;
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

        $names = array_map(function($item){ 
            return $item->name;
            },$tasksByDuration);

        $matrix = array();
        foreach( $names as $name1 ) {
            $task = $this->tasks[$name1];
            $matrix[ $name1 ] = array();

            foreach( $names as $name2 ) {
                $task2 = $this->tasks[ $name2 ];
#                  $percent = 
#                      $task2->duration < $task->duration 
#                      ? - intval($task2->duration / $task->duration * 100)
#                      : intval($task2->duration / $task->duration * 100 );

                $percent = 
                    $task2->duration > $task->duration 
                    ? -intval($task->duration / $task2->duration * 100)
                    : intval($task->duration / $task2->duration * 100);

                if( $name1 != $name2 ) {
                    $matrix[$name1][$name2] = $percent;
                } else {
                    $matrix[$name1][$name2] = '--';
                }
            }
        }
        $this->matrix = $matrix;
        $this->ordering = $names;
        return $matrix;
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


    public function output( $format )
    {
        $class = '\SimpleBench\MatrixFormat\\' . ucfirst($format);
        $outputer = new $class($this);
        return $outputer->output();
    }

}




