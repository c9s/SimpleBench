<?php
require( 'tests/bootstrap.php');

$bench = new SimpleBench;
$bench->setN(1);
$bench->title( 'array key filter and mapping' );

function foo($v) { 
    return $v+1; 
}

$a = array_fill_keys(range(1,10000),1);

$bench->start('array_map.funcname','array_map with function name');
array_map('foo', $a);
$bench->end('array_map.funcname');


$bench->start('array_map.closure','array_map with closure');
array_map(function($value) { 
    foo($value);
}, $a );
$bench->end('array_map.closure');

$bench->start('foreach','simple foreach');
foreach( $a as $k => $value ) {
    foo($value);
}
$bench->end('foreach');


$bench->start('filter.foreach','filter with foreach');
$args = array();
foreach( $a as $k => $v ) {
    if( $k === 2999 ) {
        $args[] = $k;
    }
}
$bench->end('filter.foreach');

$bench->start('filter.intersect','filter with array_intersect_key');
array_intersect_key($a,array( 2999 => 1 ) );
$bench->end('filter.intersect');

$result = $bench->compare();
echo $result->output('console');
