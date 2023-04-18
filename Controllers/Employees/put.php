<?php
echo "<pre>";
    var_dump($_POST);
echo "</pre>";
core('Validator');
// foreach($_POST as $name=>$value){
//     Validator::chkEmpty($name, $value);
// }

if (empty($errors)){
    models('Employees');
    $employee_model =   new Employees($config);
    $response       =   $employee_model->update($_POST);
    header("Location: /employee?id={$_POST['employee_id']}");
}
else{
    header("location: /edit-employee?employee_id={$_POST['employee_id']}&&errors=".urlencode(serialize($errors)));
}

?>