<?php
class Database {
    private $host = 'localhost';
    private $user = 'mysqldb';
    private $pass = 'justconnect1';
    private $dbname = 'myblog';

    private $dbh;
    private $error;
    private $stmt;

    public function __construct(){
        //set DSN
        $dsn = 'mysql:host='. $this->host . ';dbname='.$this->dbname;

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

    //get the result in an associated array
    public function resultset(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>