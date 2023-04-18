<?php
    if(isset($_GET['id']) && !empty($_GET['id'])){
        $client_id  =   $_GET['id'];
        models('Clients');
        $clientModel    =   new Clients($config);
        $response       =   $clientModel->destroy($client_id);
        if ($response !=    0)
        {
            header('Location: /clients?msg=successfullyDeleted');
        }else{

            header('Location: /clients?msg=No Client Found');
        }
    }else{
        abort("", 403);
    }
?>