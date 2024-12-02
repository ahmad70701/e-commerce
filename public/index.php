<?php
const BASE_PATH = __DIR__.'/../';
require BASE_PATH.'/core/UtilitiesFunctions.php';
require base_path('/core/Router.php');
require base_path('/routes.php');

$router = new Router();
$router->addRoutes($routes);

$requestInfo = getRequestInfo();
echo $router->route($requestInfo);


