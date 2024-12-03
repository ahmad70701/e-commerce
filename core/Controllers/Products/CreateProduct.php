<?php 
global $database;
global $validator;
$collection = $database->selectCollection('products');

$responseData = ['data' => [],'errors'=>['server'=>[],'validation'=>[]],'status'=>''];

$formData = getRequestBodyData();//sanitized form data

$name = $formData['name']??'';
$price = $formData['price']??'';
$category = $formData['category']??'';
$discount = $formData['discount']??'';
$stock = $formData['stock']??'';
$description = $formData['description']??'';
$tags = $formData['tags']??'';

$alreadyExists = $collection->findOne(['name' => $name]);
if($alreadyExists){
    $responseData['errors']['validation'] = ['name'=>'Product already Exists'];
    $responseData['status'] = 409;
    return responseBuilder($responseData['status'], $responseData);
}
$imageURI = uploadFile('image', 
    '/public/img/products/',
    str_replace(' ','_','product-'.$name.'-'),
    ['image/jpeg', 'image/png'],
    ['jpg', 'jpeg', 'png'],
    2 * 1024 * 1024,
    $responseData
);
$validator->required('name', $name);
$validator->required('price', $price);
$validator->numeric('price', $price);
$validator->numeric('discount', $discount);
$validator->numeric('stock', $stock);
$responseData['errors']['validation'] = $validator->getErrors();

if(count($responseData['errors']['validation'])>0){
    $responseData['status'] = 400;
    return responseBuilder($responseData['status'],$responseData);
}

$result = $collection->insertOne([
    'name' => $name,
    'price' => $price,
    'category' => $category,
    'discount' => $discount,
    'stock' => $stock,
    'description' => $description,
    'tags' => $tags,
    'image' => $imageURI,
    'created_at' => new MongoDB\BSON\UTCDateTime(),
    'updated_at' => new MongoDB\BSON\UTCDateTime()
]);

if($result->isAcknowledged()){
    $responseData['data']['productID'] = $result->getInsertedId();
}else{
    $responseData['errors']['server'] = ["Could not add the entry"];
    return responseBuilder(500,$responseData);
}
return responseBuilder(200,$responseData);