<?php
use core\Database;
class beneficiaries extends Database{
    public function __construct($config)
    {
        parent::__construct($config);
    }
    public function add($data){
        extract($data);
        $this->conn->beginTransaction();
        try{
            $query  =   "INSERT INTO `beneficiaries`(
                        `beneficiary_name`, 
                        `beneficiary_city`, 
                        `beneficiary_cell_primary`, 
                        `beneficiary_cell_secondary`, 
                        `beneficiary_about`, 
                        `beneficiary_type`
                        ) VALUES (
                        :name,
                        :city,
                        :cell1,
                        :cell2,
                        :about,
                        :category
                        )";
            $args   =   [
                'name'                  =>                          $name,
                'city'                  =>                          $city,
                'cell1'                 =>                          $cell1,
                'cell2'                 =>                          $cell2,
                'about'                 =>                          $about,
                'category'              =>                          $category
            ];
            $response   =   $this->insertOrAbort($query, $args);
            // IF BANK DETAILS EXISTS
            // ADD THEM TO BANK DETAILS TABLE
            // ADD FOREIGN KEY IN BENEFICIARIES TABLE
            if (!empty($bank)){
                $query  =   "INSERT INTO `bank_accounts`(
                            `bank_account_title`, 
                            `bank_account_number`, 
                            `bank_account_bank`
                            ) VALUES (
                            :account_title,
                            :account_number,
                            :bank
                            )";
                $args   =   [
                    'account_title'                 =>          $account_title,
                    'account_number'                =>          $account_number,
                    'bank'                          =>          $bank
                ];
                $bank_account_id    =   $this->insertOrAbort($query, $args);
                // ADD FOREIGN KEY IN BENEFICIARIES TABLE
                $query  =   "UPDATE beneficiaries SET beneficiary_bank_account  =   :bank_account_id
                            WHERE
                            beneficiary_id  =   :beneficiary_id";
                $args   =   [
                            'bank_account_id'   =>  $bank_account_id,
                            'beneficiary_id'    =>  $response
                ];
                $this->updateOrAbort($query, $args);
            }

            $this->conn->commit();
            return $response;
        } catch (PDOException $e){
            $this->conn->rollBack();
            abort($e->getMessage());
        }
    }
    public function get($beneficiary_id){
        $query  =   "SELECT * FROM beneficiaries as b
                    LEFT JOIN cities as c
                    ON b.beneficiary_city   =   c.city_id
                    LEFT JOIN bank_accounts as ba
                    ON ba.bank_account_id   =   b.beneficiary_bank_account
                    LEFT JOIN banks as bnk
                    ON ba.bank_account_bank =   bnk.bank_id
                    WHERE b.employee_id IS NULL AND b.vendor_id IS NULL AND b.active    =   true AND b.beneficiary_id   =   :beneficiary_id";
        $args   =   ['beneficiary_id'=>$beneficiary_id];
                    return $this->fetchOrAbort($query, $args);
    }
    public function all(){
        $query  =   "SELECT * FROM beneficiaries as b
                    LEFT JOIN cities as c
                    ON b.beneficiary_city   =   c.city_id
                    LEFT JOIN bank_accounts as ba
                    ON ba.bank_account_id   =   b.beneficiary_bank_account
                    LEFT JOIN banks as bnk
                    ON ba.bank_account_bank =   bnk.bank_id
                    WHERE b.employee_id IS NULL AND b.vendor_id IS NULL AND b.active    =   true";
                    return $this->fetchAllOrAbort($query);
    }
    public function update($data){
        extract($data);
        $this->conn->beginTransaction();
        try{
            // UPDATE BENEFICIARIES TABLE
            $query  =   "UPDATE `beneficiaries` SET 
                        `beneficiary_name`                                      =                           :name,
                        `beneficiary_city`                                      =                           :city,
                        `beneficiary_cell_primary`                              =                           :cell1,
                        `beneficiary_cell_secondary`                            =                           :cell2,
                        `beneficiary_about`                                     =                           :about,
                        `beneficiary_type`                                      =                           :category
                        WHERE
                        `beneficiary_id`                                        =                           :beneficiary_id
            ";
            $args   =   [
                        'name'                                                  =>                          $name,
                        'city'                                                  =>                          $city,
                        'cell1'                                                 =>                          $cell1,
                        'cell2'                                                 =>                          $cell2,
                        'about'                                                 =>                          $about,
                        'category'                                              =>                          $category,
                        'beneficiary_id'                                        =>                          $beneficiary_id
            ];
            $response       =       $this->updateOrAbort($query, $args);
            // IF BANK DETAILS EXISTS
            // UPDATE BANK DETAILS
            if(!empty($bank)){
                $bank_account_id    =   $this->getBankAccountId($beneficiary_id);
                // IF BANK DETAILS EXISTS
                if(!empty($bank_account_id)){
                    $query  =   "UPDATE `bank_accounts` SET 
                                `bank_account_title`                                =                           :account_title,
                                `bank_account_number`                               =                           :account_number,
                                `bank_account_bank`                                 =                           :bank
                                WHERE
                                `bank_account_id`                                   =                           :bank_account_id
                    ";
                    $args   =   [
                        'account_title'                                             =>$account_title,
                        'account_number'                                            =>$account_number,
                        'bank'                                                      =>$bank,
                        'bank_account_id'                                           =>$bank_account_id
                    ];
                    $this->updateOrAbort($query, $args);
                } else{
                    // BANK DETAILS DONOT EXISTS
                    // ADD BANK DETAILS AND ADD FOREIGN KEY IN BENEFICIARY TABLE
                    $query  =   "INSERT INTO `bank_accounts`(
                                `bank_account_title`, 
                                `bank_account_number`, 
                                `bank_account_bank`
                                ) VALUES (
                                :account_title,
                                :account_number,
                                :bank
                    )";
                    $args   =   [
                            'account_title'                                             =>                  $account_title,
                            'account_number'                                            =>                  $account_number,
                            'bank'                                                      =>                  $bank
                    ];
                    $new_account_id =   $this->insertOrAbort($query, $args);
                    // UPDATE BENEFICIARY TABLE
                    $query  =   "UPDATE `beneficiaries` SET
                                `beneficiary_bank_account`              =               :new_account_id
                                WHERE
                                `beneficiary_id`                        =               :beneficiary_id
                    ";
                    $args   =   [
                                'beneficiary_id'                        =>              $beneficiary_id,
                                'new_account_id'                        =>              $new_account_id
                    ];
                    $this->updateOrAbort($query, $args);
                }
            }else{
                // IF BANK DETAILS DONOT EXISTS DELETE FROM BANK ACCOUNT "IF EXISTS"
                // THEN DELETE FOREIGN KEY IN BENEFICIRIES TABLE
                            // CHECK IF DETAILS EXISTS
                $bank_account_id    =   $this->getBankAccountId($beneficiary_id);
                if (!empty($bank_account_id)){
                    $query  =   "DELETE FROM bank_accounts WHERE bank_account_id    =   :bank_account_id";
                    $args   =   ['bank_account_id'=>$bank_account_id];
                    $this->deleteOrAbort($query, $args);
                    $query  =   "UPDATE beneficiaries SET beneficiary_bank_account   =   NULL WHERE beneficiary_id   =   :beneficiary_id";
                    $args   =   ['beneficiary_id'=>$beneficiary_id];
                    $this->updateOrAbort($query, $args);
                }
            }
            
            $this->conn->commit();
            return $response;
        }catch(PDOException $e){
            $this->conn->rollBack();
            abort($e->getMessage());
        }
    }
    public function destroy($beneficiary_id){
        $query  =   "UPDATE beneficiaries SET active = false WHERE beneficiary_id   =   :beneficiary_id";
        $args   =   ['beneficiary_id'=>$beneficiary_id];
        return $this->deleteOrAbort($query, $args);
    }
    public function getBankAccountId($beneficiary_id){
        // GET BANK ACCOUNT ID
        $query  =   "SELECT `beneficiary_bank_account` as bank_account_id  FROM beneficiaries WHERE beneficiary_id  =   :beneficiary_id";
        $args   =   ['beneficiary_id'=>$beneficiary_id];
        return   $this->fetchOrAbort($query, $args)['bank_account_id'];
    }
}
?>