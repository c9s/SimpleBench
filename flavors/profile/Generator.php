<?php
namespace profile;
use GenPHP\Flavor\BaseGenerator;

class Generator extends BaseGenerator 
{

    function brief()
    {
        return 'profile';
    }


    function generate($name) 
    {
        $this->render( 'profile.php.twig' , 'profiling/' . $name . '.php', array( 
            'name' => $name,
        ));
    }

}

