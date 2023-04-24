<?php
if (isset($_GET['project_id'])  &&  !empty($_GET['project_id'])){
    models('Projects');
    $projectsModel  =   new Projects($config);
    if (!$projectsModel->get($_GET['project_id'])){
        abort("Project Not Found");
    }
    models('Employees');
    models('ProjectTeams');
    
    $employeesModel =   new Employees($config);
    $employees      =   $employeesModel->all();
    $projectTeamsModel  =   new ProjectTeams($config);
    $team               =   $projectTeamsModel->get($_GET['project_id']);
    $args['employees']  =   $employees;
    $args['team']  =   $team;
    $args['project_id']  =   $_GET['project_id'];
    view('projects\teams', 'add', $args);
} else{
    abort(403);
}
?>