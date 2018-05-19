<?php

namespace rk;

use rk\core\Rk;

/**
 * @method $this->setName()
 */
class App extends Rk
{
    private $matched = false;
    public function __construct($config)
    {
        $this->config = $config;
        $this->loadUserRequest();
    }

    public function start()
    {

    }

    /**
     * Allows you to set the specific callback based on GET URL.
     * @example
     * $app->get('home/login',function($request,$response){
     *      echo 'home/login';
     * });
     * @param $filter is a string prefix of the URL
     * @param $func is a callable or function to be executed 
     *              when $filter matches the URL prefix
     */
    public function get($filter = '', callable $func = null)
    {
        if (!$this->matched && $this->isGet()) {
            $url = $this->getRequestUrl();
            $request = [];
            $reponse = [];
            $filterLen = strlen($filter);
            $filterPost = substr($url, 0, $filterLen);
            if ($filterPost === $filter) {
                call_user_func($func, $request, $reponse);
                $this->matched = true;
            }
        }
    }
    /**
     * Allows you to set the specific callback based on POST URL.
     * @example
     * $app->post('home/login',function($request,$response){
     *      echo 'home/login';
     * });
     * @param $filter is a string prefix of the URL
     * @param $func is a callable or function to be executed 
     *              when $filter matches the URL prefix
     */
    public function post($filter = '', callable $func = null)
    {
        if (!$this->matched && $this->isPost()) {
            $url = $this->getRequestUrl();
            $request = [];
            $reponse = [];
            $filterLen = strlen($filter);
            $filterPost = substr($url, 0, $filterLen);
            if ($filterPost === $filter) {
                call_user_func($func, $request, $reponse);
                $this->matched = true;
            }
        }
    }
}
