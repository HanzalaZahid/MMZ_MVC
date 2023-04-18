<?php 
$page_title =   "Project";
if(isset($_GET['id'])){
    $id =   $_GET['id'];
} else{
    abort();
}
models('Projects');
$projects   =   new Projects($config);
$project    =   $projects->get($id);
$investment =   $projects->getInvestment($id);
$args['project'] =   $project;
$args['investment'] =   $investment;
view("projects", "show", $args);
?>