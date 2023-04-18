<?php
$page_title =   "Transactions";
models('Transactions');
$args   =   [];
if (isset($_GET['cluster']) &&  isset($_GET['detail_id']) &&  !empty($_GET['cluster']) &&  !empty($_GET['detail_id'])){
    $cluster    =   $_GET['cluster'];
    $id    =   $_GET['detail_id'];
    $transactions   =   new Transactions($config);
    $response   =   $transactions->getTransaction($cluster, $id);
    $args['transaction']    =   $response['transaction'];
    $args['details']        =   $response['details'];
}
view("transactions","show", $args);
?>