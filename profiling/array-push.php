<?php
require( 'lib/Phifty/TaskTimer.php' );

use Phifty\TaskTimer;

$size = 300000;
echo "n=$size\n";
$timer = new TaskTimer;
$timer->start( 'array_push' );
$var = array();
for( $i = 0 ; $i < $size ; $i++ ) {
    array_push( $var , $i );
}
$timer->end()->report();


$timer->start( 'array[]' );
$var = array();
for( $i = 0 ; $i < $size ; $i++ ) {
    $var[] = $i;
}
$timer->end()->report();


$size = 50000;
echo "n=$size\n";
$timer = new TaskTimer;
$timer->start( 'array_push' );
$var = array();
for( $i = 0 ; $i < $size ; $i++ ) {
    array_push( $var , $i );
}
$timer->end()->report();


$timer->start( 'array[]' );
$var = array();
for( $i = 0 ; $i < $size ; $i++ ) {
    $var[] = $i;
}
$timer->end()->report();


?>
