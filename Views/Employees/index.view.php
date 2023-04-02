<?php 
view("partials","head");
view("partials","header");
?>
<body>
    <div class="main_content">
        <div class="content_head">
            <h2 class="title">Employees</h2>
            <div class="options">
                <a href="/add-employee">Add Employee</a>
            </div>
        </div>
        <div class="table employees_list">
            <div class="row headings">
                <div class="col">ID</div>
                <div class="col">Name</div>
                <div class="col">Catagory</div>
                <div class="col">City</div>
                <div class="col">Mobile Number</div>
                <div class="col">About</div>
                <div class="col">Status</div>
                <div class="col">Action</div>
            </div>
            <?php if (isset($employees) &&  !empty($employees)): ?>
                <?php foreach($employees as $employee):?>
                    <div class="row">
                        <?php extract($employee); ?>
                        <div class="col"><?php echo $employee_id ?></div>
                        <div class="col"><?php echo $employee_name ?></div>
                        <div class="col"><?php echo $employee_category_name ?></div>
                        <div class="col"><?php echo empty($city_name)?"N/A": $city_name ?></div>
                        <div class="col"><?php echo (empty($employee_cell_primary)?"N/A":$employee_cell_primary).(empty($employee_cell_secondary)?"":", ".$employee_cell_secondary); ?></div>
                        <div class="col"><?php echo empty($employee_about)?"N/A": $employee_about ?></div>     
                        <div class="col negative">On Project</div>
                        <div class="col">
                            <a href="/delete-employee?id=<?php echo $employee_id?>" class="danger">Delete</a>
                            <a href="/employee?id=<?php echo $employee_id?>" class="secondary">Show</a>
                        </div>
                    </div>
                <?Php endforeach ?>
            <?php endif ?>
        </div>
    </div>
</body>
</html>