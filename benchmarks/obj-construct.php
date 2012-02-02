<?php
require( 'tests/bootstrap.php');


class TestCase1
{

}

class TestCase2
{
    public $a1;
    public $a2;
    public $a3;
    public $a4;

    public function test1() {
        return 'test';
    }
    public function test2() {
        return 'test';
    }
    public function test3() {
        return 'test';
    }
    public function test4() {
        return 'test';
    }
}

class TestCase3
{
    public $a1;
    public $a2;
    public $a3;
    public $a4;

    public function test1() { }
    public function test2() { }
    public function test3() { }
    public function test4() { }
    public function test5() { }
    public function test6() { }
    public function test7() { }
    public function test8() { }
    public function test9() { }
    public function test10() { }
    public function test11() { }
    public function test12() { }
    public function test13() {
        return 'test';
    }
    public function test14() { 
        return 'test';
    }
    public function test15() {
        return 'test';
    }
    public function test16() {
        return 'test';
    }
    public function test17() {
        return 'test';
    }
    public function test18() {
        return 'test';
    }
    public function test19() {
        return 'test';
    }
    public function test20() { 
        return 'test';
    }
}


$bench = new SimpleBench;
$bench->setN( 100000 );
$bench->iterate( 'case1' , 'no methods, no properties' , function() {
    $t = new TestCase1;
});

$bench->iterate( 'case2' , '4 methods, 4 properties' , function() {
    $t = new TestCase2;
});

$bench->iterate( 'case3' , '20 methods, 4 properties' , function() {
    $t = new TestCase3;
});

$result = $bench->compare();
echo $result->output('console');
