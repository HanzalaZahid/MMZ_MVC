<?php 
view("partials","head");
view("partials","header");
?>
<body>
    <div class="main_content">
        <div class="content_head">
            <h2 class="title">Clients</h2>
            <div class="options">
                <a href="/add-client">Add Client</a>
            </div>
        </div>
        <div class="table clients_list">
            <div class="row headings">
                <div class="col">ID</div>
                <div class="col">Name</div>
                <div class="col">Type</div>
                <div class="col">Address</div>
                <div class="col">Contact</div>
                <div class="col">Invested</div>
                <div class="col">Payments Pending</div>
                <div class="col">Payment Recieved</div>
                <div class="col">Action</div>
            </div>
            <?php if(!empty($clients)): ?>
                <?php foreach($clients as $client):?>
                    <?php extract($client); ?>
                    <div class="row">
                        <div class="col"><?php echo $client_id; ?></div>
                        <div class="col"><?php echo $client_name; ?></div>
                        <div class="col"><?php echo ucfirst($client_type); ?></div>
                        <div class="col"><?php echo $client_address.", ".$city_name.", ".$province_name; ?></div>
                        <div class="col"><?php echo (empty($client_cell_primary)?"N/A":$client_cell_primary).(empty($client_cell_secondary)?"":", ".$client_cell_secondary); ?></div>
                        <div class="col">100000</div>
                        <div class="col">78023</div>
                        <div class="col">965654</div>
                        <div class="col">
                            <a href="delete-client?id=<?php echo $client_id;?>" class="danger">Delete</a>
                            <a href="/client?id=<?php echo $client_id;?>" class="secondary">Show</a>
                        </div>
                    </div>
                    <?php endforeach ?>
                <?php endif ?>
        </div>
    </div>
</body>
</html>