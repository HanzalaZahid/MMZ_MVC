<?php

use core\Additional;
$args   =   [];
$page_title =   "Edit Project";
if (isset($_GET['project_id'])){
    models('Clients');
    models('Projects');
    // GETTING PROJECT DETIALS
    $project_id =   $_GET['project_id'];
    $projectModel   =   new Projects($config);
    $project        =   $projectModel->get($project_id);
    $args['project']    =   $project;
    core('Additional');
    $args['head']['scripts']    =   "projects";
    // GETR CLIENTS
    $_clients    =   new Clients($config);
    $clients    =    $_clients->all();
    $args['clients']    =   $clients;
    // GET CITIES
    $_cities    =   new Additional($config);
    $cities    =    $_cities->getCities();
    $args['cities'] =   $cities;
    // SET ERRORS
    if (isset($_GET['errors'])){
        $errors = unserialize(urldecode($_GET['errors']));
        $args['errors']  =   $errors;
    }
}   else{
    abort();
}
// CALL VIEW
view("projects", "add", $args);
?>