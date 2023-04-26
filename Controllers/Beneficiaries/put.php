<?php
// foreach($_POST as $name=>$value){
//     Validator::chkEmpty($name, $value);
// }

if (empty($errors)){
    models('Beneficiaries');
    $beneficiariesModel =   new beneficiaries($config);
    $response       =   $beneficiariesModel->update($_POST);
    if ($response != 0){
        header("Location: /beneficiaries?msg=Successfully Updated");
    }else{
        header("Location: /beneficiaries?msg=Beneficiary Not Found");
    }
}
else{
    header("location: /edit-beneficiary?id={$_POST['beneficiary_id']}&&errors=".urlencode(serialize($errors)));
}

?>