<?php 
view("partials","head");
view("partials","header");
?>
<body>
    <div class="main_content">
        <div class="content_head">
            <h2 class="title">Projects</h2>
            <div class="options">
                <a href="/add-project">Add Project</a>
            </div>
        </div>
        <div class="model-dialogue delete-project-dialogue">
            <div class="head">
                <label>Delete Transaction</label>
                <button class="close-model"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="content">
                Do you want to delete Project?
            </div>
            <div class="foot">
                <button class="secondary">No</button>
                <a class="primary danger" href="">Yes</a>
            </div>
        </div>
        <div class="table projects_list">
            <div class="row headings">
                <div class="col">ID</div>
                <div class="col">Name</div>
                <div class="col">Client</div>
                <div class="col">City</div>
                <div class="col">Start Date</div>
                <div class="col">End Date</div>
                <div class="col">Invested</div>
                <div class="col">Profit</div>
                <div class="col">Payment Status</div>
                <div class="col">Action</div>
            </div>
            <?php if(!empty($projects)):?>
                <?php $index  =   0;?>
                <?php foreach($projects as $project): ?>
                    <?php extract($project) ?>
                    <div class="row">
                        <div class="col"><?php echo $project_id;?></div>
                        <div class="col"><?php echo $project_name;?></div>
                        <div class="col"><?php echo $client_name;?></div>
                        <div class="col"><?php echo $project_location.", ".$city_name.", ".$province_name;?></div>
                        <div class="col"><?php echo date('F d, Y', strtotime($project_start_date))?></div>
                        <div class="col"><?php echo date('F d, Y', strtotime($project_end_date))?></div>
                        <div class="col"><?php echo $investment[$index];?></div>
                        <div class="col negative">-78023</div>
                        <div class="col positive">Recieved</div>
                        <div class="col">
                            <a href="/delete-project?id=<?php echo $project_id;?>" class="danger">Delete</a>
                            <a href="/project?id=<?php echo $project_id;?>" class="secondary">Show</a>
                        </div>
                    </div>
                    <?php $index++; ?>
                <?php endforeach ?>
            <?php endif?>
        </div>
    </div>
</body>
</html>