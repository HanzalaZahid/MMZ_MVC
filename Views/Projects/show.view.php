<?php 
view("partials","head");
view("partials","header");
?>
<body>
    <?php extract($project)?>
    <div class="main_content">
        <div class="content_head">
            <h2 class="title"><?php echo $project_name ?></h2>
            <div class="options">
                <a href="/add-project-team?project_id=<?php echo $project_id?>">Manage Team</a>
                <a href="/edit-project?project_id=<?php echo $project_id?>">Edit Project</a>
            </div>
        </div>
        <div class="details_container">
            <div class="details_group">
                <label for="name">Name</label>
                <span><?php echo $project_name ?></span>
            </div>
            <div class="details_group">
                <label for="client">Client</label>
                <span><?php echo $client_name ?></span>
            </div>
            <div class="details_group">
                <label for="Location">Location</label>
                <span><?php echo $project_location.", ".$city_name,", ".$province_name; ?></span>
            </div>
            <div class="details_group">
                <label for="start">Start Date</label>
                <span><?php echo date('F d, Y', strtotime($project_start_date)); ?></span>
            </div>
            <div class="details_group">
                <label for="end">End Date</label>
                <span><?php echo date('F d, Y', strtotime($project_end_date)); ?></span>
            </div>
            <div class="details_group">
                <label for="invested">Invested</label>
                <span><?php echo $investment ?></span>
            </div>
            <div class="details_group">
                <label for="received">Received</label>
                <span>64156165</span>
            </div>
            <div class="details_group">
                <label for="profit">Profit</label>
                <span class="positive">64156165</span>
            </div>
        </div>
        <?php if (isset($team)):?>
        <div class="details_group details_list">
            <label for="team">Project Team</label>
            <ol>
                <?php foreach($team as $member):?>
                    <li><a href="/employee?id=<?php echo $member['employee_id'];?>"><?php echo $member['employee_name'] . ' (' . $member['employee_category_name'] . (isset($member['employee_about']) ? " - {$member['employee_about']}" : "") . ')';?></a></li>
                <?php endforeach; ?>
            </ol>
        </div>
        <?php endif; ?>
        <div class="details_container">
        </div>
    </div>
</body>
</html>