<?php

namespace rk\core;
use rk\core\Loader;

class Rk extends Loader
{
    protected $config;
    public function getName(){
        return $this->config['name'];
    }
    public function getDefaultController(){
        return $this->config['defaults'];
    }
}