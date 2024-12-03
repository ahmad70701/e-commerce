<?php
const BASE_PATH = __DIR__.'/../';
require BASE_PATH . '/vendor/autoload.php';
require BASE_PATH.'/core/UtilitiesFunctions.php';
require base_path('/core/Validator.php');
require base_path('/core/Middleware/Middleware.php');
require base_path('/core/Router.php');
$validator = new Validator();

$router = new Router();
require base_path('/routes.php');
$middleware = new Middleware();
require base_path('/core/Config.php');
require base_path('/core/DBconfig.php');
$db = new DBconfig();
$database = $db->connect();


$requestInfo = getRequestInfo();
echo $router->route($requestInfo);

