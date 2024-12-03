<?php
use MongoDB\Client;
use MongoDB\Driver\Exception\ConnectionTimeoutException;
class DBconfig{

    protected $uri = '';
    protected $dbName = '';
    function getConnectionParameters(){

    }
    function connect(){
        global $configs;
        $this->uri = $configs['URI'];
        $this->dbName = $configs['DBNAME'];
        try {
            $client = new Client($this->uri);
            $db = $client->selectDatabase($this->dbName);
            $command = new MongoDB\Driver\Command(['ping' => 1]);
            $db->command($command);
            return $db;
        } catch (ConnectionTimeoutException $e) {
            exit('cant connect to db');
        }
    }

    
}



