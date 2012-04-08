<?php
require( 'tests/bootstrap.php');

$bench = new SimpleBench;
$bench->setN( 50000 );
$bench->setTitle( '' );

function getValue()
{
    return true;
}

$bench->iterate( 'string ==' , 'string ==' , function() {
    if( 'string' == getValue() ) {

    }
});

$bench->iterate( 'string ===' , 'string ===' , function() {
    if( 'string' === getValue() ) {

    }
});

$bench->iterate( '=== null' , '=== null' , function() {
    if( null === getValue() ) {
    }
});

$bench->iterate( 'is_null' , 'is_null' , function() {
    if( is_null(getValue()) ) {
    }
});

$bench->iterate( '!' , '!' , function() {
    if( ! getValue() ) {
    }
});

$bench->iterate( '=== false' , 'false' , function() {
    if( false === getValue() ) {

    }
});

$bench->iterate( 'boolean context' , 'boolean context' , function() {
    if ( getValue() ) {

    }
});


$bench->iterate( 'boolean === boolean' , 'boolean context' , function() {
    if ( true === getValue() ) {

    }
});

$result = $bench->compare();
echo $result->output('console');
