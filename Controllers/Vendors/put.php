<?php
    core('Validator');
    // foreach($_POST as $name=>$value){
    //     Validator::chkEmpty($name, $value);
    // }
    echo "<pre>";
        var_dump($_POST);
    echo "</pre>";
    if(empty($errors)){
        models('Vendors');
        $vendorsModel   =   new Vendors($config);
        $response       =   $vendorsModel->update($_POST);
        header("Location: vendor?id=".$_POST['vendor_id']);
    }else{
        header(("Location: /edit-vendor?vendor_id={$_POST['vendor_id']}&errors=".urlencode(serialize($errors))));
    }
?>