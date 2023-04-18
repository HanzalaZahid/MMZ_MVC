<?php
if(isset($_GET['id'])   &&  !empty($_GET['id'])){
    $employee_id  =   $_GET['id'];
    models('Employees');
    $employeesModel    =  new Employees($config);
    $response        =  $employeesModel->destroy($employee_id);
    if($response    !=  0){
        header('Location: /employees');
    }else{
        header('Location: /employees?msg=No Employee Found');
    }
} else{
    abort("",403);
}
?>