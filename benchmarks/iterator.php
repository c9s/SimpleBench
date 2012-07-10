<?php
require( 'tests/bootstrap.php');

class Internal implements Iterator {
  protected $a;
  public function __construct(array $a) {
    $this->a = $a;
  }
  public function current() {
    return current($this->a);
  }
  public function key() {
    return key($this->a);
  }
  public function next() {
    return next($this->a);
  }
  public function rewind() {
    return reset($this->a);
  }
  public function valid() {
    return (current($this->a) !== FALSE);
  }
}
class External implements IteratorAggregate {
  protected $a;
  public function __construct(array $a) {
    $this->a = $a;
  }
  public function getIterator() {
    return new ArrayIterator($this->a);
  }
}
$a = array('A', 'B', 'C', 'D');
$internal = new Internal($a);
$external = new External($a);
foreach ( $a as $item);
foreach ($internal as $item);
foreach ($external as $item);

$bench = new SimpleBench;
$bench->setN( 50000 );
$bench->title( 'iterator' );

$bench->iterate( 'func' , function() {

});

$result = $bench->compare();
echo $result->output('console');
