<?php

namespace SimpleBench\MatrixFormat;
class Console
{
    public $matrix;
    public $ordering;

    public function __construct($tasks,$matrix,$ordering)
    {
        $this->tasks = $tasks;
        $this->matrix = $matrix;
        $this->ordering = $ordering;
    }

    public function output()
    {
        ob_start();
        /* matrix console printer */
        $names = $this->ordering;


        $columnLength = array();
        foreach( $names as $n ) {
            $columnLength[ $n ] = strlen( $n ) + 3;
        }

        // print column labels
        printf( "\n" );
        printf( "% 10s" , "" ); // for label names
        printf( "% 15s" , "Rate" ); // for rate
        printf( "% 8s" , "Mem" ); // for memory

        foreach( $names as $name1 ) {
            $task1 = $this->tasks[ $name1 ];
            printf( "% ".$columnLength[$name1]."s" , $name1 );
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


            if( $task1->mem > 1000000 ) {
                printf("% 8s", (int)( $task1->mem / 1000000 ) . 'M');
            }
            elseif( $task1->mem > 1000 ) {
                printf("% 8s", (int)( $task1->mem / 1000 ) . 'K');
            }
            else {
                printf("% 8s", (int)( $task1->mem ) . 'B');
            }

            foreach( $names as $name2 ) {
                $w = $columnLength[$name2];

                $percent = $this->matrix[ $name1 ][ $name2 ];
                if( $percent != '--' ) {
                        printf("% {$w}s", $percent . '%');
                } else {
                    printf("% {$w}s",$percent);
                }
            }
            printf("\n");
        }

        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

}

