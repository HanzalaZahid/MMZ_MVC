<?php
// namespace models;
use core\Database;
class Clients extends Database{
    public function __construct($config)
    {
        parent::__construct($config);
    }
    public function all(){
        $query    =   "Select * from Clients left join cities on client_city    =   city_id left join provinces on city_province    =   province_id";
        return   $this->fetchAllOrAbort($query);
    }
    public function get($id){
        $query    =   "Select * from Clients WHERE client_id    =   :client_id";
        $args       =   [
            'client_id' =>  $id
        ];
        return   $this->fetchOrAbort($query, $args);
    }
    public function add($data){
        extract($data);
        $query  =   "INSERT INTO `clients`(`client_name`, `client_type`, `client_address`, `client_city`, `client_cell_primary`, `client_cell_secondary`) VALUES (:name,:type,:address,:city,:cell1,:cell2)";
        $args   =   [
            'name'  =>   $name,
            'type'  =>   $type,
            'address'   =>  $address,
            'city'  =>  $city,
            'cell1'  =>  $cell1,
            'cell2'  =>  $cell2,
        ];
        return $this->insertOrAbort($query, $args);
    }
}
?>