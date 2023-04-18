<?php
// namespace models;
use core\Database;
class Clients extends Database{
    public function __construct($config)
    {
        parent::__construct($config);
    }
    public function all(){
        $query    =   "Select * from Clients 
        LEFT JOIN cities            ON          client_city             =           city_id 
        LEFT JOIN provinces         ON          city_province           =           province_id
        WHERE
        active                      =           true";
        return   $this->fetchAllOrAbort($query);
    }
    public function get($id){
        $query    =   "Select * from Clients 
        LEFT JOIN cities            ON          client_city             =   city_id 
        LEFT JOIN provinces         ON          city_province           =   province_id  
        WHERE client_id             =           :client_id
        AND
        active                      =           true";
        $args       =   [
            'client_id'             =>          $id
        ];
        return   $this->fetchOrAbort($query, $args);
    }
    public function add($data){
        extract($data);
        $query  =   "INSERT INTO `clients`(
            `client_name`, 
            `client_type`, 
            `client_address`, 
            `client_city`, 
            `client_cell_primary`, 
            `client_cell_secondary`
            ) 
            VALUES (
            :name,
            :type,
            :address,
            :city,
            :cell1,
            :cell2
            )";
        $args   =   [
            'name'                  =>          $name,
            'type'                  =>          $type,
            'address'               =>          $address,
            'city'                  =>          $city,
            'cell1'                 =>          $cell1,
            'cell2'                 =>          $cell2,
        ];
        return $this->insertOrAbort($query, $args);
    }
    public function put($data){
        extract($data);
        $query  =   "UPDATE `clients`
        SET 
        `client_name`               =           :name,
        `client_type`               =           :type,
        `client_address`            =           :address,
        `client_city`               =           :city,
        `client_cell_primary`       =           :cell1,
        `client_cell_secondary`     =           :cell2 
        WHERE client_id             =           $client_id;
        ";
        $args   =   [
            'name'                  =>          $name,
            'type'                  =>          $type,
            'address'               =>          $address,
            'city'                  =>          $city,
            'cell1'                 =>          $cell1,
            'cell2'                 =>          $cell2,
        ];
        return $this->insertOrAbort($query, $args);
    }
    public function destroy($client_id){
        $query  =   "UPDATE Clients SET
                    active          =           false
                    WHERE
                    client_id       =           :client_id";
        $args   =   [
                    'client_id'     =>          $client_id
        ];
        $response   =   $this->updateOrAbort($query, $args);
        return $response;
    }
}
?>