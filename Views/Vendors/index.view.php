<?php 
view("partials","head");
view("partials","header");
?>
<body>
    <div class="main_content">
        <div class="content_head">
            <h2 class="title">Vendors</h2>
            <div class="options">
                <a href="/add-vendor">Add Vendor</a>
            </div>
        </div>
        <div class="model-dialogue delete-vendor-dialogue">
            <div class="head">
                <label>Delete Transaction</label>
                <button class="close-model"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="content">
                Do you want to delete Employee?
            </div>
            <div class="foot">
                <button class="secondary">No</button>
                <a class="primary danger" href="">Yes</a>
            </div>
        </div>
        <div class="table vendors_list">
            <div class="row headings">
                <div class="col">ID</div>
                <div class="col">Name</div>
                <div class="col">Location</div>
                <div class="col">Mobile Number</div>
                <div class="col">About</div>
                <div class="col">Action</div>
            </div>
            <?php if(isset($vendors) && !empty($vendors)): ?>
                <?php foreach($vendors as $vendor): ?>
                    <?php extract($vendor) ?>
                    <div class="row">
                        <div class="col"><?php echo $vendor_id ?></div>
                        <div class="col"><?php echo $vendor_name ?></div>
                        <div class="col"><?php echo $city_name .", ".$province_name; ?></div>
                        <div class="col"><?php echo (empty($vendor_cell_primary)?"N/A": $vendor_cell_primary).(empty($vendor_cell_secondary)?"":", ".$vendor_cell_secondary) ?></div>
                        <div class="col"><?php echo empty($vendor_about)?"N/A": $vendor_about ?></div>
                        <div class="col">
                            <a href="delete-vendor?id=<?php echo $vendor_id ?>" class="danger">Delete</a>
                            <a href="/vendor?id=<?php echo $vendor_id ?>" class="secondary">Show</a>
                        </div>
                    </div>
                <?php endforeach ?>
            <?php endif ?>
        </div>
    </div>
</body>
</html>