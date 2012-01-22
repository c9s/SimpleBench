<?php
require( 'lib/Phifty/TaskTimer.php' );
use Phifty\TaskTimer;

$cnt = 200000;

{
    function web_dir()
    {
        return dirname(__FILE__);
    }

    $timer = new TaskTimer;
    $timer->start( 'use function' );
    for( $i = 0 ; $i < $cnt ; $i++ ) {
        $dir = web_dir();
    }
    $timer->end()->report();
}


{
    function web_dir2()
    {
        static $path;
        if( $path )
            return $path;
        return $path = dirname(__FILE__);
    }

    $timer = new TaskTimer;
    $timer->start( 'use function with static cache' );
    for( $i = 0 ; $i < $cnt ; $i++ ) {
        $dir = web_dir2();
    }
    $timer->end()->report();
}


{
    define( 'WEB_DIR'  , dirname(__FILE__) );
    $timer->start( 'use constant' );
    for( $i = 0 ; $i < $cnt ; $i++ ) {
        $dir = WEB_DIR;
    }
    $timer->end()->report();
}


?>
