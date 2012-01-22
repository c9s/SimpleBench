<?php
require( 'tests/bootstrap.php');

$size = 300000;
echo "n=$size\n";
$bench = new SimpleBench();
$bench->start( 'array_push' );
$var = array();
for( $i = 0 ; $i < $size ; $i++ ) {
    array_push( $var , $i );
}
$bench->end( 'array_push' );
unset($var);


$bench->start( 'array[]' );
$var = array();
for( $i = 0 ; $i < $size ; $i++ ) {
    $var[] = $i;
}
$bench->end('array[]');

$result = $bench->compare();
$result->output('console');
