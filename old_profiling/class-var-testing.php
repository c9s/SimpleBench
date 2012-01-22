<? 

class Foo {
    var $disp = 123;

    function get_disp() {
        return $this->disp;
    }

}

$t1 = microtime();

for( $i = 0 ; $i < 100000 ; $i ++ ) {
    $f = new Foo;
    $ret = $f->get_disp();
}

echo (microtime() - $t1) . "\n";



$t1 = microtime();

for( $i = 0 ; $i < 100000 ; $i ++ ) {
    $f = new Foo;
    $ret = $f->disp;
}

echo (microtime() - $t1) . "\n";


?>
