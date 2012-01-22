<?php
require( 'lib/Phifty/TaskTimer.php' );

use Phifty\TaskTimer;

function nop($foo)
{

}


$timer = new TaskTimer;
$timer->start( 'using function' );
for( $i = 0 ; $i < 1000000 ; $i++ ) {
    nop(1);
}
$timer->end()->report();


$func = function($foo) 
{

};

$timer->start( 'Using anonymous function' );
for( $i = 0 ; $i < 1000000 ; $i++ ) {
    $func(1);
}
$timer->end()->report();

?>
