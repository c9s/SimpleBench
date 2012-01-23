SimpleBench
===========

SimpleBench provides suckless benchmark tools.

## Install

    $ git clone .....
    $ onion -d bundle
    $ php profiling/magic.php

## API

```php
<?php
$bench = new SimpleBench;
$bench->setN( 50000 );

$bench->iterate( 'func' , 'direct function call' , function() {
    foo(1);
});

$bench->iterate( 'sfunc' , 'static function call' , function() {
    TestCall2::foo(1);
});

$bench->iterate( 'method' , 'testing normal method call' , function() use ($testCall) {
    $testCall->normal(1);
});

$result = $bench->compare();
echo $result->output('console');
```


```php
<?php
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
    

json\_encode, yaml\_emit, syck\_dump:

    n=60000
    
                         Rate     Mem   json_en   yaml_emit   syck_dump
       json_en          64K/s      0B        --        -20%        -15%
     yaml_emit          13K/s      0B      478%          --        -72%
     syck_dump           9K/s      0B      659%        137%          --
