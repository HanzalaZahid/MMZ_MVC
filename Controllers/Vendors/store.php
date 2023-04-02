<?php
core('Validator');
// foreach($_POST as $name=>$value){
//     if($name!='submit'){
//         Validator::chkEmpty($name, $value);
//     }
// }
if (empty($errors)){
    models('Vendors');
    $vendors    =   new Vendors($config);
    $response   =   $vendors->add($_POST);
    header('Location: /vendor?id='.$response);
}else{
    header('Location: /add-vendor?errors='.urlencode(serialize($errors)));
}
?>