<?php 
view("partials","head");
view("partials","header");
?>
<body>
    <div class="main_content">
        <div class="content_head">
            <?php extract($client);?>
            <h2 class="title"><?php echo $client_name; ?></h2>
            <div class="options">
                <a href="/edit-client?id=<?php echo $client_id?>">Edit Client</a>
            </div>
        </div>
        <div class="details_container">
            <div class="details_group">
                <label for="name">Name</label>
                <span><?php echo $client_name; ?></span>
            </div>
            <div class="details_group">
                <label for="type">Type</label>
                <span><?php echo ucfirst($client_type); ?></span>
            </div>
            <div class="details_group">
                <label for="Contact">Contact</label>
                <span><?php echo (empty($client_cell_primary)?"N/A":$client_cell_primary).(empty($client_cell_secondary)?"":", ".$client_cell_secondary); ?></span>
            </div>
            <div class="details_group">
                <label for="Address">Address</label>
                <span><?php echo $client_address.", ".$city_name.", ".$province_name; ?></span>
            </div>
            <div class="details_group">
                <label for="projects">Projects</label>
                <span>--To Add. Pending--</span>
            </div>
        </div>
    </div>
</body>
</html>