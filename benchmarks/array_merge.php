<?php
require( 'tests/bootstrap.php');

$bench = new SimpleBench;
$bench->setN( 50000 );
$bench->title( 'array merge' );

$arr1 = array( 'a' => 1 );
$arr2 = array( 'b' => 2 , 'c' => 3 );

$bench->iterate( 'array_merge' , 'array_merge' , function() use($arr1,$arr2) {
    $arr = array_merge($arr1, $arr2);
});

$bench->iterate( '+' , '+' , function() use($arr1,$arr2) {
    $arr = $arr1 + $arr2;
});

$result = $bench->compare();
echo $result->output('console');
