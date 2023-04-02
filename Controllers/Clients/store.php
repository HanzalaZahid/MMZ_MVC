<?php
$errors =   [];
core('Validator');
// foreach($_POST as $name  =>    $value){
//     if (strtolower($name)   !=  'submit'){
//         Validator::chkEmpty($name, $value);
//     }
// }
if (empty($errors)){
    models('Clients');
    $clients    =   new Clients($config);
    $response   =   $clients->add($_POST);
    header("Location:/client?id=$response");
}
else{
    header('location: /add-client?errors=' . urlencode(serialize($errors)) );
}
?>