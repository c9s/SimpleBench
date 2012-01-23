<?php
require( 'tests/bootstrap.php');

class TestCall {
  function normal() { return 1; }
  function __call($method, $args) { return 1; }
}
$testCall = new TestCall();


class TestCall2
{
    static function foo() {
        return 1;
    }
}

function foo()
{
    return 1;
}


/* function calls */
$n = 30000;
echo "n=$n\n";

$bench = new SimpleBench;

$bench->iterate( 'func' , 'direct function call' , $n , function() {
    foo();
});

$bench->iterate( 'sfunc' , 'static function call' , $n , function() {
    TestCall2::foo();
});


$bench->iterate( 'cuf' , 'testing call_user_func' , $n , function() {
    call_user_func('foo');
});

$bench->iterate( 'cufa' , 'testing call_user_func_array' , $n , function() {
    call_user_func_array('foo',array());
});

$bench->iterate( '__call' , 'testing __call with object' , $n , function() use ($testCall) {
    $testCall->notExists();
});

$bench->iterate( 'method' , 'testing normal method call' , $n , function() use ($testCall) {
    $testCall->normal();
});

$result = $bench->compare();
echo $result->output('console');
