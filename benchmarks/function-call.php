<?php
require( 'tests/bootstrap.php');

function foo1()
{
}

function foo2()
{
    return foo1();
}

function foo3()
{
    return foo2();
}

$bench = new SimpleBench;
$bench->setN( 100000 );

$bench->iterate( 'func1' , 'direct function call' , function() {
    foo1();
});

$bench->iterate( 'func2' , 'direct function call' , function() {
    foo2();
});

$bench->iterate( 'func3' , 'direct function call' , function() {
    foo3();
});

$result = $bench->compare();
echo $result->output('console');
