<?php
require( 'tests/bootstrap.php');

$bench = new SimpleBench;
$bench->setN( 5 );
$bench->setTitle( 'Fetch' );

$bench->iterate( 'file' , 'file_get_contents' , function() {
    file_get_contents("http://www.php.net/");
});

$bench->iterate( 'curl' , 'curl' , function() {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://www.php.net/");
    curl_setopt($ch, CURLOPT_HEADER, false );
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
    curl_exec($ch);
    curl_close($ch);
});

$result = $bench->compare();
echo $result->output('console');
