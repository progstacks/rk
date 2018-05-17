<?php
spl_autoload_register(function ($class) {

    if(file_exists( __DIR__.'\\..\\'. $class .'.php')){
        include __DIR__.'\\..\\'. $class .'.php';
    }elseif(file_exists( __DIR__.'\\..\\..\\'. $class .'.php')){
        include  __DIR__.'\\..\\..\\'. $class .'.php';
    }elseif(file_exists( __DIR__.'\\..\\..\\..\\'. $class .'.php')){
        include  __DIR__.'\\..\\..\\..\\'. $class .'.php';
    }
    
});