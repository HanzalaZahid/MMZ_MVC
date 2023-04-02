<?php 
$page_title =   "Vendor";
if(isset($_GET['id']) && !empty($_GET['id'])){
    models('Vendors');
    $vendors    =   new Vendors($config);
    $args['vendor']     =   $vendors->get($_GET['id']);
    if (empty($args['vendor'])){
        abort();
    }
} else{
    abort();
}
view("vendors","show", $args);
?>