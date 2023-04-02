<?php
core('Validator');
// foreach($_POST as $name=>$value){
//     Validator::chkEmpty($name, $value);
// }
if(empty($errors)){
    models('Transactions');
    $transactions   =   new Transactions($config);
    $cluster =   $transactions->addWithdrawal($_POST);
    header("Location:   /transaction?cluster=$cluster");
} else{
    header("Location:   /add-withdrawal?errors=".urlencode(serialize($errors)));
}
?>