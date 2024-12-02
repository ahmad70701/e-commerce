<?php
class Router{
    protected $routes = [];
    function addRoutes($routes){
        $this->routes=$routes;
    }
    function route($request){
        if(key_exists($request['path'],$this->routes[$request['method']])){
            return require base_path($this->routes[$request['method']][$request['path']]['path']);            
        }else{
            return responseBuilder('404', 'endpoint not found');
        }
    }
}


