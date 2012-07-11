<?php
require( 'tests/bootstrap.php');

$bench = new SimpleBench;
$bench->setN( 5000000 );
$bench->setTitle( '' );

$bench->iterate( 'false === $var' , function() {
    $var = false;
    if( false === $var ) {

    }
});

$bench->iterate( 'false == $var' , function() {
    $var = false;
    if( false == $var ) {

    }
});

$bench->iterate( '! $var' , function() {
    $var = false;
    if( ! $var ) {

    }
});

$result = $bench->compare();
echo $result->output('console');
