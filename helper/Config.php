<?php

namespace rk\helper;

class Config
{
    
    static $_config = [];
    static function getConfig($key='',$config=[]){
        if($key===''){
            return Config::$_config;
        }elseif(count($config)>0){
            return $config[$key];
        }else{
            return Config::$_config[$key];
        }
    }
    static function setConfig($config){
        Config::$_config =$config;
    }
}