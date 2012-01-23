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

Function call, Method call, Static method call:

    -SimpleBench (master) % php profiling/magic.php
    n=30000
    
                         Rate     Mem   func   sfunc   method   cuf   cufa   __call
          func         233K/s      0B     --    -87%     -80%  -59%   -55%     -49%
         sfunc         203K/s      0B   114%      --     -92%  -68%   -63%     -56%
        method         187K/s      0B   124%    108%       --  -74%   -68%     -61%
           cuf         139K/s      0B   166%    145%     134%    --   -92%     -82%
          cufa         128K/s      0B   181%    158%     145%  108%     --     -89%
        __call         115K/s      0B   201%    176%     162%  120%   111%       --
    

Array push `$array[] = 1;` vs `array_push( $array , 1 );` :

        -SimpleBench (master) % php profiling/array-push.php 
    
                         Rate     Mem   array[]   array_push
       array[]           1M/s     44M        --         -29%
    array_push         381K/s     45M      341%           --
    


