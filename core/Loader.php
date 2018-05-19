<?php

namespace rk\core;
use rk\helper\Config;
class Loader
{
    private $_get = [];
    private $_post = [];
    private $_server = [];
    public function __construct()
    {
        $this->loadUserRequest();
    }
    public function loadConfig($config)
    {
        Config::setConfig($config);
    }
    /**
     * Merges the $_POST, $_GET and $_SERVER global arrays into $_request
     * @return null
     */
    public function loadUserRequest()
    {
        foreach ($_POST as $key => $value) {
            $this->_post[$key] = trim($value);
        }
        foreach ($_GET as $key => $value) {
            $this->_get[$key] = trim($value);
        }
        foreach ($_SERVER as $key => $value) {
            $this->_server[$key] = trim($value);
        }
        $this->_request = array_merge($this->_post, $this->_get);
    }
    public function isPost()
    {
        return $this->_server['REQUEST_METHOD'] === 'POST';
    }
    public function isGet()
    {
        return $this->_server['REQUEST_METHOD'] === 'GET';
    }
    public function getRequestUrl()
    {
        return $this->_server['QUERY_STRING'];
    }

    public function __call2($method, $params)
    {

        $var = lcfirst(substr($method, 3));

        if (strncasecmp($method, "get", 3) === 0) {
            return $this->$var;
        }
        if (strncasecmp($method, "set", 3) === 0) {
            $this->$var = $params[0];
        }
    }
    public function getName()
    {
        return Config::getConfig('name');
    }
}
