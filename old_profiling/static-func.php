<?php
require( 'lib/Phifty/TaskTimer.php' );

use Phifty\TaskTimer;

function normal_foo()
{

}

class Foo
{
    static function static_func()
    {

    }
}

$timer = new TaskTimer;
$timer->start( 'normal function' );
for( $i = 0 ; $i < 1000000 ; $i++ ) {
    normal_foo();
}
$timer->end()->report();

$timer->start( 'static class function' );
for( $i = 0 ; $i < 1000000 ; $i++ )
    Foo::static_func();

$timer->end()->report();

?>
