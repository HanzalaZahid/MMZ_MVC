<?php 
$page_title =   "Beneficiries";
models('Beneficiaries');
$beneficiaiesModel  =   new Beneficiaries($config);
$beneficiariess  =   $beneficiaiesModel->all();
$args['beneficiaries']  =   $beneficiariess;
view("Beneficiaries", "index", $args);
?>