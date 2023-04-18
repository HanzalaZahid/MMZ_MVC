<?php
if(isset($_GET['id'])   &&  !empty($_GET['id'])){
    $vendor_id  =   $_GET['id'];
    models('Vendors');
    $vendorsModel    =  new Vendors($config);
    $response        =  $vendorsModel->destroy($vendor_id);
    if($response    !=  0){
        header('Location: /vendors');
    }else{
        header('Location: /vendors?msg=No Vendor Found');
    }
} else{
    abort("",403);
}
?>