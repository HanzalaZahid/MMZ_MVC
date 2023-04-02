<?php 
$page_title =   "Employee";
if (isset($_GET['id'])  &&  !empty($_GET['id'])){
    models('Employees');
    $employees  =   new Employees($config);
    $args['employee']   =   $employees->get($_GET['id']);
    if (empty($args['employee'])){
        abort();
    }
}else{
    abort();
}
view("employees", "show", $args);
?>