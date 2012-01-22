<?php

class SimpleBenchTest extends PHPUnit_Framework_TestCase
{
    function test()
    {
        $bench = new SimpleBench;
        $task1 = $bench->start('task1');
        $task1->setCount(300); // 300 requests
        usleep(100);
        $bench->end('task1');
        ok( $task1 );

        $task2 = $bench->start('task2');
        $task2->setCount(300); // 300 requests
        usleep(300);
        $bench->end('task2');
        ok( $task2 );


        $task3 = $bench->start('task3');
        $task3->setCount(300); // 300 requests
        usleep(600);
        $bench->end('task3');
        ok( $task3 );

        $result = $bench->compare($task1,$task2,$task3);
        
    }
}

