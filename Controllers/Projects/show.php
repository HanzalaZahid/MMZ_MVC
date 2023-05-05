<?php 
$page_title =   "Project";
if(isset($_GET['id'])){
    $id =   $_GET['id'];
} else{
    abort();
}
models('Projects');
models('ProjectTeams');
$projects   =   new Projects($config);
$project    =   $projects->get($id);
$projectTeams   =   new ProjectTeams($config);
$team           =   $projectTeams->get($id);
$investment =   $projects->getInvestment($id);
$args['project'] =   $project;
$args['team'] =   $team;
$args['investment'] =   $investment;
$args['head']['scripts']    =   'uploadFiles';
view("projects", "show", $args);
?>