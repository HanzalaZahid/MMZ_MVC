<?php
use core\Database;
class Transactions extends Database{
    public function __construct($config)
    {
        parent::__construct($config);
    }
    public function all(){
        $query  =   "SELECT 
        td.transaction_detail_id                          AS                   detail_id,
        td.transaction_detail_amount                      AS                   detail_amount,
        tr.transaction_date                               AS                   date,
        tr.transaction_type                               AS                   type,
        ca.company_account_title                          AS                   account_title,
        ca.company_account_number                         AS                   account_number,
        bnk2.bank_name                                    AS                   bank_name,
        td.transaction_detail_date                        AS                   detail_date,
        td.transaction_cluster                            AS                   cluster,
        td.transaction_detail_purpose                     AS                   purpose,
        p.project_name                                    AS                   project_name,
        be.beneficiary_name                               AS                   intermediate_name,
        be.beneficiary_type	                              AS                   intermeddiate_type,
        ba.bank_account_title                             AS                   intermediate_account_title,
        ba.bank_account_number                            AS                   intermediate_account_number,
        bnk.bank_name                                     AS                   intermediate_bank_name,
        be1.beneficiary_name                              AS                   destination_name,
        be1.beneficiary_type	                            AS                   destination_type,
        ba1.bank_account_title                            AS                   destination_account_title,
        ba1.bank_account_number                           AS                   destination_account_number,
        bnk.bank_name                                     AS                   destination_bank_name,
        tc.transaction_category_name                      AS                   category_name
      FROM
        transaction_details                               AS                   td
        LEFT JOIN transactions                            AS                   tr
        ON                td.transaction_cluster          =                    tr.transaction_cluster
        -- INTERMEDIATE
        LEFT JOIN beneficiaries                           AS                   be
        ON                be.beneficiary_id               =                    td.transaction_detail_intermediate_beneficiary
        -- DESTINATION
        LEFT JOIN beneficiaries                           AS                   be1
        ON                be1.beneficiary_id              =                    td.transaction_detail_destination_beneficiary
        LEFT JOIN transaction_categories                  AS                   tc
        ON                td.transaction_detail_category  =                    tc.transaction_category_id
        LEFT JOIN projects                                AS                   p
        ON                p.project_id                    =                    td.transaction_detail_project
        LEFT JOIN company_accounts                        AS                   ca
        ON                ca.company_account_id           =                    tr.transaction_account_used
        -- INTERMEDIATE
        LEFT JOIN bank_accounts                           AS                   ba
        ON                ba.bank_account_id              =                    be.beneficiary_bank_account
        -- DESTINATION
        LEFT JOIN bank_accounts                           AS                   ba1
        ON                ba1.bank_account_id             =                    be1.beneficiary_bank_account
        -- INTERMEDIATE
        LEFT JOIN banks                                   AS                   bnk
        ON                bnk.bank_id                     =                    ba.bank_account_bank
        -- DESTINATION
        LEFT JOIN banks                                   AS                   bnk1
        ON                bnk1.bank_id                    =                    ba1.bank_account_bank
        -- COMPANY
        LEFT JOIN banks                                   AS                   bnk2
        ON                bnk2.bank_id                    =                    ca.company_account_bank
      GROUP BY td.transaction_detail_id
        ";
        $response   =   $this->fetchAllOrAbort($query);
        return $response;
    }
    public function getCluster($cluster){
      $query  = "SELECT 
                t.transaction_id, 
                t.transaction_date, 
                t.transaction_amount, 
                t.transaction_type, 
                t.transaction_cluster,
                t.transaction_account_used,
                ca.company_account_title, 
                ca.company_account_number, 
                b.bank_name 
      FROM transactions                                     AS                    t 
      LEFT JOIN company_accounts                            AS                    ca 
      ON                    ca.company_account_id           =                     t.transaction_account_used 
      LEFT JOIN banks                                       AS                    b 
      ON                    b.bank_id                       =                     ca.company_account_bank 
      WHERE t.transaction_cluster                           =                     :cluster;
      ";
      $args = [
        'cluster' =>  $cluster
        ];
      $transaction = $this->fetchAllOrAbort($query, $args);
      $query  = "SELECT
                td.transaction_detail_id,
                td.transaction_detail_date,
                td.transaction_detail_purpose,
                td.transaction_detail_amount,
                td.transaction_detail_intermediate_beneficiary,
                td.transaction_detail_destination_beneficiary,
                td.transaction_detail_project,
                td.transaction_detail_category,
                be.beneficiary_name                         AS                    intermediate_name,
                be.beneficiary_type	                        AS                    intermediate_type,
                ba.bank_account_title                       AS                    intermediate_bank_title,
                ba.bank_account_number                      AS                    intermediate_bank_number,
                bnk.bank_name                               AS                    intermediate_bank_name,
                be1.beneficiary_name                        AS                    destination_name,
                be1.beneficiary_type                        AS                    destination_type,
                ba1.bank_account_title                      AS                    destination_bank_title,
                ba1.bank_account_number                     AS                    destination_bank_number,
                bnk1.bank_name                              AS                    destination_bank_name,
                tc.transaction_category_name                AS                    category_name,
                p.project_name
        FROM transaction_details                            AS                    td
        LEFT JOIN beneficiaries                             AS                    be
        ON      be.beneficiary_id	                          =	                    td.transaction_detail_intermediate_beneficiary
        LEFT JOIN beneficiaries                             AS                    be1
        ON      be1.beneficiary_id	                        =	                    td.transaction_detail_destination_beneficiary
        LEFT JOIN bank_accounts                             AS                    ba
        ON      ba.bank_account_id	                        =	                    be.beneficiary_bank_account
        LEFT JOIN bank_accounts                             AS                    ba1
        ON      ba1.bank_account_id                         =	                    be1.beneficiary_bank_account
        LEFT JOIN banks                                     AS                    bnk
        ON      bnk.bank_id	                                =	                    ba.bank_account_bank
        LEFT JOIN banks                                     AS                    bnk1
        ON      bnk1.bank_id	                              =	                    ba1.bank_account_bank
        LEFT JOIN projects                                  AS                    p
        ON      td.transaction_detail_project	              =	                    p.project_id
        LEFT JOIN transaction_categories	                  AS                    tc
        ON      td.transaction_detail_category	            =	                    tc.transaction_category_id
        WHERE   td.transaction_cluster	                    =	                    :cluster  
        ";
        $args = [
          'cluster'       =>        $cluster,
        ];
        $details  = $this->fetchAllOrAbort($query, $args);
        if(empty($details)){
          abort(404);
        }
        $response['transaction']                            =                       $transaction;
        $response['details']                                =                       $details;
        return $response;
    }
    public function getTransaction($cluster, $id){
      $query  = "SELECT 
                t.transaction_id, 
                t.transaction_date, 
                t.transaction_amount, 
                t.transaction_type, 
                t.transaction_cluster, 
                ca.company_account_title, 
                ca.company_account_number, 
                b.bank_name 
      FROM transactions                                     AS                    t 
      LEFT JOIN company_accounts                            AS                    ca 
      ON                    ca.company_account_id           =                     t.transaction_account_used 
      LEFT JOIN banks                                       AS                    b 
      ON                    b.bank_id                       =                     ca.company_account_bank 
      WHERE t.transaction_cluster                           =                     :cluster;
      ";
      $args = [
        'cluster' =>  $cluster
        ];
      $transaction = $this->fetchAllOrAbort($query, $args);
      $query  = "SELECT
                td.transaction_detail_id,
                td.transaction_detail_date,
                td.transaction_detail_purpose,
                td.transaction_detail_amount,
                be.beneficiary_name                         AS                    intermediate_name,
                be.beneficiary_type	                        AS                    intermediate_type,
                ba.bank_account_title                       AS                    intermediate_bank_title,
                ba.bank_account_number                      AS                    intermediate_bank_number,
                bnk.bank_name                               AS                    intermediate_bank_name,
                be1.beneficiary_name                        AS                    destination_name,
                be1.beneficiary_type                        AS                    destination_type,
                ba1.bank_account_title                      AS                    destination_bank_title,
                ba1.bank_account_number                     AS                    destination_bank_number,
                bnk1.bank_name                              AS                    destination_bank_name,
                tc.transaction_category_name                AS                    category_name,
                p.project_name
        FROM transaction_details                            AS                    td
        LEFT JOIN beneficiaries                             AS                    be
        ON      be.beneficiary_id	                          =	                    td.transaction_detail_intermediate_beneficiary
        LEFT JOIN beneficiaries                             AS                    be1
        ON      be1.beneficiary_id	                        =	                    td.transaction_detail_destination_beneficiary
        LEFT JOIN bank_accounts                             AS                    ba
        ON      ba.bank_account_id	                        =	                    be.beneficiary_bank_account
        LEFT JOIN bank_accounts                             AS                    ba1
        ON      ba1.bank_account_id                         =	                    be1.beneficiary_bank_account
        LEFT JOIN banks                                     AS                    bnk
        ON      bnk.bank_id	                                =	                    ba.bank_account_bank
        LEFT JOIN banks                                     AS                    bnk1
        ON      bnk1.bank_id	                              =	                    ba1.bank_account_bank
        LEFT JOIN projects                                  AS                    p
        ON      td.transaction_detail_project	              =	                    p.project_id
        LEFT JOIN transaction_categories	                  AS                    tc
        ON      td.transaction_detail_category	            =	                    tc.transaction_category_id
        WHERE   td.transaction_cluster	                    =	                    :cluster  
        &&      td.transaction_detail_id                    =                     :id
        GROUP BY td.transaction_detail_id";
        $args = [
          'cluster'       =>        $cluster,
          'id'            =>        $id
        ];
        $details  = $this->fetchOrAbort($query, $args);
        if(empty($details)){
          abort(404);
        }
        $response['transaction']                            =                       $transaction;
        $response['details']                                =                       $details;
        return $response;
    }
    public function addTransfer($data){
        try{
            $this->conn->beginTransaction();
            extract($data);
            // GEETING MAX TRANSACTION CLUSTER
            $query          =   "SELECT MAX(transaction_cluster) FROM transactions";
            $_cluster       =   $this->fetchOrAbort($query);
            $cluster        =   $_cluster['MAX(transaction_cluster)']   +   1;
            // INSERTING IN TRANSACTIONS TABLE
            $query          =   "INSERT INTO transactions
            (transaction_date, transaction_amount, transaction_type, transaction_cluster, transaction_account_used)
            VALUES
            (:date, :amount, :type, :cluster, :account_used)";
            $args   =   [
                'date'                      =>              $date,
                'amount'                    =>              $amount,
                'type'                      =>              'online',
                'cluster'                   =>              $cluster,
                'account_used'              =>              $account_used,
            ];
            $transaction_id =   $this->insertOrAbort($query, $args);
            // ADDING TRANSACTIONS DETAILS
            $query  =   "INSERT INTO `transaction_details`
                        (`transaction_detail_date`, 
                        `transaction_detail_intermediate_beneficiary`, 
                        `transaction_detail_destination_beneficiary`, 
                        `transaction_cluster`, 
                        `transaction_detail_purpose`, 
                        `transaction_detail_category`, 
                        `transaction_detail_project`, 
                        `transaction_detail_amount`) 
                    VALUES 
                        (
                        :date,
                        :intermediate,
                        :destination,
                        :cluster,
                        :purpose,
                        :category,
                        :project,
                        :amount)";
            $args   =   [
                'date'                        =>                    $date,
                'intermediate'                =>                    $intermediate,
                'destination'                 =>                    $destination,
                'cluster'                     =>                    $cluster,
                'purpose'                     =>                    $purpose,
                'category'                    =>                    $category,
                'project'                     =>                    $project,
                'amount'                      =>                    $amount,
            ];
            $details_id =   $this->insertOrAbort($query, $args);
            $this->conn->commit();
            $response['detail_id']  = $details_id;
            $response['cluster']    = $cluster;
            return $response;
        } catch (PDOException $e){
            $this->conn->rollBack();
            abort($e->getMessage());
        }
    }
    public function addWithdrawal($data){
        extract($data);
        $this->conn->beginTransaction();
        try{
            $query            =   "SELECT max(transaction_cluster) as cluster from transactions";
            $cluster          =   $this->fetchOrAbort($query);
            // CLUSTER VALUE TO INSERT
            $_cluster         =   (int)$cluster['cluster']  +   1;
            // ADDING DATA TO TRANSACTIONS TABLE
            foreach($withdrawal_amount as $withdrawal_amount){
                $query  =   "INSERT INTO `transactions`
                        (
                          `transaction_date`, 
                          `transaction_amount`, 
                          `transaction_type`, 
                          `transaction_cluster`, 
                          `transaction_account_used`)
                        VALUES 
                        (
                          :date,
                          :amount,
                          :type,
                          :cluster,
                          :account)";
                $args   =   [
                          'date'                =>                $withdrawal_date,
                          'account'             =>                $account_used,
                          'amount'              =>                $withdrawal_amount,
                          'type'                =>                'cash',
                          'cluster'             =>                $_cluster
                ];
                $this->insertOrAbort($query, $args);
            }
            $index  =   0;
            foreach($amount as $amount){
                $query  =   "INSERT INTO `transaction_details`
                            (
                              `transaction_detail_date`, 
                              `transaction_detail_intermediate_beneficiary`, 
                              `transaction_detail_destination_beneficiary`, 
                              `transaction_cluster`, 
                              `transaction_detail_purpose`, 
                              `transaction_detail_category`, 
                              `transaction_detail_project`, 
                              `transaction_detail_amount`) 
                        VALUES 
                            (
                              :date,
                              :intermediate,
                              :destination,
                              :cluster,
                              :purpose,
                              :category,
                              :project,
                              :amount)";
                $args   =   [
                              'date'                =>             $date[$index],
                              'intermediate'        =>             $intermediate[$index],
                              'destination'         =>             $destination[$index],
                              'cluster'             =>             $_cluster,
                              'purpose'             =>             $purpose[$index],
                              'category'            =>             $category[$index],
                              'project'             =>             $project[$index],
                              'amount'              =>             $amount,
                ];
                $details_id = $this->insertOrAbort($query, $args);
                $index++;
            }
            $this->conn->commit();
            $response['detail_id']  = $details_id;
            $response['cluster']    = $_cluster;
            return $response;
        } catch (PDOException $e){
            $this->conn->rollBack();
            abort($e->getMessage());
        }
    }
    public function updateTransfer($data){
      extract($data);
      try{
        $this->conn->beginTransaction();
        $query  = "UPDATE `transactions` SET 
                  `transaction_date`              =           :date,
                  `transaction_amount`            =           :amount,
                  `transaction_account_used`      =           :account_used 
                  WHERE
                  `transaction_id`                =           :transaction_id
                  ";
        $args   = [
                  'date'                          =>          $date,
                  'amount'                        =>          $amount,
                  'account_used'                  =>          $account_used,
                  'transaction_id'                =>          $transaction_id
        ];
        $this->insertOrAbort($query, $args);
        $query  = "UPDATE `transaction_details` SET 
                  `transaction_detail_date`                           =         :date,
                  `transaction_detail_intermediate_beneficiary`       =         :intermediate,
                  `transaction_detail_destination_beneficiary`        =         :destination,
                  `transaction_detail_purpose`                        =         :purpose,
                  `transaction_detail_category`                       =         :category,
                  `transaction_detail_project`                        =         :project,
                  `transaction_detail_amount`                         =         :amount 
                  WHERE 
                  `transaction_detail_id`                             =         :transaction_detail_id
                  ";
        $args   = [
                  'date'=>$date,
                  'intermediate'=>$intermediate,
                  'destination'=>$destination,
                  'purpose'=>$purpose,
                  'category'=>$category,
                  'project'=>$project,
                  'amount'=>$amount,
                  'transaction_detail_id'=>$transaction_detail_id
        ];
        $this->insertOrAbort($query, $args);
        $this->conn->commit();
        return;
      } catch (PDOException $e){
        $this->conn->rollBack();
        abort($e->getMessage(), 404);
      }
    }
    public function updateWithdrawal($data){
      extract($data);
      try{
        $this->conn->beginTransaction();
        $index  = 0;
        // SETTING UP TRANSACTION TABLE
        // FOR EVERY WIRHDRAWAL AMOUNT
        foreach($withdrawal_amount as $wa){
          // CHECK IF IT ALREADY EXISTS IN THE TABLE BY CHECKING IF IT RETURNED TRANSACTION ID BEFORE
          if(array_key_exists($index, $transaction_id)){
            // IF EXISTS THEN UPDATE
            $query  = "UPDATE `transactions` SET 
                      `transaction_date`                          =               :withdrawal_date,
                      `transaction_amount`                        =               :withdrawal_amount,
                      `transaction_account_used`                  =               :account_used
                      WHERE 
                      `transaction_id`                            =                :transaction_id
                      ";
            $args   = [
                      'withdrawal_date'                           =>                $withdrawal_date,
                      'withdrawal_amount'                         =>                $wa,
                      'account_used'                              =>                $account_used,
                      'transaction_id'                            =>                $transaction_id[$index]
                      ];
                      
          } else{
              // IF DONOT EXIST THEN INSERT
            $query  = "INSERT INTO `transactions`(
                      `transaction_date`, 
                      `transaction_amount`, 
                      `transaction_type`, 
                      `transaction_cluster`, 
                      `transaction_account_used`
                      ) VALUES (
                      :withdrawal_date,
                      :withdrawal_amount,
                      :type,
                      :cluster,
                      :account_used
                      )";
            $args   = [
                        'withdrawal_date'                           =>                $withdrawal_date,
                        'withdrawal_amount'                         =>                $withdrawal_amount[$index],
                        'type'                                      =>                $type,
                        'cluster'                                   =>                $cluster,
                        'account_used'                              =>                $account_used,
                      ];
          }
          $index++;
          $response = $this->insertOrAbort($query, $args);
        }
        // SETTING UP TRANSACTION DETAILS TABLE
        // FOR EVERY DETAILS IN DATA
        $index  = 0;
        foreach($amount as $amt){
          // if DETAILS ALREADY EXISTS
          // WE CAN CHECK IT BY USING DETAIL ID IN POST DATA
          if (array_key_exists($index, $detail_id)){
            $query  = "UPDATE `transaction_details` SET 
                      `transaction_detail_date`                                 =                   :date,
                      `transaction_detail_intermediate_beneficiary`             =                   :intermediate,
                      `transaction_detail_destination_beneficiary`              =                   :destination,
                      `transaction_detail_purpose`                              =                   :purpose,
                      `transaction_detail_category`                             =                   :category,
                      `transaction_detail_project`                              =                   :project,
                      `transaction_detail_amount`                               =                   :amount 
                      WHERE 
                      `transaction_detail_id`                                   =                    :detail_id
                      ";
            $args   = [
                      'date'                                                    =>                  $date[$index],
                      'intermediate'                                            =>                  $intermediate[$index],
                      'destination'                                             =>                  $destination[$index],
                      'purpose'                                                 =>                  $purpose[$index],
                      'category'                                                =>                  $category[$index],
                      'project'                                                 =>                  $project[$index],
                      'amount'                                                  =>                  $amt,
                      'detail_id'                                               =>                  $detail_id[$index],
                    ];
          }else{
            $query  = "INSERT INTO `transaction_details`(
                      `transaction_detail_date`, 
                      `transaction_detail_intermediate_beneficiary`, 
                      `transaction_detail_destination_beneficiary`, 
                      `transaction_cluster`, 
                      `transaction_detail_purpose`, 
                      `transaction_detail_category`, 
                      `transaction_detail_project`, 
                      `transaction_detail_amount`
                      ) VALUES (
                        :date,
                        :intermediate,
                        :destination,
                        :cluster,
                        :purpose,
                        :category,
                        :project,
                        :amount
                    )";
            $args = [
              'date'                                                   =>                  $date[$index],
              'intermediate'                                          =>                  $intermediate[$index],
              'destination'                                           =>                  $destination[$index],
              'cluster'                                               =>                  $cluster,
              'purpose'                                               =>                  $purpose[$index],
              'category'                                              =>                  $category[$index],
              'project'                                               =>                  $project[$index],
              'amount'                                                =>                  $amt
            ];  
          }
          $index++;
          $response = $this->insertOrAbort($query, $args);
        }
        $this->conn->commit();
      } catch (PDOException $e){
        $this->conn->rollBack();
        abort($e->getMessage(), 404);
      }
    }
    public function destroy($cluster, $detail_id){
      $this->conn->beginTransaction();
      try{
        $query  = "DELETE FROM `transaction_details` 
                  WHERE 
                  `transaction_detail_id`       =         :detail_id";
        $args   = ['detail_id'=>$detail_id];

        $response = $this->updateOrAbort($query, $args);
        // CHECK IF ANYOTHER TRANSCTION OF SAME CLUSTER EXISITS
        $query  = "SELECT * FROM `transaction_details`
                  WHERE
                  `transaction_cluster`         =         :cluster";
        $args   = ['cluster'=>$cluster];
        $rows = $this->fetchAllOrAbort($query, $args);
        if(count($rows) ==  0){
          $query  = "DELETE FROM `transactions` WHERE `transaction_cluster` = :cluster";
          $args   = ['cluster'=>$cluster];
          $this->deleteOrAbort($query, $args);
        }
        $this->conn->commit();
        return $response;

      } catch (PDOException $e){
        $this->conn->rollBack();
        abort($e->getMessage());
      }
    }
}
?>