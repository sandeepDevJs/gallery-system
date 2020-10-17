<?php

require_once("config.php");

class Database
{

    public $connection;

    public function __construct()
    {

        $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($this->connection->connect_errno) {
            die("Database Connection Failed!!!<br>". $this->connection->connect_error);
        }

    }

    public function query($sql)
    {
        $result = $this->connection->query($sql);
        if($this->connection->error){
            die("Query Failed!! <br> ".$this->connection->error);
        }
        return $result;
    }

    public function escape_string($string){
       return $this->connection->real_escape_string($string);
    }

    public function the_insert_id(){
        return $this->connection->insert_id;
    }
}
$db = new Database();
