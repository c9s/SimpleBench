<?php
require( 'tests/bootstrap.php');

interface TestInterface { 
    function get();
}

class Test { 
    function foo() {  }
}

class Test2 extends Test { 
    function foo() {  }
    function bar() {  }
}

class Test3 implements TestInterface { 
    function get() {  }
}


$bench = new SimpleBench;
$bench->setN( 60000 );

$bench->iterate( 'obj' , 'normal object contstruction' , function() {
    return new Test;
});

$bench->iterate( 'extends' , 'object with inheritance' , function() {
    return new Test2;
});

$bench->iterate( 'interface' , 'object with interface' , function() {
    return new Test3;
});

$result = $bench->compare();
echo $result->output('console');
