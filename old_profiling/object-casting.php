<?php
require( 'lib/Phifty/TaskTimer.php' );

use Phifty\TaskTimer;

$timer = new TaskTimer;
$timer->start( '(object) cast' );
for( $i = 0 ; $i < 1000000 ; $i++ ) {
    $class = (object) array();
}
$timer->end()->report();

$timer->start( 'use stdclass' );
for( $i = 0 ; $i < 1000000 ; $i++ ) {
    $class = new stdClass;
}
$timer->end()->report();



$timer->start( '(object) cast with assign' );
for( $i = 0 ; $i < 1000000 ; $i++ ) {
    $obj = (object) array();
    $obj->foo = 1;
}
$timer->end()->report();

$timer->start( 'use stdclass with assign' );
for( $i = 0 ; $i < 1000000 ; $i++ ) {
    $obj = new stdClass;
    $obj->foo = 1;
}
$timer->end()->report();



?>
