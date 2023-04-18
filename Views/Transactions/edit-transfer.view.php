<?php 
view("partials", "head");
view("partials", "header");
?>
<body>
    <?php
    extract($transaction);
    extract($details);
    ?>
    <div class="main_content">
        <div class="content_head">
            <h2 class="title">Edit Online Transaction</h2>
        </div>
        <form action="/put-transaction" method="post" class="grid add_online_transaction">
            <input type="hidden" name="__method" value="put">
            <input type="hidden" name="type" value="online">
            <input type="hidden" name="transaction_id"  value="<?php echo $transaction[0]['transaction_id'];?>">
            <input type="hidden" name="transaction_detail_id"  value="<?php echo $details[0]['transaction_detail_id'];?>">
            <input type="hidden" name="cluster" value="<?php echo $transaction[0]['transaction_cluster'];?>">
            
            <div class="form_title">Transaction Information</div>
            <div class="form_group">
                <label for="date">Transaction Date</label>
                <input type="date" value="<?php echo $transaction[0]['transaction_date'] ?>" name="date" id="date">
            </div>
            <div class="form_group">
                <label for="account_used">Account Used</label>
                <select name="account_used" id="account_used">
                    <option value="">--Select Account Used--</option>
                    <?php if(isset($company_accounts) && !empty($company_accounts)):?>
                        <?php foreach($company_accounts as $company_account):?>
                            <?php extract($company_account);?>
                            <option value="<?php echo $company_account_id?>" <?php echo ($company_account_id ==   $transaction[0]['transaction_account_used'])?"selected":"";?>><?php echo $company_account_title." - ".$company_account_number ?></option>
                        <?php endforeach?>
                    <?php endif?>
                </select>
            </div>
            <div class="form_group">
                <label for="amount">Amount</label>
                <input type="number" name="amount" placeholder="Enter Amount" value="<?php echo $transaction[0]['transaction_amount'];?>">
            </div>
            <div class="form_group">
                <label for="intermediate">Intermediate Beneficiary</label>
                <select name="intermediate" id="intermediate">
                    <option value="">--Select Intermediate--</option>
                    <?php if(isset($beneficiaires) && !empty($beneficiaires)):?>
                        <?php foreach($beneficiaires as $beneficiairy):?>
                            <?php extract($beneficiairy);?>
                            <option value="<?php echo $beneficiary_id?>" <?php echo ($beneficiary_id ==  $details[0]['transaction_detail_intermediate_beneficiary'])?"Selected":"";?>><?php echo $beneficiary_name ." (". ($beneficiary_type  ==  'vendor' ? "Vendor" : $employee_category_name).")".(empty($bank_account_number)?"":" - ".substr($bank_account_number, -6)); ?></option>
                        <?php endforeach?>
                    <?php endif?>
                </select>
            </div>
            <div class="form_group">
                <label for="destination">Destination Beneficiary</label>
                <select name="destination" id="destination">
                    <option value="">--Select Destination--</option>
                    <?php if(isset($beneficiaires) && !empty($beneficiaires)):?>
                        <?php foreach($beneficiaires as $beneficiairy):?>
                            <?php extract($beneficiairy);?>
                            <option value="<?php echo $beneficiary_id?>" <?php echo ($beneficiary_id ==  $details[0]['transaction_detail_destination_beneficiary'])?"Selected":"";?>><?php echo $beneficiary_name ." (". ($beneficiary_type  ==  'vendor' ? "Vendor" : $employee_category_name).")".(empty($bank_account_number)?"":" - ".substr($bank_account_number, -6)); ?></option>
                        <?php endforeach?>
                    <?php endif?>
                </select>
            </div>
            <div class="form_title">Transaction Details</div>
            <div class="form_group">
                <label for="project">Project</label>
                <select name="project" id="project">
                    <option value="">--Select Project--</option>
                    <?php if(isset($projects) && !empty($projects)):?>
                        <?php foreach($projects as $project):?>
                            <?php extract($project);?>
                            <option value="<?php echo $project_id?>" <?php echo ($project_id ==  $details[0]['transaction_detail_project'])?"Selected":"";?>><?php echo $project_name ?></option>
                        <?php endforeach?>
                    <?php endif?>
                </select>
            </div>
            <div class="form_group">
                <label for="category">Category</label>
                <select name="category" id="category">
                    <option value="">--Select Category--</option>
                    <?php if(isset($transaction_categories) && !empty($transaction_categories)):?>
                        <?php foreach($transaction_categories as $category):?>
                            <?php extract($category);?>
                            <option value="<?php echo $transaction_category_id?>" <?php echo ($transaction_category_id ==  $details[0]['transaction_detail_category'])?"Selected":"";?>><?php echo $transaction_category_name ?></option>
                        <?php endforeach?>
                    <?php endif?>
                </select>
            </div>
            <div class="form_group">
                <label for="Purpose">Purpose</label>
                <input type="text" name="purpose" placeholder="Enter Purpose of Transaction" value="<?php echo $details[0]['transaction_detail_purpose'];?>">
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