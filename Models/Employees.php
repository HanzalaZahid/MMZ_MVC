<?php
use core\Database;
class Employees extends Database{
    public function __construct($config)
    {
        parent::__construct($config);
    }

    public function add($data){
        extract($data);
        $this->conn->beginTransaction();
        try{
            // UPDATING EMPLOYEE TABLE
            $query  =   "INSERT INTO `employees`(`employee_name`, `employee_category`, `employee_cell_primary`, `employee_cell_secondary`, `employee_city`, `employee_about`) VALUES (:name,:category,:cell1,:cell2,:city, :about)";
            $args   =   [
                'name'  => $name,
                'category'  => $category,
                'city'  => $city,
                'cell1'  => $cell1,
                'cell2'  => $cell2,
                'about'  => $about
            ];
            // ??GETTING EMPLOYEE ID AND RUNNING THE QUERY
            $employee_id =   $this->insertOrAbort($query, $args);
            // INSERTING IT AS BENEFICIARY TOO
            // ADDING BENEFICIARY
            $query  =   "INSERT INTO `beneficiaries`
            (`beneficiary_name`,`beneficiary_city`,`beneficiary_cell_primary`, `beneficiary_cell_secondary`, `beneficiary_about`,`employee_id`, `beneficiary_type`) 
            VALUES 
            (:name, :city, :cell1, :cell2, :about,:employee_id,:type)";
            $args1   =   [
                'name'  => $name,
                'city'  => $city,
                'cell1'  => $cell1,
                'cell2'  => $cell2,
                'about'  => $about,
                'employee_id'   =>  $employee_id,
                'type'   =>  'employee'
            ];
            // BENEFICIARY ID
            $beneficiary_id =   $this->insertOrAbort($query, $args1);
            // IF BANK DETAILS EXISITS
            // INSERT IT INTO BANK ACCOUNTS TABLE
            if(!empty($bank)){
                // ADDING BANK ACCOUNT DETAILS
                $_query  =   "INSERT INTO `bank_accounts`(`bank_account_bank`, `bank_account_title`, `bank_account_number`,`employee_id`) VALUES (:bank,:account_title,:account_number,:id)";
                $_args   =   [
                'bank'  => $bank,
                'account_title'  => $account_title,
                'account_number'  => $account_number,
                'id'  => (int) $employee_id
                ];
                $bank_account_id =   $this->insertOrAbort($_query, $_args);
                // ADDING BANK DETAILS ID IN EMPLOYEES TABLE
                $query  =   "UPDATE employees SET bank_account = :bank_account_id WHERE employee_id = :employee_id";
                $__args =   [
                    'bank_account_id' =>  (int) $bank_account_id,
                    'employee_id' =>  (int) $employee_id,
                ];
                $response   =   $this->insertOrAbort($query, $__args);
                // ADDING BANK DETAILS ID IN BENEFICIARIES TABLE
                $query  =   "UPDATE beneficiaries SET beneficiary_bank_account = :bank_account_id WHERE beneficiary_id = :beneficiary_id";
                $__args =   [
                    'bank_account_id' =>  (int) $bank_account_id,
                    'beneficiary_id' =>  (int) $beneficiary_id,
                ];
                $response   =   $this->insertOrAbort($query, $__args);
            }
            $this->conn->commit();
            return $employee_id;
        }catch(PDOException $e){
            $this->conn->rollBack();
            return abort($e->getMessage());
        }
    }
    public function get($id){
        $query  =   "SELECT
        e.employee_id, e.employee_name, e.employee_cell_secondary, e.employee_cell_primary, e.employee_about, c.city_name, p.province_name, ba.bank_account_title, ba.bank_account_number, b.bank_name, ec.employee_category_name
        FROM employees e
        LEFT JOIN cities c ON e.employee_city = c.city_id 
        LEFT JOIN provinces p ON c.city_province = p.province_id 
        LEFT JOIN bank_accounts ba ON e.employee_id = ba.employee_id 
        LEFT JOIN banks b ON b.bank_id = ba.bank_account_bank 
        LEFT JOIN employee_categories ec ON e.employee_category = ec.employee_category_id
        WHERE e.employee_id =   :id
        ";
        $args   =   [
            'id'    => $id
        ];
        $response   =   $this->fetchOrAbort($query, $args);
        return  $response;
    }
    public function all(){
        $query  =   "SELECT
        e.employee_id, e.employee_name, e.employee_cell_secondary, e.employee_cell_primary, e.employee_about, c.city_name, ba.bank_account_title, ba.bank_account_number, b.bank_name, ec.employee_category_name
        FROM employees e
        LEFT JOIN cities c ON e.employee_city = c.city_id 
        LEFT JOIN bank_accounts ba ON e.employee_id = ba.employee_id 
        LEFT JOIN banks b ON b.bank_id = ba.bank_account_bank 
        LEFT JOIN employee_categories ec ON e.employee_category = ec.employee_category_id
        ORDER BY e.employee_id
        ";
        $response   =   $this->fetchAllOrAbort($query);
        return  $response;
    }
}
?>