<?php
namespace core;
use PDO;
use PDOException;
class Database{
    protected $conn;
    protected function __construct($config){
        $dsn    =   'mysql:' .   http_build_query($config['database'],'',';');
        $this->conn =   new PDO($dsn);
        $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }
    protected function query($sql, $args){
        $stmt   =   $this->conn->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }
    private function abort($message = "", $code    =   404){
        http_response_code($code);
        $args['message']  =   $message;
        view("Errors", $code, $args);
        die();
    }
    protected function insertOrAbort($query, $args =   []){
            $response   =   $this->query($query, $args);
            if($this->conn->lastInsertId()  === false){
                $this->abort("Error triggered from InsertOrAbort");
            }
            return $this->conn->lastInsertId();
    }
    protected function fetchAllOrAbort($query, $args =   []){
        try{
            $response   =   $this->query($query, $args);
            $result     =   $response->fetchAll();
            return $result;
        }catch(PDOException $e){
            $this->abort($e->getMessage());
        }
    }
    protected function fetchOrAbort($query, $args =   []){
            $response   =   $this->query($query, $args);
            $result     =   $response->fetch();
            if (empty($result)){
                $this->abort("No Records Found.");
            }
            return $result;
    }
    protected function getLastInsertedId(){
        return $this->conn->lastInsertId();
    }
}
?>