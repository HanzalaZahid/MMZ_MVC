<?php
use core\Database;
class Transactions extends Database{
    public function __construct($config)
    {
        parent::__construct($config);
    }
    public function addTransfer($data){
        try{
            $this->conn->beginTransaction();
            extract($data);
            // GEETING MAX TRANSACTION CLUSTER
            $query  =   "SELECT MAX(transaction_cluster) FROM transactions";
            $_cluster    =   $this->fetchOrAbort($query);
            $cluster    =   $_cluster['MAX(transaction_cluster)']   +   1;
            // INSERTING IN TRANSACTIONS TABLE
            $query  =   "INSERT INTO transactions
            (transaction_date, transaction_amount, transaction_type, transaction_cluster, transaction_account_used)
            VALUES
            (:date, :amount, :type, :cluster, :account_used)";
            $args   =   [
                'date'  =>  $date,
                'amount'  =>  $amount,
                'type'  =>  'online',
                'cluster'  =>  $cluster,
                'account_used'  =>  $account_used,
            ];
            $transaction_id =   $this->insertOrAbort($query, $args);
            // ADDING TRANSACTIONS DETAILS
            $query  =   "INSERT INTO `transaction_details`
            (`transaction_detail_date`, `transaction_detail_intermediate_beneficiary`, `transaction_detail_destination_beneficiary`, `transaction_cluster`, `transaction_detail_purpose`, `transaction_detail_category`, `transaction_detail_project`, `transaction_detail_amount`) 
            VALUES 
            (:date,:intermediate,:destination,:cluster,:purpose,:category,:project,:amount)";
            $args   =   [
                'date'  => $date,
                'intermediate'  => $intermediate,
                'destination'  => $destination,
                'cluster'  => $cluster,
                'purpose'  => $purpose,
                'category'  => $category,
                'project'  => $project,
                'amount'  => $amount,
            ];
            $details_id =   $this->insertOrAbort($query, $args);
            $this->conn->commit();
            return $transaction_id;
        } catch (PDOException $e){
            $this->conn->rollBack();
            abort($e->getMessage());
        }
    }
    public function addWithdrawal($data){
        extract($data);
        $this->conn->beginTransaction();
        try{
            $query  =   "SELECT max(transaction_cluster) as cluster from transactions";
            $cluster    =   $this->fetchOrAbort($query);
            // CLUSTER VALUE TO INSERT
            $_cluster    = (int)$cluster['cluster']  +   1;
            // ADDING DATA TO TRANSACTIONS TABLE
            foreach($withdrawal_amount as $withdrawal_amount){
                $query  =   "INSERT INTO `transactions`
                        (`transaction_date`, `transaction_amount`, `transaction_type`, `transaction_cluster`, `transaction_account_used`)
                        VALUES 
                        (:date,:amount,:type,:cluster,:account)";
                $args   =   [
                    'date'  =>  $withdrawal_date,
                    'account'  =>  $account_used,
                    'amount'    =>  $withdrawal_amount,
                    'type'    =>  'cash',
                    'cluster'    =>  $_cluster
                ];
                $this->insertOrAbort($query, $args);
            }
            $index  =   0;
            foreach($amount as $amount){
                $query  =   "INSERT INTO `transaction_details`
                (`transaction_detail_date`, `transaction_detail_intermediate_beneficiary`, `transaction_detail_destination_beneficiary`, `transaction_cluster`, `transaction_detail_purpose`, `transaction_detail_category`, `transaction_detail_project`, `transaction_detail_amount`) 
                VALUES 
                (:date,:intermediate,:destination,:cluster,:purpose,:category,:project,:amount)";
                $args   =   [
                    'date'  =>   $date[$index],
                    'intermediate'  =>   $intermediate[$index],
                    'destination'  =>   $destination[$index],
                    'cluster'  =>   $_cluster,
                    'purpose'  =>   $purpose[$index],
                    'category'  =>   $category[$index],
                    'project'  =>   $project[$index],
                    'amount'  =>   $amount,
                ];
                $this->insertOrAbort($query, $args);
                $index++;
            }
            $this->conn->commit();
            return $_cluster;
        } catch (PDOException $e){
            $this->conn->rollBack();
            abort($e->getMessage());
        }
    }
    public function add($data){
        extract($data);
        $query  =   "INSERT INTO `transaction_details`
            (`transaction_detail_date`, `transaction_detail_intermediate_beneficiary`, `transaction_detail_destination_beneficiary`, `transaction_cluster`, `transaction_detail_purpose`, `transaction_detail_category`, `transaction_detail_project`, `transaction_detail_amount`) 
            VALUES 
            (:date,:intermediate,:destination,:cluster,:purpose,:category,:project,:amount)";
            $args   =   [
                'date'  => $date,
                'intermediate'  => $intermediate,
                'destination'  => $destination,
                'cluster'  => $cluster,
                'purpose'  => $purpose,
                'category'  => $category,
                'project'  => $project,
                'amount'  => $amount,
            ];
            $details_id =   $this->insertOrAbort($query, $args);
    }
}
?>