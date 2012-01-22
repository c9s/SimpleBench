<?php

namespace SimpleBench;

class ComparisonMatrix
{
    public $tasks = array();

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
                $percent = 
                    $task2->duration < $task->duration 
                    ? - intval($task2->duration / $task->duration * 100)
                    : intval($task2->duration / $task->duration * 100 );

                if( $name1 != $name2 ) {
                    $matrix[$name1][$name2] = $percent;
                } else {
                    $matrix[$name1][$name2] = '--';
                }
            }
        }

        /* matrix console printer */

        // print column labels
        printf( "\n" );
        printf( "% 10s" , "" );
        printf( "% 15s" , "Rate" );
        foreach( $names as $name1 ) {
            $task1 = $this->tasks[ $name1 ];
            printf( "% 10s" , $name1 );
        }
        printf("\n");

        foreach( $names as $name1 ) {
            printf("% 10s",$name1);
            $task1 = $this->tasks[ $name1 ];

            $rate = $task1->rate;

            if( $rate > 1000000 ) {
                printf("% 15s", (int)( $task1->rate / 1000000 ) . 'M/s');
            }
            elseif( $rate > 1000 ) {
                printf("% 15s", (int)( $task1->rate / 1000 ) . 'K/s');
            }
            else {
                printf("% 15s", (int)( $task1->rate ) . '/s');
            }

            foreach( $names as $name2 ) {
                $percent = $matrix[ $name1 ][ $name2 ];
                if( $percent != '--' ) {
                        printf("% 10s", $percent . '%');
                } else {
                    printf("% 10s",$percent);
                }
            }
            printf("\n");
        }


    }
}




