<?php 
view("partials","head");
view("partials","header");
?>
<body>
    <div class="main_content">
        <div class="content_head">
            <?php extract($employee);?>
            <h2 class="title"><?php echo $employee_name ?></h2>
            <div class="options">
                <a href="/edit-client">Edit Client</a>
            </div>
        </div>
        <div class="details_container">
            <div class="details_group">
                <label for="name">Name</label>
                <span><?php echo $employee_name ?></span>
            </div>
            <div class="details_group">
                <label for="Catagory">Catagory</label>
                <span><?php echo $employee_category_name ?></span>
            </div>
            <div class="details_group">
                <label for="Contact">Contact</label>
                <span><?php echo (empty($employee_cell_primary)?"N/A":$employee_cell_primary).(empty($employee_cell_secondary)?"":", ".$employee_cell_secondary) ?></span>
            </div>
            <div class="details_group">
                <label for="Address">Address</label>
                <span><?php echo $city_name.", ".$province_name ?></span>
            </div>
            <div class="details_group">
                <label for="about">About</label>
                <span><?php echo empty($employee_about)?"N/A":$employee_about ?></span>
            </div>
            <div class="details_group">
                <label for="Status">Status</label>
                <span>On Project</span>
            </div>
            <div class="details_group">
                <label for="bank">Bank</label>
                <span><?php echo empty($bank_name)?"N/A":$bank_name ?></span>
            </div>
            <div class="details_group">
                <label for="account_title">Account Title</label>
                <span><?php echo empty($bank_account_title)?"N/A":$bank_account_title ?></span>
            </div>
            <div class="details_group">
                <label for="account_number">Account Number</label>
                <span><?php echo empty($bank_account_number)?"N/A":$bank_account_number ?></span>
            </div>
        </div>
        <div class="details_group details_list">
            <label for="team">Projects Contributed</label>
            <ol>
                <li><a href="">NDURE Girls College Road Sahiwal</a></li>
                <li><a href="">Servis Main Bazar Haripur</a></li>
                <li><a href="">Servis Main Bazar Haripur</a></li>
                <li><a href="">Servis Main Bazar Haripur</a></li>
                <li><a href="">Servis Main Bazar Haripur</a></li>
                <li><a href="">Servis Main Bazar Haripur</a></li>
            </ol>
        </div>
        <div class="details_container">
        </div>
    </div>
</body>
</html>