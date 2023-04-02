<?php
use core\Database;
class Vendors extends Database{
    public function __construct($config)
    {
        parent::__construct($config);
    }

    public function add($data){
        extract($data);
        
        $this->conn->beginTransaction();
        try{
            // ADDING VENDOR
            $query  =   "INSERT INTO `vendors`(`vendor_name`, `vendor_city`, `vendor_cell_primary`, `vendor_cell_secondary`, `vendor_about`) VALUES (:name, :city, :cell1,:cell2,:about)";
            $args   =   [
                'name'  => $name,
                'city'  => $city,
                'cell1'  => $cell1,
                'cell2'  => $cell2,
                'about'  => $about
            ];
            // VENDOR ID
            $vendor_id =   $this->insertOrAbort($query, $args);
            // ADDING BENEFICIARY
            $query  =   "INSERT INTO `beneficiaries`
            (`beneficiary_name`,`beneficiary_city`,`beneficiary_cell_primary`, `beneficiary_cell_secondary`, `beneficiary_about`,`vendor_id`, `beneficiary_type`) 
            VALUES 
            (:name, :city, :cell1, :cell2, :about,:vendor_id,:type)";
            $args1   =   [
                'name'  => $name,
                'city'  => $city,
                'cell1'  => $cell1,
                'cell2'  => $cell2,
                'about'  => $about,
                'vendor_id'   =>  $vendor_id,
                'type'   =>  'vendor'
            ];
            // BENEFICIARY ID
            $beneficiary_id =   $this->insertOrAbort($query, $args1);
            // IF BANK DETAILS EXISITS
            if(!empty($bank)){
                // INSERTING BANK ACCOUNT
                $_query  =   "INSERT INTO `bank_accounts`(`bank_account_bank`, `bank_account_title`, `bank_account_number`,`vendor_id`) VALUES (:bank,:account_title,:account_number,:id)";
                $_args   =   [
                'bank'  => $bank,
                'account_title'  => $account_title,
                'account_number'  => $account_number,
                'id'  => (int) $vendor_id
                ];
                // BANK ACCOUNT ID
                $bank_account_id =   $this->insertOrAbort($_query, $_args);
                // ADDING BANK ACCOUNT ID TO VENDOR TABLE
                $query  =   "UPDATE vendors SET bank_account = :bank_account_id WHERE vendor_id = :vendor_id";
                $__args =   [
                    'bank_account_id' =>  (int) $bank_account_id,
                    'vendor_id' =>  (int) $vendor_id,
                ];
                $response   =   $this->insertOrAbort($query, $__args);
                // ADDING BANK ACCOUNT ID TO BENEFICIARIES TABLE
                $query  =   "UPDATE beneficiaries SET beneficiary_bank_account = :bank_account_id WHERE beneficiary_id = :beneficiary_id";
                $__args =   [
                    'bank_account_id' =>  (int) $bank_account_id,
                    'beneficiary_id' =>  (int) $beneficiary_id,
                ];
                $response   =   $this->insertOrAbort($query, $__args);
            }
            $this->conn->commit();
            return $vendor_id;
        }catch(PDOException $e){
            $this->conn->rollBack();
            return abort($e->getMessage());
        }
    }
    public function get($id){
        $query = "SELECT 
        v.vendor_name,v.vendor_id, v.vendor_about, c.city_name, v.vendor_cell_primary, v.vendor_cell_secondary, c.city_name, p.province_name, ba.bank_account_title, ba.bank_account_number, b.bank_name
        FROM `vendors` as v 
        left join cities as c
        on c.city_id    =   v.vendor_city  
        left join provinces as p
        on p.province_id    =   c.city_province  
        left join bank_accounts as ba  
        on ba.vendor_id  =   v.vendor_id 
        left join banks as b 
        on b.bank_id    =   ba.bank_account_bank
        WHERE v.vendor_id =   :id";
        $args   =   [
            'id'    =>  $id
        ];
        $result = $this->fetchOrAbort($query, $args);
        return $result;
    }
    public function all(){
        $query = "SELECT 
        v.vendor_name,v.vendor_id, v.vendor_about, c.city_name, v.vendor_cell_primary, v.vendor_cell_secondary, c.city_name, p.province_name, ba.bank_account_title, ba.bank_account_number, b.bank_name
        FROM `vendors` as v 
        left join cities as c
        on c.city_id    =   v.vendor_city  
        left join provinces as p
        on p.province_id    =   c.city_province  
        left join bank_accounts as ba  
        on ba.vendor_id  =   v.vendor_id 
        left join banks as b 
        on b.bank_id    =   ba.bank_account_bank";
        $result = $this->fetchAllOrAbort($query);
        return $result;
    }
}
?>