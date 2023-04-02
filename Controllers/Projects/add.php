<?php

use core\Additional;

$args   =   [];
$page_title =   "Add Project";
models('Clients');
core('Additional');
$args['head']['scripts']    =   "projects";
// GETR CLIENTS
$_clients    =   new Clients($config);
$clients    =    $_clients->all();
$args['clients']    =   $clients;
// GET CITIES
$_cities    =   new Additional($config);
$cities    =    $_cities->getCities();
$args['cities'] =   $cities;
// SET ERRORS
if (isset($_GET['errors'])){
    $errors = unserialize(urldecode($_GET['errors']));
    $args['errors']  =   $errors;
}
// CALL VIEW
view("projects", "add", $args);
?>