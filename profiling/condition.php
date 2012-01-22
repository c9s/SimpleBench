<?php
require( 'lib/Phifty/TaskTimer.php' );

use Phifty\TaskTimer;
$ret = null;

$a = 0;
$b = false;

$timer = new TaskTimer;
$timer->start( 'testing 0 === false' );

for( $i = 0 ; $i < 1000000 ; ++$i) {
    $ret = ($a === $b) ? true : false;
}
$timer->end()->report();


$timer->start( 'testing ==' );
for( $i = 0 ; $i < 1000000 ; $i++ ) {
    $ret = ($a == $b) ? true : false;
}
$timer->end()->report();





$a = 0;
$b = 1;
$timer = new TaskTimer;
$timer->start( 'testing 0 === 1' );
for( $i = 0 ; $i < 1000000 ; ++$i) {
    $ret = ($a === $b) ? true : false;
}
$timer->end()->report();

$timer->start( 'testing 0 == 1' );
for( $i = 0 ; $i < 1000000 ; $i++ ) {
    $ret = ($a == $b) ? true : false;
}
$timer->end()->report();



$a = 1;
$b = 1;
$timer = new TaskTimer;
$timer->start( 'testing 1 === 1' );
for( $i = 0 ; $i < 1000000 ; ++$i) {
    $ret = ($a === $b) ? true : false;
}
$timer->end()->report();

$timer->start( 'testing 1 == 1' );
for( $i = 0 ; $i < 1000000 ; $i++ ) {
    $ret = ($a == $b) ? true : false;
}
$timer->end()->report();



$a = 'abc';
$b = 'abc';
$timer = new TaskTimer;
$timer->start( 'testing str === str' );
for( $i = 0 ; $i < 1000000 ; ++$i) {
    $ret = ($a === $b) ? true : false;
}
$timer->end()->report();
var_dump( $ret ); 

$timer->start( 'testing str == str' );
for( $i = 0 ; $i < 1000000 ; $i++ ) {
    $ret = ($a == $b) ? true : false;
}
$timer->end()->report();
var_dump( $ret ); 



?>
