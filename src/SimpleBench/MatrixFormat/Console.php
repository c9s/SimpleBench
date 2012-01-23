<?php
namespace SimpleBench\MatrixFormat;

use SimpleBench\Utils;

class Console
{
    public $matrix;
    public $ordering;

    /**
     * comparison matrix object
     */
    public $cMatrix;

    public function __construct($cMatrix)
    {
        $this->cMatrix = $cMatrix;
        $this->tasks = $cMatrix->tasks;
        $this->matrix = $cMatrix->matrix;
        $this->ordering = $cMatrix->ordering;
    }


    public function output()
    {
        ob_start();
        /* matrix console printer */
        $names = $this->ordering;

        $columnLength = array();
        $maxLength = 0;
        foreach( $names as $n ) {
            $columnLength[ $n ] = strlen( $n ) + 1;
            if( strlen($n) > $maxLength )
                $maxLength = strlen($n);
        }

        // print column labels
        printf( "\n" );
        printf( "% {$maxLength}s" , "" ); // for label names
        printf( "% 8s" , "Rate" ); // for rate
        printf( "% 7s" , "Mem" ); // for memory

        foreach( $names as $name1 ) {
            $task1 = $this->tasks[ $name1 ];
            printf( "% ".$columnLength[$name1]."s" , $name1 );
        }
        printf("\n");

        foreach( $names as $name1 ) {
            printf("% {$maxLength}s",$name1);
            $task1 = $this->tasks[ $name1 ];

            $rate = $task1->rate;
            printf("% 8s", Utils::pretty_rate( $rate ));

            printf("% 7s", Utils::pretty_size( $task1->mem ) );

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

