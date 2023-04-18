<?php
if(isset($_GET['id'])   &&  !empty($_GET['id'])){
    $project_id         =           $_GET['id'];
    models('Projects');
    $projectModel       =           new Projects($config);
    $response           =           $projectModel->destroy($project_id);
    if ($response       !=          0){
        header('Location: /projects?msg=Project Deleted Successfully');
    }else{
        header('Location: /projects?msg=No Project Found');
    }
}else{
    abort("", 403);
}
?>