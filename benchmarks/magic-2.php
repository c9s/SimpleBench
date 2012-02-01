<?php
require( 'tests/bootstrap.php');

class TestCall {
    public $foo;
    public $data = array();

    function normal($v) { return 1; }

    function __call($method, $args) { return 1; }


    function setFoo($k) {
        $this->foo = $k;
    }

    function getFoo()
    {
        return $this->foo;
    }

    function __get($k) {
        return $this->data[ $k ];
    }

    function __set($k,$v) { 
        $this->data[ $k ] = $v;
    }
}

$testCall = new TestCall();

/* function calls */
$bench = new SimpleBench;
$bench->setN( 50000 );

$bench->iterate( '__set' , 'magic set' , function() use ($testCall) {
    $testCall->foo = 123;
});

$bench->iterate( 'set' , 'set' , function() use ($testCall) {
    $testCall->setFoo(123);
});

$bench->iterate( '__get' , 'magic get' , function() use ($testCall) {
    $val = $testCall->foo;
});

$bench->iterate( 'get' , 'get' , function() use ($testCall) {
    $val = $testCall->getFoo();
});

$result = $bench->compare();
echo $result->output('Console');
# $result->output('EzcGraph');
