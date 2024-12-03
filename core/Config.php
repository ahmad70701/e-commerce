<?php

$file = fopen(base_path('.env'), "r") or die("Unable to open file!");
$fileContents = fread($file,filesize(base_path('.env')));
fclose($file);
$configs = [];
$contentsArray = explode("\n",trim($fileContents));
foreach($contentsArray as $line){
    $newArray = explode(' = ', $line);
    $configs[trim($newArray[0])] = trim($newArray[1]);
}

return $configs;

