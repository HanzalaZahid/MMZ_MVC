<?php

    use core\Additional;
    core('Additional');
    $page_title =   "Add Client";
    $additional = new Additional($config);
    $cities =   $additional->getCities();
    $args   =   [];
    if(isset($_GET['errors'])){
        $errors    =   unserialize(urldecode($_GET['errors']));
    }
    $args['errors']   =   $errors;
    $args['cities']   =   $cities;
    view("clients", "add", $args);
?>