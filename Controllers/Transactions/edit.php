<?php
use core\Additional;
if(isset($_GET['cluster'])  &&  !empty($_GET['cluster'])){
    $cluster                                        =   $_GET['cluster'];
    $args['cluster']                                =   $cluster;
    $page_title                                     =   "Edit Transaction";
    $args['head']['scripts']                        =   'withdrawal';
    core('Additional');
    models('Projects');
    // IF ERRORS READ THEM AND PASS THEM TO ARGS ARRAY
    if (isset($_GET['errors'])  && !empty($_GET['errors'])){
        $args['errors'] =   unserialize(urldecode($_GET['errors']));
    }
    // GETTING ADDITIONAL CLASS
    $additional =   new Additional($config);
    // GETTING TRANSACTION CATEGORIES
    $transaction_categories =   $additional->getTransactionCategories();
    // GETTING LAST TRANSACTION DATE
    $args['last_transaction_date']                  =   $additional->getLastTransactionDate();
    // GETTING PROJECTS LIST
    $projects                                       =   new Projects($config);
    $args['projects']                               =   $projects->all();
    // GETTING COMPANY ACCOUNTS
    $args['company_accounts']                       =   $additional->getCompanyAccounts();
    // GETTING TRANSACTION CATEGORIES
    $args['transaction_categories']                 =   $transaction_categories;
    // GETTING BENEFICIARIES LIST
    $args['beneficiaires']                          =   $additional->getBeneficiaries();
    models('Transactions');
    $transactionsModel                              =   new Transactions($config);
    $response                                       =   $transactionsModel->getCluster($cluster);
    $args['transaction']                            =   $response;
    // CALLING VIEW
    if($response['transaction'][0]['transaction_type'] === 'online'){
        view("transactions", "edit-transfer", $args);
    } else{
        view("transactions", "edit-withdrawal", $args);
    }
} else{
    abort();
}
?>


