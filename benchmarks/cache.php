<?php
require( 'tests/bootstrap.php');

$bench = new SimpleBench;
$bench->setN( 50000 );
$bench->setTitle( 'Cache' );

$bench->iterate( 'apc(set)' , 'apc_store' , function() {
    apc_store('___a',123,100);
});

$bench->iterate( 'apc(get)' , 'apc_get' , function() {
    apc_fetch('___a');
});

$memcache = new Memcache;
$memcache->connect('localhost',11211);
$bench->iterate( 'memcache(set)' , 'memcache set' , function() use ($memcache) {
    $memcache->set( '___a' , 123,100 );
});

$bench->iterate( 'memcache(get)' , 'memcache get' , function() use ($memcache) {
    $memcache->get( '___a' );
});

$redis = new Redis;
$redis->connect('127.0.0.1', 6379);
$bench->iterate( 'redis(set)' , 'redis set' , function() use ($redis) {
    $redis->set( '___a' , 123 );
});

$redis = new Redis;
$redis->connect('127.0.0.1', 6379);
$bench->iterate( 'redis(get)' , 'redis get' , function() use ($redis) {
    $redis->get( '___a' );
});

$result = $bench->compare();
echo $result->output('console');
