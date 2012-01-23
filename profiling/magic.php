<?php
require( 'tests/bootstrap.php');


function foo()
{
    return 1;
}



/* function calls */
$size = 300000;
echo "n=$size\n";

$bench = new SimpleBench;



$t = $bench->start( 'cuf' );
$t->setCount($size);
for( $i = 0 ; $i < $size ; $i++ ) {
    call_user_func('foo');
}
$t->end();


$t = $bench->start( 'cufa' );
$t->setCount($size);
for( $i = 0 ; $i < $size ; $i++ ) {
    call_user_func_array('foo',array());
}
$t->end();






$result = $bench->compare();
echo $result->output('console');
