<?php
require( 'tests/bootstrap.php');

class TestGetSet 
{
  public $foo = 1;
  public function __get($var) {
    return $this->foo;
  }
  public function __set($var, $val) {
    $this->foo = $val;
  }
}

$t = new TestGetSet();
/*
$t->foo;
$t->bar;
$t->foo = 1;
$t->bar = 1;
 */

$bench = new SimpleBench;
$bench->setN( 50000 );

$bench->iterate( 'set' , 'native property setter' , function() use ($t) {
    $t->foo = 1;
});

$bench->iterate( '__set' , '__set property' , function() use ($t) {
    $t->bar = 1;
});


$bench->iterate( 'get' , 'native property getter' , function() use ($t) {
    return $t->foo;
});

$bench->iterate( '__get' , '__get property' , function() use ($t) {
    return $t->bar;
});

$result = $bench->compare();
echo $result->output('console');
