<?php 
namespace core;
use core\Database;
class Additional extends Database{
    public function __construct($config){
        parent::__construct($config);
    }
    public function getCities(){
        $sql = "SELECT * FROM `cities`";
        $result = $this->fetchAllOrAbort($sql);
        return $result;
    }
    public function getBanks(){
        $sql = "SELECT * FROM `banks` order by bank_name";
        $result = $this->fetchAllOrAbort($sql);
        return $result;
    }
    public function getCompanyAccounts(){
        $sql = "SELECT * FROM `company_accounts` left join banks on company_account_bank    =   bank_id";
        $result = $this->fetchAllOrAbort($sql);
        return $result;
    }
    public function getEmployeeCategory(){
        $sql = "SELECT * FROM `employee_categories`";
        $result = $this->fetchAllOrAbort($sql);
        return $result;
    }
    public function getTransactionCategories(){
        $sql = "SELECT * FROM `transaction_categories`";
        $result = $this->fetchAllOrAbort($sql);
        return $result;
    }
    public function getBeneficiaries(){
        $sql = "SELECT * FROM `beneficiaries` 
        LEFT JOIN bank_accounts 
        on beneficiary_bank_account	=	bank_account_id
        LEFT JOIN cities
        on beneficiary_city	=	city_id
        LEFT JOIN banks
        on bank_account_bank	=	bank_id
        LEFT JOIN employees 
        on beneficiaries.employee_id	=	employees.employee_id
        LEFT JOIN employee_categories
        ON employee_category	=	employee_category_id
        WHERE
        beneficiaries.active  =   true";
        $result = $this->fetchAllOrAbort($sql);
        return $result;
    }
    public function getLastTransactionDate(){
        $query  =   "SELECT transaction_date FROM `transactions` ORDER BY transaction_id DESC limit 1";
        $response   =   $this->fetchOrAbort($query);
        if($response){
            $date   =   $response['transaction_date'];
            return $date;
        }
        return date('mdy');
    }
}
?>