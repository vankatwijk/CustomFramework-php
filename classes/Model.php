<?php

abstract class Model{
    protected $dbh;
    protected $stmt;

    public function __construct(){
        $this->dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER,DB_PASS);
    }

    //prepare the sql query
    public function query($query){
        $this->stmt = $this->dbh->prepare($query);
    }

    //replace any variables in the sql query before executing
    public function bind($param,$value,$type = null){
        if(is_null($type)){
            switch(true){
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                case is_null($value):
                    $type =  PDO::PARAM_NULL;
                    break;
                    default;
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    //execute the sql query
    public function execute(){
        return $this->stmt->execute();
    }

    public function rollback(){
        return $this->stmt->rollback();
    }

    public function resultSet(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function lastInsertId(){
        return $this->dbh->lastInsertId();
    }
}

?>