<?php
class Router{
    protected $routes = [];
    protected function add($uri,$method,$handler){
        $this->routes[] = [
            'uri'=>$uri,
            'method'=>$method,
            'handler'=>$handler,
            'middleware'=>NULL,
        ];
        return $this;
    }
    function withMiddleware($middleware){
        $this->routes[array_key_last($this->routes)]['middleware']=$middleware;
        return $this;
    }
    function get($uri,$handler){
        $this->add($uri, 'GET', $handler);
        return $this;
    }
    function post($uri,$handler){
        $this->add($uri, 'POST', $handler);
        return $this;
    }
    function put($uri,$handler){
        $this->add($uri, 'PUT', $handler);
        return $this;
    }
    function patch($uri,$handler){
        $this->add($uri, 'PATCH', $handler);
        return $this;
    }
    function delete($uri,$handler){
        $this->add($uri, 'DELETE', $handler);
        return $this;
    }
    function route($request){
        foreach($this->routes as $route){
            if($request['uri']===$route['uri'] && $request['method']==$route['method']){
                if($route['middleware']){
                    global $middleware;
                    $middleware->handleMiddleware($route['middleware']);
                }
                return require base_path('/core/Controllers/'. $route['handler']);
            }
        }
        return responseBuilder('404', ['message'=>'endpoint does not exist']);
    }
}


