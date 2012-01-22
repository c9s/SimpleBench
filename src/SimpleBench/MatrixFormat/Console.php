<?php

namespace SimpleBench\MatrixFormat;
class Console
{
    public $matrix;
    public $ordering;

    function __construct($tasks,$matrix,$ordering)
    {
        $this->tasks = $tasks;
        $this->matrix = $matrix;
        $this->ordering = $ordering;
    }

    function output()
    {
        /* matrix console printer */
        $names = $this->ordering;

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
                $percent = $this->matrix[ $name1 ][ $name2 ];
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

