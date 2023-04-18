<?php
core('Validator');
foreach($_POST as $name=>$value){
    Validator::chkEmpty($name, $value);
}
if (!empty($errors)){
    // GET MODEL
    models('Transactions');
    $transactionModel   =   new Transactions($config);
    // CHECK TRANSACTION TYPE
    // CALL THE REQUIRED MODEL FUNCTION FOR EACH TYPE TO UPDATE TRANSACTION
    if($_POST['type']   === 'online'){
        $transactionModel->updateTransfer($_POST);
        header("Location: /transaction?cluster={$_POST['cluster']}&&detail_id={$_POST['transaction_detail_id']}");
    }else{
        $transactionModel->updateWithdrawal($_POST);
        header("Location: /transaction?cluster={$_POST['cluster']}&&detail_id={$_POST['detail_id'][0]}");
    }
}else{
    header("Location: /edit-transaction?cluster={$_POST['cluster']}&&errors=".urlencode(serialize($errors)));
}
?>