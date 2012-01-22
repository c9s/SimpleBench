<?php
require( 'lib/Phifty/TaskTimer.php' );

use Phifty\TaskTimer;


$cnt = 100000;


$strs = array( "test" , "test" , "test" , "test" , "test" );
{
    $timer = new TaskTimer;
    $timer->start( 'use join function' );
    for( $i = 0 ; $i < $cnt ; $i++ ) {
        $str = join( DIRECTORY_SEPARATOR , $strs );
    }
    $timer->end()->report();
}

{
    $timer = new TaskTimer;
    $timer->start( 'use implode function' );
    for( $i = 0 ; $i < $cnt ; $i++ ) {
        $str = implode( DIRECTORY_SEPARATOR , $strs );
    }
    $timer->end()->report();
}


{
    function str_join( $strs )
    {
        $buf = '';
        for( $i = 0 ; $i < count( $strs ) ; $i++ )
            $buf .= DIRECTORY_SEPARATOR . $strs[ $i ];
        return $buf;
    }
    $timer->start( 'use "." operator + for to join' );
    for( $i = 0 ; $i < $cnt ; $i++ ) {
        $str = str_join( $strs );
    }
    $timer->end()->report();
}

{
    $timer->start( 'use "." operator' );
    for( $i = 0 ; $i < $cnt ; $i++ ) {
        $str = 'test' . DIRECTORY_SEPARATOR . 'test' . DIRECTORY_SEPARATOR . 'test' . 
                DIRECTORY_SEPARATOR . 'test' . DIRECTORY_SEPARATOR . 'test';
    }
    $timer->end()->report();
}

?>
