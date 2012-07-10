<?php
require( 'tests/bootstrap.php');

$bench = new SimpleBench;
$bench->setN( 50000 );
$bench->title( 'Array count' );

class A implements ArrayAccess
{
    public $data;

    public function offsetGet($offset) { return $this->data[$offset]; } 

    public function offsetExists($offset) { return isset($this->data[$offset]); } 

    public function offsetUnset($offset) { unset($this->data); } 

    public function offsetSet($offset, $data) { 
        if (is_array($data)) $data = new self($data); 
        if ($offset === null) { // don't forget this! 
            $this->data[] = $data; 
        } else { 
            $this->data[$offset] = $data; 
        } 
    } 
}

$a = range(1,10000);
$bench->iterate( 'count' , 'count()' , function() use ($a) {
    $b = count($a);
});

$bench->iterate( 'static count' , 'static count()' , function() use ($a) {
    static $b;
    $b = count($a);
});


$aa = new A;
$bench->iterate( 'array_access' , 'ArrayAccess' , function() use ($aa) {
    $b = count($aa);
});

$result = $bench->compare();
echo $result->output('console');
