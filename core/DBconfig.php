<?php

class DBconfig{

    protected $uri = '';
    function getConnectionParameters(){

    }
    function connect(){
        global $configs;
        $this->uri = $configs['URI'];
        $client = new MongoDB\Client($this->uri);
        $db = $client->selectDatabase('sample_mflix');
        return $db;
    }
    
}



