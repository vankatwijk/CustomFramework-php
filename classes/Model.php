<?php

abstract class Model{
    protected $dbh;
    protected $stmt;

    public function __construct(){
        $this->dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER,DB_PASS);
    }
}

?>