<?php
view("partials","head");
view("partials","header");
?>
<body>
    <div class="main_content">
        <div class="content_head">
            <h2 class="title">Transaction</h2>
            <div class="options">
                <a href="/edit-transaction?cluster=<?php echo $transaction[0]['transaction_cluster']?>">Edit Transaction</a>
            </div>
        </div>
        <div class="details_container">
            <?php
            extract($details);
            ?>
            <div class="details_group">
                <label for="account_used">Account Used</label>
                <span><?php echo $transaction[0]['company_account_title']."<br>".$transaction[0]['company_account_number']."<br>".$transaction[0]['bank_name']?></span>
            </div>
            <div class="details_group">
                <label for="date">Date</label>
                <span><?php echo date('F d, Y', strtotime($transaction_detail_date))?></span>
            </div>
            
            <div class="details_group">
                <label for="amount">Amount</label>
                <span><?php echo $transaction_detail_amount?></span>
            </div>
            <div class="details_group">
                <label for="type">Type</label>
                <span><?php echo ucfirst($transaction[0]['transaction_type'])?></span>
            </div>
            <div class="details_group">
                <label for="project">Project</label>
                <span><?php echo $project_name?></span>
            </div>
            <div class="details_group">
                <label for="project">Category</label>
                <span><?php echo $category_name?></span>
            </div>
            <div class="details_group">
                <label for="description">Description</label>
                <span><?php echo empty($transaction_detail_purpose)?"N/A":$transaction_detail_purpose?></span>
            </div>
        </div>
        <?php if(!(($intermediate_name === $destination_name) && ($intermediate_type == $destination_type) && ($intermediate_bank_title == $destination_bank_title) && ($intermediate_bank_number == $destination_bank_number))): ?>
            <div class="row beneficiaries_transfer">
                <div class="column">
                    <div class="title">Intermediate</div>
                    <ul>
                        <li><?php echo $intermediate_name ?></li>
                        <li><?php echo ucfirst($intermediate_type) ?></li>
                        <?php if (!empty($intermediate_bank_title)): ?>
                            <li><?php echo ucfirst($intermediate_bank_title) ?></li>
                            <li><?php echo ucfirst($intermediate_bank_number) ?></li>
                            <li><?php echo ucfirst($intermediate_bank_name) ?></li>
                        <?php endif ?>
                    </ul>
                </div>
                <div class="column">
                    <i class="fa-sharp fa-solid fa-arrow-right"></i>
                </div>
                <div class="column">
                    <div class="title">Destination</div>
                    <ul>
                        <li><?php echo $destination_name ?></li>
                        <li><?php echo ucfirst($destination_type) ?></li>
                        <?php if (!empty($destination_bank_name)): ?>
                            <li><?php echo ucfirst($destination_bank_title) ?></li>
                            <li><?php echo ucfirst($destination_bank_number) ?></li>
                            <li><?php echo ucfirst($destination_bank_name) ?></li>
                        <?php endif ?>
                    </ul>
                </div>
            </div>
            <?php else: ?>
                <div class="column destination_details">
                    <div class="title">Beneficairy Details</div>
                    <ul>
                        <li><div class="label">Name</div><?php echo $destination_name ?></li>
                        <li><div class="label">Type</div><?php echo ucfirst($destination_type) ?></li>
                        <?php if (!empty($destination_bank_name)): ?>
                            <li><div class="label">Account Title</div><?php echo ucfirst($destination_bank_title) ?></li>
                            <li><div class="label">Account Number</div><?php echo ucfirst($destination_bank_number) ?></li>
                            <li><div class="label">Bank</div><?php echo ucfirst($destination_bank_name) ?></li>
                        <?php endif ?>
                    </ul>
                </div>
                <?php endif ?>

        <table class="simple transaction_details">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Account Used</th>
                    <th>Amount</th>
                    <th>Type</th>
                    <!-- <th>Cluster</th> -->
                </tr>
            </thead>
            <tbody>
                <?php foreach($transaction as $transaction):?>
                    <?php extract($transaction);?>
                    <tr>
                        <td><?php echo $transaction_id; ?></td>
                        <td><?php echo date("F d,Y", strtotime($transaction_date)); ?></td>
                        <td><?php echo $company_account_title."-".substr($company_account_number, -4)."<br>".$bank_name; ?></td>
                        <td><?php echo $transaction_amount; ?></td>
                        <td><?php echo ucfirst($transaction_type); ?></td>
                    </tr>
                <?php endforeach?>
            </tbody>
        </table>
    </div>
</body>
</html>