<?php
core('Validator');
// foreach($_POST as $name=>$value){
//     Validator::chkEmpty($name, $value);
// }
if(empty($errors)){
    models('Employees');
    $employees   =   new Employees($config);
    $response   =   $employees->add($_POST);
    header('Location: /employee?id='.$response);
}else{
    header('Location: /add-employee?errors='.urlencode(serialize($errors)));
}
?>