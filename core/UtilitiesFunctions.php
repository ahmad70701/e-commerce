<?php

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

function print__r($data){
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}
function responseBuilder($httpCode,$response){
    http_response_code($httpCode);
    header('Content-Type: application/json');
    return json_encode($response);
}

function getRequestInfo(){
    return [
        'uri' => $_SERVER['PATH_INFO'] ?? '/',
        'method' => $_SERVER['REQUEST_METHOD'] ?? '',
        'query' => $_SERVER['QUERY_STRING']??''
    ];
}
function getRequestMethod(){
    return parse_url($_SERVER['PATH_INFO']);
}
function getRequestBodyData(){
    $data = [];
    foreach($_POST as $key=>$value){
        $data[$key]= htmlspecialchars(trim($value));
    }
    return $data;
}

function uploadFile($field,$uploadPath,$namePrefix,$fileTypes,$fileExtensions,$fileSize,$responseData){
    global $validator;

    $files = [];
    $filePaths = [];
    $totalFiles = count($_FILES[$field]['name']);
    for ($i=0; $i < $totalFiles;$i++){
        $files[$i]['name'] = $_FILES[$field]['name'][$i];
        $files[$i]['full_path'] = $_FILES[$field]['full_path'][$i];
        $files[$i]['type'] = $_FILES[$field]['type'][$i];
        $files[$i]['tmp_name'] = $_FILES[$field]['tmp_name'][$i];
        $files[$i]['error'] = $_FILES[$field]['error'][$i];
        $files[$i]['size'] = $_FILES[$field]['size'][$i];
    }
    foreach($files as $key=>$file){
        $validator->validateFile($field, $file, $fileTypes, $fileExtensions, $fileSize);
        $uploadDir = base_path($uploadPath);
        $fileTmpPath = $file['tmp_name'];
        $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $fileName = $namePrefix.$key.'.'.$fileExtension;
        $targetFilePath = $uploadDir.$fileName;
        $filePaths[] = $uploadPath.$fileName;
        if (!move_uploaded_file($fileTmpPath, $targetFilePath)) {
            array_push($responseData['errors']['server']['image'], "error uploading file!");
        }
    }
    return $filePaths;

}
