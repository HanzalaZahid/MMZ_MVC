<?php
core('Validator');
// foreach($_POST as $name=>$value){
//     Validator::chkEmpty($name, $value);
// }

if(empty($errors)){
    models('Clients');
    $clientModel    =   new Clients($config);
    $response       =   $clientModel->put($_POST);
    header("Location: /client?id=".urlencode($_POST['client_id']));
}
else{
    header("Location: /edit-client?id=".urlencode($_POST['client_id'])."&errors=".urlencode(serialize($errors)));
}
?>