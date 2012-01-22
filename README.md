SimpleBench
===========

SimpleBench provides suckless benchmark tools.

## API

```php
$bench = new SimpleBench;
$task1 = $bench->start('task1');
$task1->setCount(300); // 300 requests
usleep(100);
$bench->end('task1');

$task2 = $bench->start('task2');
$task2->setCount(300); // 300 requests
usleep(300);
$bench->end('task2');

$task3 = $bench->start('task3');
$task3->setCount(300); // 300 requests
usleep(600);
$bench->end('task3');

$result = $bench->compare($task1,$task2,$task3);
$result->output('console');
```


## Testing Result

    PHPUnit 3.6.7 by Sebastian Bergmann.
    Configuration read from /Users/c9s/git/work/SimpleBench/phpunit.xml
    
    .
                         Rate     task1     task2     task3
         task1           1M/s        --      241%      408%
         task2         686K/s      -41%        --      169%
         task3         405K/s      -24%      -59%        --
    
    
    Time: 0 seconds, Memory: 5.25Mb
    
    OK (1 test, 3 assertions)
