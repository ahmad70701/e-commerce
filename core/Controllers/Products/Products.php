<?php
global $database;
$collection = $database->selectCollection('comments');

$data = [];
foreach($collection->find([]) as $row){
    array_push($data, $row);
}
return responseBuilder('200', $data);