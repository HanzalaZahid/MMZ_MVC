<?php 
view("partials","head");
view("partials","header");
?>
<body>
    <div class="main_content">
        <div class="content_head">
            <h2 class="title">Employees</h2>
            <div class="options">
                <a href="/add-beneficiary">Add Beneficiary</a>
            </div>
        </div>
        <div class="model-dialogue delete-beneficiary-dialogue">
            <div class="head">
                <label>Delete Beneficiary</label>
                <button class="close-model"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="content">
                Do you want to delete beneficiary?
            </div>
            <div class="foot">
                <button class="secondary">No</button>
                <a class="primary danger" href="delete-beneficiary?id=">Yes</a>
            </div>
        </div>
        <div class="table beneficiaries_list">
            <div class="row headings">
                <div class="col">ID</div>
                <div class="col">Name</div>
                <div class="col">Catagory</div>
                <div class="col">City</div>
                <div class="col">Mobile Number</div>
                <div class="col">About</div>
                <div class="col">Action</div>
            </div>
            <?php if (isset($beneficiaries) &&  !empty($beneficiaries)): ?>
                <?php foreach($beneficiaries as $beneficiary):?>
                    <div class="row">
                        <?php extract($beneficiary); ?>
                        <div class="col"><?php echo $beneficiary_id ?></div>
                        <div class="col"><?php echo $beneficiary_name ?></div>
                        <div class="col"><?php echo ucfirst($beneficiary_type) ?></div>
                        <div class="col"><?php echo empty($city_name)?"N/A": $city_name ?></div>
                        <div class="col"><?php echo (empty($beneficiary_cell_primary)?"N/A":$beneficiary_cell_primary).(empty($beneficiary_cell_secondary)?"":", ".$beneficiary_cell_secondary); ?></div>
                        <div class="col"><?php echo empty($beneficiary_about)?"N/A": $beneficiary_about ?></div>                             <div class="col">
                            <a href="/delete-beneficiary?id=<?php echo $beneficiary_id?>" class="danger">Delete</a>
                            <a href="/edit-beneficiary?id=<?php echo $beneficiary_id?>" class="secondary">Edit</a>
                        </div>
                    </div>
                <?Php endforeach ?>
            <?php endif ?>
        </div>
    </div>
</body>
</html>