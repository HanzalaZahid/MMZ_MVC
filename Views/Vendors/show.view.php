<?php 
view("partials","head");
view("partials","header");
?>
<body>
    <div class="main_content">
        <div class="content_head">
            <?php extract($vendor);?>
            <h2 class="title"><?php echo $vendor_name; ?></h2>
            <div class="options">
                <a href="/edit-vendor?vendor_id=<?php echo $vendor_id;?>">Edit Vendor</a>
            </div>
        </div>
        <div class="details_container">
            <div class="details_group">
                <label for="name">Name</label>
                <span><?php echo $vendor_name; ?></span>
            </div>
            <div class="details_group">
                <label for="Contact">Contact</label>
                <span><?php echo (empty($vendor_cell_primary)?"N/A":$vendor_cell_primary).(empty($vendor_cell_secondary)?"":", ".$vendor_cell_secondary); ?></span>
            </div>
            <div class="details_group">
                <label for="Address">Address</label>
                <span><?php echo $city_name.", ".$province_name; ?></span>
            </div>
            <div class="details_group">
                <label for="about">About</label>
                <span><?php echo $vendor_about; ?></span>
            </div>
            <div class="details_group">
                <label for="bank">Bank</label>
                <span><?php echo empty($bank_name)?"N/A":$bank_name; ?></span>
            </div>
            <div class="details_group">
                <label for="account_title">Account Title</label>
                <span><?php echo empty($bank_account_title)?"N/A":$bank_account_title; ?></span>
            </div>
            <div class="details_group">
                <label for="account_number">Account Number</label>
                <span><?php echo empty($bank_account_number)?"N/A":$bank_account_number; ?></span>
            </div>
            <div class="details_group">
                <label for="total_purchase">Total Purchase</label>
                <span>65650313</span>
            </div>
            <div class="details_group">
                <label for="last_30_days">Purchase This Year</label>
                <span>1650313</span>
            </div>
            <div class="details_group">
                <label for="last_30_days">Last 30 days</label>
                <span>650313</span>
            </div>
        </div>
        <!-- <table class="list">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Total Bill</th>
                    <th>Payment Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>May 28, 2022</td>
                    <td>5000</td>
                    <td>Cash</td>
                    <td>
                        <a href="" class="danger">Delete</a>
                        <a href="" class="secondary">Show</a>
                    </td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>May 28, 2022</td>
                    <td>5000</td>
                    <td>Online</td>
                    <td>
                        <a href="" class="danger">Delete</a>
                        <a href="" class="secondary">Show</a>
                    </td>
                </tr>
            </tbody>
        </table> -->
    </div>
    <script>
        $(document).ready(function () {
        $('table.list').DataTable();
        });
    </script>
</body>
</html>