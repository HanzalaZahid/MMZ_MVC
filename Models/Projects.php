<?php 
use core\Database;

class Projects extends Database{
    public function __construct($config){
        parent::__construct($config);
    }
    public function all(){
        $query  =   "select * from projects left join cities on project_city   =   city_id left join clients on project_client =   client_id left join provinces on city_province   =   province_id";
        return $this->fetchAllOrAbort($query);
    }
    public function get($id){
        $query  =   "select * from projects left join cities on project_city   =   city_id left join clients on project_client =   client_id left join provinces on city_province   =   province_id where project_id    =   :id";
        $args   =   [
            'id'    =>   $id
        ];
        return $this->fetchOrAbort($query, $args);
    }
    public function add($data){
        extract($data);
        $query  =   "INSERT INTO `projects`(`project_name`, `project_client`, `project_city`,`project_location`, `project_start_date`, `project_end_date`) VALUES (:project_name,:project_client,:project_city,:project_location,:project_start_date,:project_end_date)";
        $args   =   [
            'project_name'=>$data['project_name'],
            'project_client'=>$data['client'],
            'project_city'=>$data['city'],
            'project_location'=>$data['location'],
            'project_start_date'=>$data['start_date'],
            'project_end_date'=>$data['end_date']
        ];
        return $this->insertOrAbort($query, $args);
    }
}
?>