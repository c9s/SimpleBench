<?php
require( 'src/Phifty/TaskTimer.php' );

use Phifty\TaskTimer;

$cnt = 500000;

## with small data
{
    $timer = new TaskTimer;
    $timer->start( 'create SplFixedArray' );
    for( $i = 0 ; $i < $cnt ; $i++ ) {
        $array = new SplFixedArray(100);
    }
    $timer->end()->report();
}

{
    $timer = new TaskTimer;
    $timer->start( 'create native array' );
    for( $i = 0 ; $i < $cnt ; $i++ ) {
        $array = array();
    }
    $timer->end()->report();
}


