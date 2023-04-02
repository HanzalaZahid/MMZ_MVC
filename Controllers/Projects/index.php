<?php 
$page_title =   "Projects";
$args   =   [];
models('Projects');
$_projects  =  new Projects($config);
$projects   =   $_projects->all();
if (!empty($projects)){
    $args['projects']    =   $projects;
}

view("projects", "index", $args);
?>