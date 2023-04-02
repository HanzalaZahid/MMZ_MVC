<?php 
view("partials", "head", $head);
view("partials", "header");
?>
<body>
    <div class="main_content">
        <div class="content_head">
            <h2 class="title">Add Cash Withdrawal Transaction</h2>
            <div class="options">
                <a href="/add-transfer">Add Online Transaction</a>
            </div>
        </div>
        <form action="/store-withdrawal" method="post" class="grid add_withdrawal_transaction">
            <div class="form_title">Transaction Information</div>
            <div class="form_group">
                <label for="withdrawal_date">Transaction Date</label>
                <input type="date" name="withdrawal_date" value="<?php isset($last_transaction_date) ? print($last_transaction_date) : print(date('Y-m-d')); ?>" id="withdrawal_date">
            </div>
            <div class="form_group">
                <label for="account_used">Account Used</label>
                <select name="account_used" id="account_used">
                    <option value="">--Select Account Used--</option>
                    <?php if(isset($company_accounts) && !empty($company_accounts)):?>
                        <?php foreach($company_accounts as $company_account):?>
                            <?php extract($company_account);?>
                            <option value="<?php echo $company_account_id?>"><?php echo $company_account_title." - ".$company_account_number ?></option>
                        <?php endforeach?>
                    <?php endif?>
                </select>
            </div>
            <div class="amount_multiple multi_field_container">
                <div class="form_group amount_group">
                    <label for="amount[]">Amount</label>
                    <input type="number" class="amount_input" name="withdrawal_amount[]" placeholder="Enter Amount">
                </div>
                <button class="amount_field_generator generator_button" type="button"><i class="fa fa-plus" aria-hidden="true"></i></button>
            </div>
            <div class="form_title">Transaction Details</div>
            <div class="multi_details withdrawal_details">
                <div class="detail">
                    <div class="form_group">
                        <label for="date">Transaction Date</label>
                        <input type="date" value="<?php isset($last_transaction_date) ? print($last_transaction_date) : print(date('Y-m-d')); ?>" class="detail_date" name="date[]">
                    </div>
                    <div class="form_group">
                        <label for="date">Transaction Amount</label>
                        <input type="number" class="detail_amount" name="amount[]" placeholder="Enter Amount">
                    </div>
                    <div class="form_group">
                        <label for="intermediate">Intermediate Beneficiary</label>
                        <select name="intermediate[]" class="intermediate">
                            <option value="">--Select Intermediate--</option>
                            <?php if(isset($beneficiaires) && !empty($beneficiaires)):?>
                                <?php foreach($beneficiaires as $beneficiairy):?>
                                    <?php extract($beneficiairy);?>
                                    <option value="<?php echo $beneficiary_id?>"><?php echo $beneficiary_name ." (". ($beneficiary_type  ==  'vendor' ? "Vendor" : $employee_category_name).")".(empty($bank_account_number)?"":" - ".substr($bank_account_number, -6)); ?></option>
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
                                    <option value="<?php echo $beneficiary_id?>"><?php echo $beneficiary_name ." (". ($beneficiary_type  ==  'vendor' ? "Vendor" : $employee_category_name).")".(empty($bank_account_number)?"":" - ".substr($bank_account_number, -6)); ?></option>
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
                                    <option value="<?php echo $project_id?>"><?php echo $project_name ?></option>
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
                                    <option value="<?php echo $transaction_category_id?>"><?php echo $transaction_category_name ?></option>
                                <?php endforeach?>
                            <?php endif?>
                        </select>
                    </div>
                    <div class="form_group">
                        <label for="Purpose">Purpose</label>
                        <input type="text" name="purpose[]" class="detail_purpose" placeholder="Enter Purpose of Transaction">
                    </div>
                </div>
                <button class="detail_generator generator_button" type="button"><i class="fa fa-plus" aria-hidden="true"></i></button>
            </div>
            <div class="form_group">
                <button type="submit" name="submit">Add Transaction</button>
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