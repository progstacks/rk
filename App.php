<?php

namespace rk;
use rk\core\Rk;
/**
 * @method $this->setName()
 */
class App extends Rk
{
    public function __construct($config)
    {
        $this->config = $config;
    }

    public function start(){
        
    }

    public function get($filter, callable $func=null){
        $url = $this->getRequestUrl();
        
        if(strpos($url,$filter)==0){
            call_user_func($func,[$request,$reponse]);
        }        
    }
}


