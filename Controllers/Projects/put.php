<?php
core('Validator');
// foreach($_POST as $name=>   $value){
//     Validator::chkEmpty($name, $value);
// }
if (empty($errors)){
    models('Projects');
    $projectModel   =   new Projects($config);
    $response       =   $projectModel->update($_POST);
    header('Location: project?id='.urlencode($_POST['project_id']));
} else{
    header("Location: /edit-project?project_id=".urlencode($_POST['project_id'])."&errors=". urlencode(serialize($errors)));
}
?>