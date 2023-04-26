<?php

use core\Additional;

$page_title =   "Add Employee";
core('Additional');
$additional =   new Additional($config);
$cities =   $additional->getCities();
$banks  =   $additional->getBanks();
$args['cities'] =   $cities;
$args['banks'] =   $banks;
$args['categories'] =   [
            'family'                =>                  'Family Member',
            'friend'                =>                  'Friend',
            'relative'              =>                  'Relative',
            'other'                 =>                  'Other',
];
if (isset($_GET['errors'])){
    $args['errors'] =   unserialize(urldecode($_GET['errors']));
}
view("beneficiaries", "add", $args);
?>