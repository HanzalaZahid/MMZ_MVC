<?php
    $page_title =   "Edit Beneficiary";
    core('Additional');
    if(isset($_GET['id'])  &&  !empty($_GET['id'])){

        $beneficiary_id    =   $_GET['id'];
        models('Beneficiaries');
        $beneficiariesModel  =   new beneficiaries($config);
        $beneficiaryData   =   $beneficiariesModel->get($beneficiary_id);
        $args['beneficiary']   =   $beneficiaryData;
        $args['categories'] =   [
            'family'                =>                  'Family Member',
            'friend'                =>                  'Friend',
            'relative'              =>                  'Relative',
            'other'                 =>                  'Other',
];
        $additional =   new core\Additional($config);
        $cities =   $additional->getCities();
        $banks  =   $additional->getBanks();
        $args['cities'] =   $cities;
        $args['banks'] =   $banks;
        if (isset($_GET['errors'])){
            $args['errors'] =   unserialize(urldecode($_GET['errors']));
        }       
    } else{
        abort();
    }
    view('beneficiaries', 'add', $args);
?>