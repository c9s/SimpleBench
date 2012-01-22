<?php
require( 'lib/Phifty/TaskTimer.php' );

use Phifty\TaskTimer;

$cnt = 500000;

function func_ref( &$string_ref ) 
{
    return "foo" . $string_ref;
}

function func_copy( $string )
{
    return "foo" . $string;
}

$data = "foo! ";




## with small data
{
    $timer = new TaskTimer;
    $timer->start( 'string ref ' );
    for( $i = 0 ; $i < $cnt ; $i++ ) {
        func_ref( $data );
    }
    $timer->end()->report();
}

{
    $timer = new TaskTimer;
    $timer->start( 'string copy ' );
    for( $i = 0 ; $i < $cnt ; $i++ ) {
        func_copy( $data );
    }
    $timer->end()->report();
}



## with bigger data
for( $i = 0 ; $i < 1000 ; $i++ ) {
    $data .= " test ";
}

{
    $timer = new TaskTimer;
    $timer->start( 'big string ref ' );
    for( $i = 0 ; $i < $cnt ; $i++ ) {
        func_ref( $data );
    }
    $timer->end()->report();
}

{
    $timer = new TaskTimer;
    $timer->start( 'big string copy ' );
    for( $i = 0 ; $i < $cnt ; $i++ ) {
        func_copy( $data );
    }
    $timer->end()->report();
}


# with object
# ##############################

function func_obj_ref( & $ref ) {

}

function func_obj_copy( $ref ) {

}

$obj = new stdClass;
$obj->foo = 123;
$obj->bar = 2222;
$obj->data = $data;

{
    $timer = new TaskTimer;
    $timer->start( 'object ref ' );
    for( $i = 0 ; $i < $cnt ; $i++ ) {
        func_obj_ref( $obj );
    }
    $timer->end()->report();
}

{
    $timer = new TaskTimer;
    $timer->start( 'object copy ' );
    for( $i = 0 ; $i < $cnt ; $i++ ) {
        func_obj_copy( $obj );
    }
    $timer->end()->report();
}

?>
