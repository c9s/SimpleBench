<?php
require( 'tests/bootstrap.php');

class TestCall {
  function normal($v) { return 1; }
  function __call($method, $args) { return 1; }
}
$testCall = new TestCall();


class TestCall2
{
    static function foo($v) {
        return 1;
    }
}

function foo($v)
{
    return 1;
}


/* function calls */
$bench = new SimpleBench;
$bench->setN( 50000 );

$bench->iterate( 'func' , 'direct function call' , function() {
    foo(1);
});

$bench->iterate( 'sfunc' , 'static function call' , function() {
    TestCall2::foo(1);
});


$bench->iterate( 'cuf' , 'testing call_user_func' , function() {
    call_user_func('foo',1);
});

$bench->iterate( 'cufa' , 'testing call_user_func_array' , function() {
    call_user_func_array('foo',array(1));
});

$bench->iterate( '__call' , 'testing __call with object' , function() use ($testCall) {
    $testCall->notExists(1);
});

$bench->iterate( 'method' , 'testing normal method call' , function() use ($testCall) {
    $testCall->normal(1);
});

$result = $bench->compare();
echo $result->output('console');
