<?php

namespace rk\base;
use rk\helper\Config;
class View
{

    static public function render($template,$parameters=[]){
        \ob_start();
        \extract($parameters);
        require View::getTemplate($template);
        return \ob_get_clean();
    }

    public function renderHelloWorld()
    {
        echo "Hello World";
    }
    static private function getTemplate($template){
        if(strpos($template,'.')>0){
            $template = str_replace('.','\\',$template);
        }
        $viewPath = Config::getConfig('base_path').'\\'.Config::getConfig('app_dir').'\environment\\'.Config::getConfig('env').'\view';
        return $viewPath.'\\'.$template.'.php';
    }
}
