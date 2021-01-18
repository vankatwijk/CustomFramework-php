<?php
class Database{
    private $host = 'localhost';
    private $user = 'mysqldb';
    private $pass = 'justconnect1';
    private $dbname = 'myblog';

    private $dbh;
    private $error;
    private $stmt;

    public function __construct(){
        //set DSN
        $dsn = 'mysql:host'. $this->host . ';dbname='.$this->dbname;

        //set options
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        //create new pdo
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        }catch(PDOEception $e){
            $this->error = $e->getMessage();
        }
    }
}