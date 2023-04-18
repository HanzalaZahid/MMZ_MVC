<?php
core('Validator');
// foreach($_POST as $name=>$value){
//     Validator::chkEmpty($name, $value);
// }
if(empty($errors)){
    models('Transactions');
    $transactions   =   new Transactions($config);
    $response =   $transactions->addWithdrawal($_POST);
    header("Location:   /transaction?cluster=".urlencode($response['cluster'])."&detail_id=".urlencode($response['detail_id']));
} else{
    header("Location:   /add-withdrawal?errors=".urlencode(serialize($errors)));
}
?>