<?php
require( 'lib/Phifty/TaskTimer.php' );

use Phifty\TaskTimer;

function foo_get_args()
{
    $args = func_get_args();
}

function foo_with_args( $n1, $n2 , $n3 )
{

}

$timer = new TaskTimer;
$timer->start( 'use func_get_args' );
for( $i = 0 ; $i < 1000000 ; $i++ ) {
    foo_get_args( 1,2,3,4,5,6,7 );

}
$timer->end()->report();

$timer->start( 'no func_get_args' );
for( $i = 0 ; $i < 1000000 ; $i++ ) {
    foo_with_args( 1,2,3,4,5,6,7 );
}
$timer->end()->report();

?>
