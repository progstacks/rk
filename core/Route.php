<?php

namespace rk\core;
use rk\helper\Config;
class Route
{
    private $_url = '';
    private $_config = [];
    public function __construct($url)
    {
        $this->_url = $url;
        $this->_config = Config::getConfig();
    }
    public function getAction(){
        $url = explode('/', $this->_url);
        $action = isset($url[1])?$url[1]:'index';
        $indexAction =$action==""?'index':$action;
        $action = $indexAction.'Action';
        return $action;
    }
    public function getController()
    {
        $ctrlFromURL = explode('/', $this->_url)[0];
        $parseController = strtoupper(substr($ctrlFromURL, 0, 1)) . substr($ctrlFromURL, 1, strlen($ctrlFromURL));
        $parseController = $parseController !== '' ? $parseController . 'Controller' : $this->getDefaultController();
        $env = $this->_config['env'] . '\\';
        $appDir = $this->_config['base_path'] . '\\' . $this->_config['app_dir'] . '\\';
        $appCommonPath = $appDir . '\common\\';
        $appEnvPath = $appDir . '\environment\\' . $env;
        $envControllerPath = $appEnvPath . '\controller\\' . $parseController . '.php';

        if (file_exists($envControllerPath)) {
            $controller = '\controller\\' . $parseControllers;
            return new $controller();
        }
        $commonControllerPath = $this->_config['base_path'] . '\\' . $this->_config['app_dir'] . '\\common\\controller\\' . $parseController . '.php';

        if (file_exists($commonControllerPath)) {
            $controller = 'controller\\' . $parseController;
            return new $controller();
        }
        $class404 = $this->get404Controller();
        $path = $appDir . '\common\\'.$class404['path'] . $class404['class'];
        $class = $class404['path'] . $class404['class'];
        if (file_exists($path . '.php')) {
            return new $class();
        }
        return null;
    }

    public function get404Controller()
    {
        $default = Config::getConfig('defaults');
        return ['class' => Config::getConfig('defaults')['site404']['class'],
            'path' => Config::getConfig('defaults')['site404']['path']];
    }
    public function getDefaultController()
    {
        return Config::getConfig('defaults')['controller']['class'];
    }
}
