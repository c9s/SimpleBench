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

$bench->iterate( 'fsock' , 'fsocket' , function() {
    $fp = fsockopen("www.php.net", 80, $errno, $errstr, 30);
    if (!$fp) {
        echo "$errstr ($errno)<br />\n";
    } else {
        $out = "GET / HTTP/1.1\r\n";
        $out .= "Host: www.php.net\r\n";
        $out .= "Connection: Close\r\n\r\n";
        fwrite($fp, $out);
        while (!feof($fp)) {
            fgets($fp, 128);
        }
        fclose($fp);
    }
});

$result = $bench->compare();
echo $result->output('console');
