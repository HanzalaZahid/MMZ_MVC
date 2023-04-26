<?php
if(isset($_GET['id'])   &&  !empty($_GET['id'])){
    $beneficiary_id  =   $_GET['id'];
    models('Beneficiaries');
    $beneficiariesModel    =  new beneficiaries($config);
    $response        =  $beneficiariesModel->destroy($beneficiary_id);
    if($response    !=  0){
        header('Location: /beneficiaries');
    }else{
        header('Location: /beneficiaries?msg=No Employee Found');
    }
} else{
    abort("",403);
}
?>