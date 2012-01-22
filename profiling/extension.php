<?php
require( 'lib/Phifty/TaskTimer.php' );

use Phifty\TaskTimer;

$timer = new TaskTimer;
$timer->start( 'using extension_loaded' );
for( $i = 0 ; $i < 1000000 ; $i++ ) {
    extension_loaded('mysqli');
    extension_loaded('apc');
}
$timer->end()->report();


class ExtensionChecker 
{
    static $cache = array();

    static function check( $name ) {
        return static::$cache[ $name ] = extension_loaded( $name );
    }
    static function loaded($name) {
        return static::$cache[ $name ];
    }
}

$timer->start( 'using var to save' );
ExtensionChecker::check('mysqli');
ExtensionChecker::check('apc');
for( $i = 0 ; $i < 1000000 ; $i++ ) {
    ExtensionChecker::loaded('mysqli');
    ExtensionChecker::loaded('apc');
}
$timer->end()->report();

?>
