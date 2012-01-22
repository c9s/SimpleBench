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

                     Rate     Mem     task1     task2     task3
     task1           1M/s    272M        --      -60%      -34%
     task2         697K/s    272M      166%        --      -56%
     task3         394K/s    272M      293%      176%        --


