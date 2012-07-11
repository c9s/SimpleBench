<?php
require( 'tests/bootstrap.php');

$bench = new SimpleBench;
$bench->setN( 500000 );
$bench->setTitle( '' );

class Foo extends Exception {
    public $foo;
    public $bar;

    function foo() {  }
    function bar() {  }
}

$bench->iterate( 'Exception' , function() {
    $e = new Exception("Error");
});

$bench->iterate( 'FooException', function() {
    $e = new Foo("Error");
});

$result = $bench->compare();
echo $result->output('console');
