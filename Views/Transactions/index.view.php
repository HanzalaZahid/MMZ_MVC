<?php 
view('partials', 'head');
view('partials', 'header');
?>
<body class="transactions">
    <div class="main_content">
        <div class="content_head">
            <h2 class="title">Transactions</h2>
            <div class="options">
                <a href="/add-withdrawal">Add Cash Transaction</a>
                <a href="/add-transfer">Add Online Transaction</a>
            </div>
        </div>
        <div class="model-dialogue delete-transaction-dialogue">
            <div class="head">
                <label>Delete Transaction</label>
                <button class="close-model"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="content">
                Do you want to delete transaction?
            </div>
            <div class="foot">
                <button class="secondary">No</button>
                <a class="primary danger" href="delete-transaction?id=">Yes</a>
            </div>
        </div>
        <table class="list Transaction_list">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Beneficiary</th>
                    <th>Type</th>
                    <th>Category</th>
                    <th>Details</th>
                    <th>Project</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if(isset($transactions) && !empty($transactions)):?>
                    <?php foreach($transactions as $transaction):?>
                        <?php extract($transaction)?>

                        <tr>
                            <td><?php echo $detail_id ?></td>
                            <td><?php echo date("F d, Y", strtotime($detail_date)) ?></td>
                            <td><?php echo $detail_amount ?></td>
                            <td><?php echo $destination_name." (". ucfirst($destination_type).")" ?></td>
                            <td><?php echo ucfirst($type) ?></td>
                            <td><?php echo $category_name ?></td>
                            <td><?php echo empty($purpose)?"N/A":$purpose ?></td>
                            <td><?php echo $project_name ?></td>
                            <td>
                                <a onclick="return func(0)" href="/delete-transaction?cluster=<?php echo $cluster?>&detail_id=<?php echo $detail_id?>" class="danger">Delete</a>
                                <a href="/transaction?cluster=<?php echo $cluster?>&detail_id=<?php echo $detail_id?>" class="secondary">Show</a>
                            </td>
                        </tr>
                    <?php endforeach?>
                <?php endif?>
            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function () {
        $('table.list').DataTable();
        });
    </script>
</body>
</html>