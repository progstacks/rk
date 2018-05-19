<?php

namespace rk\base\controller;
use rk\App;
use rk\helper\ClassLoader;
use rk\exception\ControllerActionNotFoundException;
class Router
{
    private $ctrl = null;
    function __construct(){
        App::loadUserRequest();
        App::loadEnvironmentConfig();
    }
    public function getRequestController(){
        $defaultController = App::getDefaultController();
        $request = App::getRequest();
        $ctrlr = $request[0].'Controller';
        $ctrlr2 = ClassLoader::getClassByPath('app\common\controller',$ctrlr);
        $controller = $request[0]===""?$defaultController: $ctrlr2;
        return $controller;
    }
    public function getRequestAction($object){
        $request = App::getRequest();
        $action = strtolower(isset($request[1])?$request[1]:'index').'Action';
        $methodExist = method_exists($object,$action);
        if(!$methodExist){
            throw new ControllerActionNotFoundException($action .' action not found');
        }else{
            return $action;
        }
    }

    public function getMethodParameters($funcName){
        $f = new ReflectionFunction($funcName);
        $result = array();
        foreach ($f->getParameters() as $param) {
            $result[] = $param->name;   
        }
        return $result;
    }
}