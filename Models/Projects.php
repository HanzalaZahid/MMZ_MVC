<?php 
use core\Database;

class Projects extends Database{
    public function __construct($config){
        parent::__construct($config);
    }
    public function all(){
        $query  =   "SELECT * FROM projects 
        LEFT JOIN           cities              ON          project_city                 =              city_id 
        LEFT JOIN           clients             ON          project_client               =              client_id 
        LEFT JOIN           provinces           ON          city_province                =              province_id
        WHERE
        projects.active              =                   true";
        return $this->fetchAllOrAbort($query);
    }
    public function get($id){
        $query  =   "SELECT * FROM projects 
        LEFT JOIN cities                        ON          project_city                =              city_id 
        LEFT JOIN clients                       ON          project_client              =              client_id 
        LEFT JOIN provinces                     ON          city_province               =              province_id 
        WHERE 
        project_id                              =           :id
        AND
        projects.active                         =           true";
        $args   =   [
            'id'    =>   $id
        ];
        return $this->fetchOrAbort($query, $args);
    }
    public function destroy($project_id){
        $query  =   "UPDATE projects SET
                    active                  =               :value
                    WHERE
                    project_id              =               :project_id";
        $args   =   [
                    'value'                 =>              false,
                    'project_id'            =>              $project_id
        ];
        return $this->updateOrAbort($query, $args);
    }
    public function getInvestment($project_id){
        $query  =   "SELECT SUM(transaction_detail_amount) as total 
                    FROM transaction_details 
                    WHERE transaction_detail_project        =           :project_id";
        $args   =   [
            'project_id'            =>          $project_id
        ];
        $response   =   $this->fetchOrAbort($query, $args);
        $investment =   $response['total'];
        if ($investment ==  NULL){
            $investment =   0.00;
        }
        return  $investment;
    }
    public function update($data){
        extract($data);
        $query  =   "UPDATE `projects` SET 
            `project_name`                          =           :project_name,
            `project_client`                        =           :project_client,
            `project_city`                          =           :project_city,
            `project_location`                      =           :project_location,
            `project_start_date`                    =           :project_start_date,
            `project_end_date`                      =           :project_end_date 
            WHERE project_id                        =           :project_id";
        $args   =   [
            'project_name'                          =>          $data['project_name'],
            'project_client'                        =>          $data['client'],
            'project_city'                          =>          $data['city'],
            'project_location'                      =>          $data['location'],
            'project_start_date'                    =>          $data['start_date'],
            'project_end_date'                      =>          $data['end_date'],
            'project_id'                            =>          $data['project_id']
        ];
        return $this->insertOrAbort($query, $args);
    }
    public function add($data){
        extract($data);
        $query  =   "INSERT INTO `projects`
        (
            `project_name`, 
            `project_client`, 
            `project_city`,`
            `project_location`, 
            `project_start_date`, 
            `project_end_date`
            ) VALUES (
            :project_name,
            :project_client,
            :project_city,
            :project_location,
            :project_start_date,
            :project_end_date)";
        $args   =   [
            'project_name'                      =>          $data['project_name'],
            'project_client'                    =>          $data['client'],
            'project_city'                      =>          $data['city'],
            'project_location'                  =>          $data['location'],
            'project_start_date'                =>          $data['start_date'],
            'project_end_date'                  =>          $data['end_date']
        ];
        return $this->insertOrAbort($query, $args);
    }
}
?>