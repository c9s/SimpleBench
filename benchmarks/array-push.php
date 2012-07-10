<?php
require( 'tests/bootstrap.php');

$n = 300000;
echo "n=$n\n";
$bench = new SimpleBench();
$t = $bench->start( 'array_push' );
$t->count($n);
$var = array();
for( $i = 0 ; $i < $n ; $i++ ) {
    array_push( $var , $i );
}
$bench->end( 'array_push' );
unset($var);


$t = $bench->start( 'array[]' );
$t->count($n);
$var = array();
for( $i = 0 ; $i < $n ; $i++ ) {
    $var[] = $i;
}
$t = $bench->end('array[]');

$result = $bench->compare();
echo $result->output('console');
