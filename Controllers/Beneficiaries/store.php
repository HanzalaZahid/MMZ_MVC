<?php
core('Validator');
// foreach($_POST as $name=>$value){
//     Validator::chkEmpty($name, $value);
// }
if(empty($errors)){
    models('Beneficiaries');
    $beneficiaries   =   new beneficiaries($config);
    $response   =   $beneficiaries->add($_POST);
    header('Location: /beneficiaries?id='.$response);
}else{
    header('Location: /add-beneficiary?errors='.urlencode(serialize($errors)));
}
?>