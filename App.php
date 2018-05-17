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
        echo $this->getName();
    }
}


