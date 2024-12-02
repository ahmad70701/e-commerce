<?php

use Core\Response;

function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";

    die();
}
function getRequestQuery(){
    return $_SERVER['QUERY_STRING'];
}

function abort($code = 404)
{
    http_response_code($code);

    require base_path("views/{$code}.php");

    die();
}

function authorize($condition, $status = Response::FORBIDDEN)
{
    if (! $condition) {
        abort($status);
    }

    return true;
}

function base_path($path)
{
    return BASE_PATH . $path;
}

function view($path, $attributes = [])
{
    extract($attributes);

    require base_path('views/' . $path);
}

function redirect($path)
{
    header("location: {$path}");
    exit();
}


function responseBuilder($httpCode,$response){
    http_response_code($httpCode);
    header('Content-Type: application/json');
    return json_encode($response);
}

function getRequestInfo(){
    return [
        'path' => $_SERVER['PATH_INFO'] ?? '/',
        'method' => $_SERVER['REQUEST_METHOD'] ?? '',
        'query' => $_SERVER['QUERY_STRING']??''
    ];
}
function getRequestMethod(){
    return parse_url($_SERVER['PATH_INFO']);

}