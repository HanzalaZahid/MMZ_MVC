<?php 
view("partials", "head", $head);
view("partials", "header");
extract($transaction);
?>
<body>
    <div class="main_content">
        <div class="content_head">
            <h2 class="title">Edit Cash Withdrawal Transaction</h2>
        </div>
        <form action="/put-transaction" method="post" class="grid add_withdrawal_transaction">
            <div class="form_title">Transaction Information</div>
            <input type="hidden" name="__method"  value="put">
            <input type="hidden" name="type"  value="cash">
            <input type="hidden" name="cluster"  value="<?php echo $transaction[0]['transaction_cluster'];?>">
            <input type="hidden" name="type"  value="<?php echo $transaction[0]['transaction_type'];?>">
            <div class="form_group">
                <label for="withdrawal_date">Transaction Date</label>
                <input type="date" name="withdrawal_date" value="<?php isset($transaction[0]['transaction_date']) ? print($transaction[0]['transaction_date']) : print(date('Y-m-d')); ?>" id="withdrawal_date">
            </div>
            <div class="form_group">
                <label for="account_used">Account Used</label>
                <select name="account_used" id="account_used">
                    <option value="">--Select Account Used--</option>
                    <?php if(isset($company_accounts) && !empty($company_accounts)):?>
                        <?php foreach($company_accounts as $company_account):?>
                            <?php extract($company_account);?>
                            <option value="<?php echo $company_account_id?>" <?php echo (isset($transaction[0]['transaction_account_used']) &&  $company_account_id ==  $transaction[0]['transaction_account_used'])?"Selected":"";?>><?php echo $company_account_title." - ".$company_account_number ?></option>
                        <?php endforeach?>
                    <?php endif?>
                </select>
            </div>
            <div class="amount_multiple multi_field_container">
                <?php foreach($transaction as $t):?>
                    <div class="form_group amount_group">
                        <input type="hidden" class="transaction_id" name="transaction_id[]"  value="<?php echo $t['transaction_id'];?>">
                        <label for="amount[]">Amount</label>
                        <input type="number" class="amount_input" value=<?php echo $t['transaction_amount'];?> name="withdrawal_amount[]" placeholder="Enter Amount">
                    </div>
                <?php endforeach;?>
                <button class="amount_field_generator generator_button" type="button"><i class="fa fa-plus" aria-hidden="true"></i></button>
            </div>
            <div class="form_title">Transaction Details</div>
            <div class="multi_details withdrawal_details">
                <?php foreach($details as $d):?>
                    <div class="detail">
                        <input type="hidden" name="detail_id[]" class="hidden" value="<?php echo $d['transaction_detail_id']?>">
                        <div class="form_group">
                            <label for="date">Transaction Date</label>
                            <input type="date" value="<?php isset($d['transaction_detail_date']) ? print($d['transaction_detail_date']) : print(date('Y-m-d')); ?>" class="detail_date" name="date[]">
                        </div>
                        <div class="form_group">
                            <label for="date">Transaction Amount</label>
                            <input type="number" value="<?php echo $d['transaction_detail_amount']?>" class="detail_amount" name="amount[]" placeholder="Enter Amount">
                        </div>
                        <div class="form_group">
                            <label for="intermediate">Intermediate Beneficiary</label>
                            <select name="intermediate[]" class="intermediate">
                                <option value="">--Select Intermediate--</option>
                                <?php if(isset($beneficiaires) && !empty($beneficiaires)):?>
                                    <?php foreach($beneficiaires as $beneficiairy):?>
                                        <?php extract($beneficiairy);?>
                                        <option value="<?php echo $beneficiary_id?>" <?php echo ($beneficiary_id ==  $d['transaction_detail_intermediate_beneficiary'])?"Selected":"";?>><?php echo $beneficiary_name ." (". ($beneficiary_type  ==  'vendor' ? "Vendor" : $employee_category_name).")".(empty($bank_account_number)?"":" - ".substr($bank_account_number, -6)); ?></option>
                                    <?php endforeach?>
                                <?php endif?>
                            </select>
                        </div>
                        <div class="form_group">
                            <label for="destination">Destination Beneficiary</label>
                            <select name="destination[]" class="destination">
                                <option value="">--Select Destination--</option>
                                <?php if(isset($beneficiaires) && !empty($beneficiaires)):?>
                                    <?php foreach($beneficiaires as $beneficiairy):?>
                                        <?php extract($beneficiairy);?>
                                        <option value="<?php echo $beneficiary_id?>" <?php echo ($beneficiary_id ==  $d['transaction_detail_destination_beneficiary'])?"Selected":"";?>><?php echo $beneficiary_name ." (". ($beneficiary_type  ==  'vendor' ? "Vendor" : $employee_category_name).")".(empty($bank_account_number)?"":" - ".substr($bank_account_number, -6)); ?></option>
                                    <?php endforeach?>
                                <?php endif?>
                            </select>
                        </div>
                        <div class="form_group">
                            <label for="project">Project</label>
                            <select name="project[]" class="project">
                                <option value="">--Select Project--</option>
                                <?php if(isset($projects) && !empty($projects)):?>
                                    <?php foreach($projects as $project):?>
                                        <?php extract($project);?>
                                        <option value="<?php echo $project_id?>" <?php echo ($project_id ==  $d['transaction_detail_project'])?"Selected":"";?>><?php echo $project_name ?></option>
                                    <?php endforeach?>
                                <?php endif?>
                            </select>
                        </div>
                        <div class="form_group">
                            <label for="category">Category</label>
                            <select name="category[]" class="category">
                                <option value="">--Select Category--</option>
                                <?php if(isset($transaction_categories) && !empty($transaction_categories)):?>
                                    <?php foreach($transaction_categories as $category):?>
                                        <?php extract($category);?>
                                        <option value="<?php echo $transaction_category_id?>" <?php echo ($transaction_category_id ==  $d['transaction_detail_category'])?"Selected":"";?>><?php echo $transaction_category_name ?></option>
                                    <?php endforeach?>
                                <?php endif?>
                            </select>
                        </div>
                        <div class="form_group">
                            <label for="Purpose">Purpose</label>
                            <input type="text" value="<?php echo $d['transaction_detail_purpose'];?>" name="purpose[]" class="detail_purpose" placeholder="Enter Purpose of Transaction">
                        </div>
                    </div>
                <?php endforeach;?>
                <button class="detail_generator generator_button" type="button"><i class="fa fa-plus" aria-hidden="true"></i></button>
            </div>
            <div class="form_group">
                <button type="submit" name="submit">Edit Transaction</button>
            </div>
        </form>
        <?php if(!empty($errors)):?>
            <div class="form_errors">
                <ol>
                    <?php foreach($errors as $error):?>
                        <li><?php echo $error?></li>
                    <?php endforeach ?>
                    </ol>
            </div>
        <?php endif ?>
    </div>
</body>
</html>