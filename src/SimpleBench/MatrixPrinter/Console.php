<?php
namespace SimpleBench\MatrixPrinter;

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


    public function outputSystemInfo()
    {
        $info = $this->cMatrix->info;

        echo "\n\n";
        echo "--- System Information ---\n";
        echo "PHP Version: " , $info['php_version'] , "\n";
        echo "CPU Brand String: " , $info['cpu.brand_string'] , "\n";
    }


    public function outputBarChart()
    {
        echo "Bar Chart\n\n";

        $names = $this->ordering;

        $columnLength = array();
        $maxLength = 0;
        $maxRate = 0;
        foreach( $names as $n ) {
            $task = $this->tasks[ $n ];
            $columnLength[ $n ] = strlen( $n ) + 1;
            if( strlen($n) > $maxLength )
                $maxLength = strlen($n);
            if( $task->rate > $maxRate )
                $maxRate = $task->rate;
        }

        foreach( $names as $name1 ) {
            $task1 = $this->tasks[ $name1 ];
            printf( "  % ".$maxLength."s" , $name1 );

            $rate = $task1->rate;
            printf("% 8s", Utils::pretty_rate( $rate ));

            echo " | ";

            $r = ($rate / $maxRate);
            $chars = (int) (69 * $r);
            echo str_repeat( '=' , $chars - 1 );
            echo ">";
            echo str_repeat( ' ' , 69 - $chars );
            echo " |";
            echo "\n";
        }

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

        $this->outputBarChart();
        $this->outputSystemInfo();

        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

}
