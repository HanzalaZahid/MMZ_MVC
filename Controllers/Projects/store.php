<?php 
core('Validator');
foreach($_POST as $name  =>    $value){
    if (strtolower($name)   !=  'submit'){
        Validator::chkEmpty($name, $value);
    }
}
if (empty($errors)){
    models('Projects');
    $projects  =  new Projects($config);
    $response   =   $projects->add($_POST);
    header('location: /project?id='.$response);
}else{
    header('location: /add-project?errors='.urlencode(serialize($errors)));
}
?>