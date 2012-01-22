<?php
require( 'lib/Phifty/TaskTimer.php' );

use Phifty\TaskTimer;

function nop()
{

}

$timer = new TaskTimer;
$timer->start( 'plus before var' );
for( $i = 0 ; $i < 1000000 ; ++$i) {
    nop();
}
$timer->end()->report();

$timer->start( 'plus after var' );
for( $i = 0 ; $i < 1000000 ; $i++ ) {
    nop();
}
$timer->end()->report();

?>
