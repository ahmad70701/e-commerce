<?php
$router->get('/api/products','Products/Products.php');//get a list of all products
$router->post('/api/products','Products/CreateProduct.php');//add a new product
$router->put('/api/products','Products/ReplaceProduct.php');//change a new product details
$router->patch('/api/products','Products/AlterProduct.php');//change some of the details of a product
$router->delete('/api/products','Products/DeleteProduct.php');//delete a product

