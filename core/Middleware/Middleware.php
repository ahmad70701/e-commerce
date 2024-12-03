<?php


class Middleware{
    protected $middlewares = [
        'auth'=>'/core/Middleware/AuthMiddleware.php',
        'jwt'=>'/core/Middleware/HandleJWT.php',
    ];

    function handleMiddleware($key){
        return require base_path($this->middlewares[$key]);
    }
}