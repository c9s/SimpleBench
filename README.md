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



```php
<?php

$bench->iterate( 'spl' , 3000 , function() {
    
});



```


## Testing Result


        -SimpleBench (master) % php profiling/array-push.php 
    
                         Rate     Mem   array[]   array_push
       array[]           1M/s     44M        --         -29%
    array_push         381K/s     45M      341%           --
    


