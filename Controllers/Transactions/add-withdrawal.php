<?php

use core\Additional;

$page_title =   "Add Transaction";
$args['head']['scripts']    =   'withdrawal';
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
$args['last_transaction_date']  =   $additional->getLastTransactionDate();
// GETTING PROJECTS LIST
$projects   =   new Projects($config);
$args['projects']   =   $projects->all();
// GETTING COMPANY ACCOUNTS
$args['company_accounts']   =   $additional->getCompanyAccounts();
// GETTING TRANSACTION CATEGORIES
$args['transaction_categories'] =   $transaction_categories;
// GETTING BENEFICIARIES LIST
$args['beneficiaires']  =   $additional->getBeneficiaries();
// CALLING VIEW
view("transactions", "add-withdrawal", $args);
?>