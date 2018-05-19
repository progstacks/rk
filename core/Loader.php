<?php

namespace rk\core;

class Loader
{
    private $_get=[];
    private $_post=[];
    private $_server=[];
    function __construct(){
        $this->loadUserRequest();
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
    function isPost(){
        return $this->_server['REQUEST_METHOD'] ==='POST'; 
    }
    function isGet(){
        return $this->_server['REQUEST_METHOD'] ==='GET'; 
    }
    function getRequestUrl(){
        return $this->_server['QUERY_STRING'];
    }

    function getController(){
        $parseController = explode('/',$this->_server['QUERY_STRING'])[0];

        return $parseController!==''?$parseController:$this->getDefaultController();
    }
    function __call($method, $params) {

        $var = lcfirst(substr($method, 3));
   
        if (strncasecmp($method, "get", 3) === 0) {
            return $this->$var;
        }
        if (strncasecmp($method, "set", 3) === 0) {
            $this->$var = $params[0];
        }
   }
}