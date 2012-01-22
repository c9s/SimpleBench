<?php
require( 'tests/bootstrap.php');

$size = 300000;
echo "n=$size\n";
$bench = new SimpleBench();
$t = $bench->start( 'array_push' );
$t->setCount($size);
$var = array();
for( $i = 0 ; $i < $size ; $i++ ) {
    array_push( $var , $i );
}
$bench->end( 'array_push' );
unset($var);


$t = $bench->start( 'array[]' );
$t->setCount($size);
$var = array();
for( $i = 0 ; $i < $size ; $i++ ) {
    $var[] = $i;
}
$t = $bench->end('array[]');

$result = $bench->compare();
$result->output('console');
