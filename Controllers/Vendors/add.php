<?php

use core\Additional;

$page_title =   "Add Vendor";
core('Additional');
$additional  =   new core\Additional($config);
$banks  =   $additional->getBanks();
$cities =   $additional->getCities();
$args['banks']  =   $banks;
$args['cities']  =   $cities;
if (isset($_GET['errors'])){
    $args['errors']  =   unserialize(urldecode($_GET['errors']));
}
view("vendors","add", $args);
?>