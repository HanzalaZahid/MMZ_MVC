<?php 
$page_title =   "Projects";
$args   =   [];
models('Projects');
$_projects  =  new Projects($config);
$projects   =   $_projects->all();
if (!empty($projects)){
    $args['projects']    =   $projects;
    $investment =   array();
    foreach($projects as $project){
        array_push($investment, $_projects->getInvestment($project['project_id']));
    }
    $args['investment'] =   $investment;
}
view("projects", "index", $args);
?>