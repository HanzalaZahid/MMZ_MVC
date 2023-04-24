<?php 
$page_title =   "Employee";
if (isset($_GET['id'])  &&  !empty($_GET['id'])){
    models('Employees');
    models('ProjectTeams');
    $employees  =   new Employees($config);
    $args['employee']   =   $employees->get($_GET['id']);
    $projectTeams       =   new ProjectTeams($config);
    $projectsDone       =   $projectTeams->getProjectsBy($_GET['id']);
    $args['projects']   =   $projectsDone;
    if (empty($args['employee'])){
        abort();
    }
}else{
    abort();
}
view("employees", "show", $args);
?>