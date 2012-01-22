<?php

require( 'lib/Phifty/TaskTimer.php' );

use Phifty\TaskTimer;

function nop()
{

}

$timer = new TaskTimer;
$timer->start( 'if else' );

for( $i = 0 ; $i < 1000000 ; $i++ ) {

    $r = rand( 1 , 10 );
    if( $r == 1 ) 
    {
        nop();
    }
    elseif( $r == 2 )
    {
        nop();
    }
    elseif( $r == 3 )
    {
        nop();
    }
}
$timer->end()->report();

$timer->start( 'switch' );

for( $i = 0 ; $i < 1000000 ; $i++ ) {

    $r = rand( 1 , 10 );

    switch($r)
    {
        case 1: nop(); break;
        case 2: nop(); break;
        case 3: nop(); break;
    }
}

$timer->end()->report();

?>
