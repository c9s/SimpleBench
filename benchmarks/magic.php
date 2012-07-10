<?php
require( 'tests/bootstrap.php');

class TestCall {
  function normal($v) { return 1; }
  function __call($method, $args) { return 1; }
  function __get($name) {
      return $name;
  }
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

$bench->iterate( 'function' , function() {
    foo(1);
});

$bench->iterate( 'static::method' , function() {
    TestCall2::foo(1);
});


$bench->iterate( 'call_user_func' , function() {
    call_user_func('foo',1);
});

$bench->iterate( 'call_user_func_array' , function() {
    call_user_func_array('foo',array(1));
});


$bench->iterate( '__get' , function() use ($testCall) {
    $testCall->foo;
});

$bench->iterate( '__call' , function() use ($testCall) {
    $testCall->notExists(1);
});

$bench->iterate( 'method' , function() use ($testCall) {
    $testCall->normal(1);
});

$result = $bench->compare();
echo $result->output('Console');
$result->output('EzcGraph');
