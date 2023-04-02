<?php

use core\Additional;

$page_title =   "Add Employee";
core('Additional');
$additional =   new Additional($config);
$cities =   $additional->getCities();
$banks  =   $additional->getBanks();
$categories  =   $additional->getEmployeeCategory();
$args['cities'] =   $cities;
$args['banks'] =   $banks;
$args['categories'] =   $categories;
if (isset($_GET['errors'])){
    $args['errors'] =   unserialize(urldecode($_GET['errors']));
}
view("employees", "add", $args);
?>