<?php
const BASE_PATH = __DIR__.'/../';
require BASE_PATH.'/core/UtilitiesFunctions.php';
require base_path('/core/Middleware/Middleware.php');
require base_path('/core/Router.php');
$router = new Router();
require base_path('/routes.php');
$middleware = new Middleware();


$requestInfo = getRequestInfo();
echo $router->route($requestInfo);


