<?php
models("Clients");
if (isset($_GET['id'])  &&  !empty($_GET['id'])){
    $clients    =   new Clients($config);
    $client     =   $clients->get($_GET['id']);
    $args['client'] =   $client;
}   else{
    abort(404);
}
$page_title =   $client['client_name'];
view("Clients", "show", $args);
?>