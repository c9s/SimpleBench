<?php
require 'autoload.php';
use Phifty\TaskTimer;

$cnt = 1000;
$timer = new TaskTimer;
$timer->start( 'use parse_ini_file for condition' );
for( $i = 0 ; $i < $cnt ; $i++ ) {
    parse_ini_file( 'profiling/application.ini' );
}
$timer->end()->report();

$timer->start( 'use YAML for condition' );
for( $i = 0 ; $i < $cnt ; $i++ ) {
    \Phifty\YAML::loadFile( 'config/dev.yml' );
}
$timer->end()->report();
