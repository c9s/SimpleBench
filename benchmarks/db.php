<?php
require( 'tests/bootstrap.php');
$pdo = new PDO('mysql:host=localhost;dbname=benchmarks', 'root', '123123' );
$mysqli = new mysqli("localhost", "root", "123123", "benchmarks");

$mysqli->query("delete from foo;");

$s = 50000;
echo "Building data: $s records...\n";
foreach( range(1,$s) as $i ) {
    $mysqli->query("insert into foo ( name ) values ( 'foo$i' ) ");
}


$bench = new SimpleBench( array( 'gc' => 1 ));
$bench->n = 3;
$bench->title = 'database interface';

$bench->iterate( 'mysqli_query' , 'mysqli' , function() use($mysqli) {
    $stm = $mysqli->query('select * from foo');
});
$bench->iterate( 'mysqli_prepare' , 'mysqli' , function() use($mysqli) {
    $stm = $mysqli->prepare('select * from foo');
    $stm->execute();
    $res = $stm->get_result();
    while( $row = $res->fetch_object() ) {

    }
});


$bench->iterate( 'pdo_query' , 'pdo' , function() use($pdo) {
    $stm = $pdo->query('select * from foo');
});

$bench->iterate( 'pdo_prepare' , 'pdo' , function() use($pdo) {
    $stm = $pdo->prepare('select * from foo');
    $stm->execute();
    while( $row = $stm->fetch(PDO::FETCH_OBJ) ) {

    }
});


$result = $bench->compare();
echo $result->output('console');

