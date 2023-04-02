<?php 
$page_title =   "Employees";
models('Employees');
$_employees  =   new Employees($config);
$employees  =   $_employees->all();
$args['employees']  =   $employees;
view("Employees", "index", $args);
?>