<?php
core('Validator');
// foreach($_POST as $name=>$value){
//     Validator::chkEmpty($name, $value);
// }
if(empty($errors)){
    models('Transactions');
    $transactions   =   new Transactions($config);
    $id =   $transactions->addTransfer($_POST);
    header("Location:   /transaction?id=$id");
} else{
    header("Location:   /add-transfer?errors=".urlencode(serialize($errors)));
}
?>