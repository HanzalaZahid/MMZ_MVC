<?php
$project_id =   $_POST['project_id'];
models('ProjectTeams');
$projectTeamsModel  =   new ProjectTeams($config);
$projectTeamsModel->destroy($project_id);
foreach($_POST['employee'] as $name => $value){
    if(!empty($value)){
        $projectTeamsModel->add($value, $project_id);
    }
}
header("Location: /project?id={$project_id}")
?>