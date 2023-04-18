<?php
use core\Database;
class Vendors extends Database{
    public function __construct($config){
        parent::__construct($config);
    }
    public function add($data){
        extract($data);
        
        $this->conn->beginTransaction();
        try{
            // ADDING VENDOR
            $query  =   "INSERT INTO `vendors`(
                        `vendor_name`, 
                        `vendor_city`, 
                        `vendor_cell_primary`, 
                        `vendor_cell_secondary`, 
                        `vendor_about`
                        ) 
                        VALUES (
                        :name,
                        :city,
                        :cell1,
                        :cell2,
                        :about)";
            $args   =   [
                        'name'                  =>                  $name,
                        'city'                  =>                  $city,
                        'cell1'                 =>                  $cell1,
                        'cell2'                 =>                  $cell2,
                        'about'                 =>                  $about
            ];
            // VENDOR ID
            $vendor_id =   $this->insertOrAbort($query, $args);
            // ADDING BENEFICIARY
            $query  =   "INSERT INTO `beneficiaries`(
                        `beneficiary_name`,
                        `beneficiary_city`,
                        `beneficiary_cell_primary`, 
                        `beneficiary_cell_secondary`, 
                        `beneficiary_about`,
                        `vendor_id`, 
                        `beneficiary_type`
                        ) 
                    VALUES (
                        :name,
                         :city,
                         :cell1,
                         :cell2,
                         :about,
                        :vendor_id,
                        :type
                        )";
            $args1   =   [
                        'name'                      => $name,
                        'city'                      => $city,
                        'cell1'                     => $cell1,
                        'cell2'                     => $cell2,
                        'about'                     => $about,
                        'vendor_id'                 =>  $vendor_id,
                        'type'                      =>  'vendor'
            ];
            // BENEFICIARY ID
            $beneficiary_id =   $this->insertOrAbort($query, $args1);
            // IF BANK DETAILS EXISITS
            if(!empty($bank)){
                // INSERTING BANK ACCOUNT
                $_query  =   "INSERT INTO `bank_accounts`(
                            `bank_account_bank`,
                            `bank_account_title`,
                            `bank_account_number`,
                            `vendor_id`
                            ) 
                            VALUES(
                            :bank,
                            :account_title,
                            :account_number,
                            :id)";
                $_args   =   [
                            'bank'                      =>                  $bank,
                            'account_title'             =>                  $account_title,
                            'account_number'            =>                  $account_number,
                            'id'                        =>                  (int) $vendor_id
                ];
                // BANK ACCOUNT ID
                $bank_account_id =   $this->insertOrAbort($_query, $_args);
                // ADDING BANK ACCOUNT ID TO VENDOR TABLE
                $query  =   "UPDATE vendors SET 
                            bank_account                    =               :bank_account_id 
                WHERE       vendor_id                       =               :vendor_id";
                $__args =   [
                    'bank_account_id'                       =>              (int) $bank_account_id,
                    'vendor_id'                             =>              (int) $vendor_id,
                ];
                $response   =   $this->insertOrAbort($query, $__args);
                // ADDING BANK ACCOUNT ID TO BENEFICIARIES TABLE
                $query  =   "UPDATE beneficiaries SET 
                            beneficiary_bank_account        =               :bank_account_id 
                            WHERE beneficiary_id            =               :beneficiary_id";
                $__args =   [
                    'bank_account_id'                       =>              (int) $bank_account_id,
                    'beneficiary_id'                        =>              (int) $beneficiary_id,
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
    public function destroy($vendor_id){
        $this->conn->beginTransaction();
        try{
            $query  =   "UPDATE `vendors` SET 
                        `active`                =                   :value 
                        WHERE 
                        `vendor_id`	            =	                :vendor_id";
            $args   =   [
                        'value'                 =>                  false,
                        'vendor_id'             =>                  $vendor_id
            ];
            $this->updateOrAbort($query, $args);
            $query  =   "UPDATE `beneficiaries` SET 
                        `active`                =                   :value 
                        WHERE 
                        `vendor_id`	            =	                :vendor_id";
            $args   =   [
                        'value'                 =>                  false,
                        'vendor_id'             =>                  $vendor_id
            ];
            $this->conn->commit();
            return $this->updateOrAbort($query, $args);

        } catch(PDOException $e){
            $this->conn->rollBack();
            abort($e->getMessage(), 404);
        }
    }
    public function update($data){
        extract($data);
        $vendor_id  =   (int) $vendor_id;
        $this->conn->beginTransaction();
        try{
            //UPDATE VENDORS TABLE
            $query  =   "UPDATE `vendors` SET 
                        `vendor_name`           =                   :name,
                        `vendor_city`           =                   :city,
                        `vendor_cell_primary`   =                   :cell1,
                        `vendor_cell_secondary` =                   :cell2,
                        `vendor_about`          =                   :about
                        WHERE 
                        vendor_id               =                   :vendor_id
                        ";
            $args   =   [
                        'name'                  =>                  $name,
                        'city'                  =>                  $city,
                        'cell1'                 =>                  $cell1,
                        'cell2'                 =>                  $cell2,
                        'about'                 =>                  $about,
                        'vendor_id'             =>                  $vendor_id
            ];
            $this->insertOrAbort($query, $args);
            //UPDATE BENEFICIARY TABLE
            $query  =   "UPDATE `beneficiaries` SET 
                        `beneficiary_name`                  =       :name,
                        `beneficiary_city`                  =       :city,
                        `beneficiary_cell_primary`          =       :cell1,
                        `beneficiary_cell_secondary`        =       :cell2,
                        `beneficiary_about`                 =       :about,
                        `vendor_id`                         =       :vendor_id
                        WHERE 
                        vendor_id                           =       :vendor_id
                        ";
            $this->insertOrAbort($query, $args);
            // IF BANK DETAILS EXISTS IN DATA $_POST
            if(!empty($bank)){
                // CHECK IF CURRENT DETAILS EXISTS
                $query  =   "SELECT * FROM bank_accounts
                        WHERE
                        vendor_id                           =       :vendor_id
                        ";
                $args   =   [
                        'vendor_id'             =>                  $vendor_id
                ];
                // IF EXISTS THEN UPDATE THEM
                if ($this->fetchOrAbort($query, $args)     !=      false){
                    $query  =   "UPDATE `bank_accounts` SET 
                    `bank_account_title`                    =       :account_title,
                    `bank_account_number`                   =       :account_number,
                    `bank_account_bank`                     =       :bank
                    WHERE 
                    vendor_id                               =       :vendor_id
                    ";
                    $args   =   [
                        'account_title'                     =>      $account_title,
                        'account_number'                    =>      $account_number,
                        'bank'                              =>      $bank,
                        'vendor_id'                         =>      $vendor_id
                    ];
                    $this->insertOrAbort($query, $args);
                }
                // IF BANK DETAILS DOESNT EXISTS
                else{
                    // ADD NEW DETAILS IN BANK ACCOUNTS TABLE
                    $query  =   "INSERT INTO `bank_accounts`(
                                `bank_account_title`, 
                                `bank_account_number`, 
                                `bank_account_bank`, 
                                `vendor_id`
                                ) 
                                VALUES (
                                :account_title,
                                :account_number,
                                :bank,
                                :vendor_id
                                )";
                    $args   =   [
                        'account_title'                     =>      $account_title,
                        'account_number'                    =>      $account_number,
                        'bank'                              =>      $bank,
                        'vendor_id'                         =>      $vendor_id
                    ];
                    $bank_details_id    =   $this->insertOrAbort($query, $args);
                    // ADD FOREIGN KEY IN BENEFICIARIES TABLE
                    $query  =   "UPDATE beneficiaries SET
                                beneficiary_bank_account    =   :bank_details_id
                                WHERE
                                vendor_id                   =   :vendor_id
                                ";
                    $args   =   [
                                'bank_details_id'           =>  $bank_details_id,
                                'vendor_id'                 =>  $vendor_id
                    ];
                    $this->insertOrAbort($query, $args);
                    // ADD FOREIGN KEY IN VENDORS TABLE
                    $query  =   "UPDATE vendors SET
                                bank_account    =   :bank_details_id
                                WHERE
                                vendor_id                   =   :vendor_id
                                ";
                    $args   =   [
                                'bank_details_id'           =>  $bank_details_id,
                                'vendor_id'                 =>  $vendor_id
                    ];
                    $this->insertOrAbort($query, $args);
                }
            }
            // IF BANK DETAILS 'DONOT' EXISTS IN DATA $_POST
            if (empty($bank)){
                // REMOVE FOREIGN KEY FROM VENDORS
                $query  =   "UPDATE `vendors` SET 
                            `bank_account`                  =       :value  
                            WHERE 
                            vendor_id                       =       :vendor_id
                            ";
                $args   =   [
                            'value'                         =>      null,
                            'vendor_id'                     =>      $vendor_id
                ];
                $this->insertOrAbort($query, $args);
                // REMOVE FOREIGN KEY FROM BENEFICIAIRES
                $query   =   "UPDATE beneficiaries SET
                            beneficiary_bank_account        =       :value
                            WHERE
                            vendor_id                       =       :vendor_id
                            ";
                $this->insertOrAbort($query, $args);
                // DELETE BANK ACCOUNT ENTRY
                $query  =   "DELETE FROM `bank_accounts` 
                            WHERE 
                            vendor_id                       =   :vendor_id
                            ";
                $args   =   ['vendor_id'    =>  $vendor_id];
                $this->insertOrAbort($query, $args);
            }
            $this->conn->commit();
        } catch (PDOException $e){
            $this->conn->rollBack();
            abort($e->getMessage());
        }
    }
    public function get($id){
        $query = "SELECT 
                v.vendor_name,
                v.vendor_id,
                v.vendor_about,
                v.vendor_city,
                c.city_name,
                v.vendor_cell_primary,
                v.vendor_cell_secondary,
                c.city_name,
                p.province_name,
                ba.bank_account_title,
                ba.bank_account_number,
                ba.bank_account_bank,
                b.bank_name
                FROM `vendors`                              AS                              v 
                LEFT JOIN cities                            AS                              c
                ON        c.city_id                         =                               v.vendor_city  
                LEFT JOIN provinces                         AS                              p
                ON        p.province_id                     =                               c.city_province  
                LEFT JOIN bank_accounts                     AS                              ba  
                ON        ba.vendor_id                      =                               v.vendor_id 
                LEFT JOIN banks                             AS                              b 
                ON        b.bank_id                         =                               ba.bank_account_bank
                WHERE     v.vendor_id                       =                               :id
                AND
                v.active                                    =                               true";
        $args   =   [
                'id'    =>  $id
                ];
        $result = $this->fetchOrAbort($query, $args);
        return $result;
    }
    public function all(){
        $query = "SELECT 
                v.vendor_name,
                v.vendor_id,
                v.vendor_about,
                c.city_name,
                v.vendor_cell_primary,
                v.vendor_cell_secondary,
                c.city_name,
                p.province_name,
                ba.bank_account_title,
                ba.bank_account_number, b.bank_name
                FROM `vendors`                                      AS                              v 
                LEFT JOIN cities                                    AS                              c
                ON          c.city_id                               =                               v.vendor_city  
                LEFT JOIN provinces                                 AS                              p
                ON          p.province_id                           =                               c.city_province  
                LEFT JOIN bank_accounts                             AS                              ba  
                ON          ba.vendor_id                            =                               v.vendor_id 
                LEFT JOIN banks                                     AS                              b 
                ON          b.bank_id                               =                               ba.bank_account_bank
                WHERE
                active                                              =                               true";
        $result = $this->fetchAllOrAbort($query);
        return $result;
    }
}
?>