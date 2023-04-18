<?php 
$page_title =   "Transactions";
models('Transactions');
$transactions   =   new Transactions($config);
$args['transactions']  =   $transactions->all();
view("transactions", "index", $args);
?>