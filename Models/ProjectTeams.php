<?php
use core\Database;
class ProjectTeams extends core\Database{
    public function __construct($config)
    {
        parent::__construct($config);
    }
    public function all(){
        $query =    "SELECT * FROM project_teams as pt
                    LEFT JOIN projects as p
                    ON p.project_id             =           pt.project_id
                    LEFT JOIN employees as e
                    ON e.employee_id            =           pt.employee_id";
        return $this->fetchAllOrAbort($query);
    }
    public function get($project_id){
        $query =    "SELECT * FROM project_teams as pt
                    LEFT JOIN employees as e
                    ON e.employee_id            =           pt.employee_id
                    LEFT JOIN employee_categories as ec
                    ON ec.employee_category_id  =           e.employee_category
                    WHERE project_id            =           :project_id";
        $args   =   ['project_id'   =>  $project_id];
        return $this->fetchAllOrAbort($query, $args);
    }
    
    public function destroy($project_id){
        $query =    "DELETE FROM project_teams
                    WHERE
                    project_id  =   :project_id";
        $args   =   [
            'project_id'        =>  $project_id
        ];
        $this->deleteOrAbort($query, $args);
    }
    public function add($employee_id, $project_id){
        if ($this->checkExisting($project_id, $employee_id)){
            return;
        }
        $query  =   "INSERT INTO `project_teams`
                    (`project_id`, `employee_id`) 
                    VALUES 
                    (:project_id,:employee_id)";
        $args   =   [
                    'project_id'    =>  $project_id,
                    'employee_id'   =>  $employee_id
        ];
        $this->insertOrAbort($query, $args);
    }
    public function checkExisting($project_id, $employee_id){
        $query  =   "SELECT * FROM project_teams
                    WHERE
                    project_id  =   :project_id AND employee_id =   :employee_id";
        $args   =   [
                'project_id'    =>$project_id,
                'employee_id'   =>$employee_id
        ];
        return $this->fetchOrAbort($query, $args);
    }
    public function getProjectsBy($employee_id){
        $query = "SELECT * FROM project_teams as pt LEFT JOIN projects as p ON pt.project_id    =   p.project_id WHERE pt.employee_id   =   :employee_id";
        $args  = ['employee_id'=>$employee_id];
        return $this->fetchAllOrAbort($query, $args);
    }
}
?>