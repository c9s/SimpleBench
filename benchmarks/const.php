<?php
require( 'tests/bootstrap.php');

class Foo
{
    const foo = 123;

    public $foo = 123;
}

$bench = new SimpleBench;
$bench->setN( 500000 );
$bench->setTitle( '' );

$f = new Foo;

$bench->iterate( 'const' , function() use ($f) {
    $v = Foo::foo;
});

$bench->iterate( '$f::const', function() use ($f) {
    $v = $f::foo;
});

$bench->iterate( 'member', function() use ($f) {
    $v = $f->foo;
});

$result = $bench->compare();
echo $result->output('console');
