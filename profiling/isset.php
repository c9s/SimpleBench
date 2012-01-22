<?php
require( 'lib/Phifty/TaskTimer.php' );

use Phifty\TaskTimer;

function exists($array,$key)
{
    return isset( $array[ $key ] );
}

function nop()
{

}

$timer = new TaskTimer;
$timer->start( 'use @ for condition' );
for( $i = 0 ; $i < 1000000 ; $i++ ) {
    if( @$_POST['blah'] )
        nop();
}
$timer->end()->report();

$timer->start( 'use isset for condition' );
for( $i = 0 ; $i < 1000000 ; $i++ ) {
    if( isset($_POST['blah'] ) )
        nop();
}
$timer->end()->report();



$timer->start( 'use array_key_exists for condition' );
for( $i = 0 ; $i < 1000000 ; $i++ ) {
    if( array_key_exists('blah',$_POST) )
        nop();
}
$timer->end()->report();

$timer->start( 'use user-defined "exists" function for condition' );
for( $i = 0 ; $i < 1000000 ; $i++ ) {
    if( exists($_POST,'blah') )
        nop();
}
$timer->end()->report();
