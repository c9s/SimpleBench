<?php

class SimpleBenchTest extends PHPUnit_Framework_TestCase
{
    function test()
    {
        $bench = new SimpleBench;
        $bench->start('task1');
        $task1 = $bench->end('task1');

        ok( $task1 );

        $bench->start('task2');
        $task2 = $bench->end('task2');

        ok( $task2 );


        
    }
}

