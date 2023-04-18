<?php
if(isset($_GET['cluster'])  &&  isset($_GET['detail_id'])   && !empty($_GET['detail_id'])   &&  !empty($_GET['cluster'])){
    $detail_id  =   $_GET['detail_id'];
    $cluster    =   $_GET['cluster'];
    models('Transactions');
    $transactionModel    =   new Transactions($config);
    $response           =   $transactionModel->destroy($cluster, $detail_id);
    if ($response!= 0){
        header('Location: /transactions?msg=Transaction Deleted Successfully');
    }else{
        header('Location: /transactions?msg=Transaction Not Found');
    }
}else{
    abort("", 403);
}
?>