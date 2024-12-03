<?php
$router->get('/api/products','products.php')->withMiddleware('jwt');
$router->get('/api/users','users.php')->withMiddleware('jwt');
