<?php

namespace app\base\util;
use rk\exception\ConfigNotSetException;
class ClassLoader
{
    /**
     * Returns the class path from $config of the given $key
     * @param $config mix array that contains the class defination
     * @param $key name of the key.
     */
    public static function getClass($config, $key)
    {
        if (!isset($config[$key])) {
            throw new ConfigNotSetException('$config["'.$key.'"] config is missing');
        } elseif (!isset($config[$key]['class'])) {
            throw new ConfigNotSetException('$config["'.$key.'"]["class"] config is missing');
        } elseif (!isset($config[$key]['namespace'])) {
            throw new ConfigNotSetException('$config["'.$key.'"]["namespace"] config is missing');
        } else {
            $router = $config[$key];
            $namespace = $router['namespace'];
            $class = $router['class'];
            $loadable = $namespace . '\\' . $class;
            return $loadable;
        }
    }
    public static function getClassByPath($namespace, $class)
    {
            $loadable = $namespace . '\\' . $class;
            return $loadable;
    }
    
}
