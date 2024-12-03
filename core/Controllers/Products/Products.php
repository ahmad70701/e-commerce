<?php
global $database;
$collection = $database->selectCollection('products')->find([]);
$responseData = ['data' => [],'errors'=>['server'=>[],'validation'=>[]]];

$data = [];
if($collection){
    foreach($collection as $row){
        array_push($responseData['data'], $row);
    }
}  
return responseBuilder('200', $responseData);