<?php
require( 'tests/bootstrap.php');

$bench = new SimpleBench;
$bench->setN( 50000 );
$bench->setTitle( 'sprintf test' );

$bench->iterate( 'sprintf' , 'sprintf' , function() {
    $foo = 'Foo';
    $bar = 'Bar';
    $str = sprintf('%s\%s\%s',$foo,$bar,$foo);
});

$bench->iterate( '.' , '.' , function() {
    $foo = 'Foo';
    $bar = 'Bar';
    $str = $foo . '\\' . $bar . '\\' . $foo;
});

$result = $bench->compare();
echo $result->output('console');
