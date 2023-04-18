<?php
    use core\Additional;
if (isset($_GET['id'])){
    $id =   $_GET['id'];
    models('Clients');
    core('Additional');
    $additional = new Additional($config);
    $cities =   $additional->getCities();
    $args   =   [];
    if(isset($_GET['errors'])){
        $errors    =   unserialize(urldecode($_GET['errors']));
    }
    $args['errors']   =   $errors;
    $args['cities']   =   $cities;
    $clientsModel   =   new Clients($config);
    $client         =   $clientsModel->get($id);
    $args['client'] =   $client;
    $page_title =   "Edit Client";
    view('clients', 'add', $args);
} else{
    abort(404);
}
?>