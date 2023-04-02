<?php 
$page_title =   "Vendors";
// $page_desc =    "The list of vendors";
// $page_keywords = "vendors, list";
models('Vendors');
$vendors   =   new Vendors($config);
$args['vendors']   =   $vendors->all();
view("vendors","index", $args);
?>