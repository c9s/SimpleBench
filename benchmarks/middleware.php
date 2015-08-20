<?php
require( 'tests/bootstrap.php');

$bench = new SimpleBench;
$bench->setN( 50000 );

class App { 
    public function call($env, $res)
    {
        return $res;
    }
}

class TryMiddleware 
{ 
    /**
     * @var Middleware
     */
    public $next;

    public function __construct($next)
    {
        $this->next = $next;
    }

    public function call($env, $res)
    {
        try {
            if ($n = $this->next) {
                $res = $n($env, $res);
            }
            // $res = $next($env, $res);
        } catch (Exception $e) {

        }
        return $res;
    }

    public function __invoke($env, $res)
    {
        $n = $this->next;
        return $n($env, $res);
    }

    public static function wrap($app, $options = array())
    {
        return function($env, $res) use($app) {
            try {
                $res = $app($env, $res);
            } catch (Exception $e) {
            }
            return $res;
        };
    }
}

$bench->iterate('by-closure' , function() {
    $app = function($env, $res) {  
        $res[0] = 200;
        return $res;
    };
    $app = TryMiddleware::wrap($app);
    $app = TryMiddleware::wrap($app);
    $app = TryMiddleware::wrap($app);
    $app = TryMiddleware::wrap($app);
    $app([] , []);
});

$bench->iterate('by-iteration', function() {
    $app = function($env, $res) {  
        $res[0] = 200;
        return $res;
    };
    $m = new TryMiddleware($app);
    $m2 = new TryMiddleware($m);
    $m3 = new TryMiddleware($m2);
    $m4 = new TryMiddleware($m3);
    $m4->call([] , []);
});

$result = $bench->compare();
echo $result->output('console');
