<?php 
$page_title =   "Clients";
models("Clients");
$_clients   =   new Clients($config);
$clients    =   $_clients->all();
$args['clients']    =   $clients;
view("clients","index", $args);
?>