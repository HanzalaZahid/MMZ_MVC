<?php
if (isset($_GET['vendor_id'])   && !empty($_GET['vendor_id'])){
    $vendor_id              =   $_GET['vendor_id'];
    $page_title             =   "Add Vendor";
    core('Additional');
    $additional             =   new core\Additional($config);
    $banks                  =   $additional->getBanks();
    $cities                 =   $additional->getCities();
    models('Vendors');
    $vendorsModel           =   new Vendors($config);
    $vendor                 =   $vendorsModel->get($vendor_id);
    // echo "<pre>";
    //     var_dump($vendor);
    // echo "</pre>";
    $args['vendor']         =   $vendor;
    $args['banks']          =   $banks;
    $args['cities']         =   $cities;
    if (isset($_GET['errors'])){
        $args['errors']  =   unserialize(urldecode($_GET['errors']));
    }
    view('vendors', 'add', $args);
} else{
    abort();
}
?>