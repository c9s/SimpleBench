<?php
require( 'tests/bootstrap.php');

$bench = new SimpleBench;
$bench->setN( 500000 );
$bench->title( '' );

function getValue()
{
    return true;
}

$bench->iterate( 'string ==' , function() {
    if( 'string' == getValue() ) {

    }
});

$bench->iterate( 'string ===' , function() {
    if( 'string' === getValue() ) {

    }
});

$bench->iterate( '=== null' , function() {
    if( null === getValue() ) {
    }
});

$bench->iterate( 'is_null' , function() {
    if( is_null(getValue()) ) {
    }
});

$bench->iterate( '!', function() {
    if( ! getValue() ) {
    }
});

$bench->iterate( '=== false' , function() {
    if( false === getValue() ) {

    }
});

$bench->iterate( 'boolean context', function() {
    if ( getValue() ) {

    }
});


$bench->iterate( 'boolean === boolean' , function() {
    if ( true === getValue() ) {

    }
});

$result = $bench->compare();
echo $result->output('console');
