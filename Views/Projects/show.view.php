<?php 
view("partials","head");
view("partials","header");
?>
<body>
    <div class="main_content">
        <div class="content_head">
            <h2 class="title"><?php echo $project_name ?></h2>
            <div class="options">
                <a href="/edit-project">Edit Project</a>
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
                <span>54156165</span>
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
        <div class="details_group details_list">
            <label for="team">Project Team</label>
            <ol>
                <li><a href="">Ameer Hamza (Electrician)</a></li>
                <li><a href="">Riaz Bhai (Carpenter)</a></li>
                <li><a href="">Riaz Bhai (Carpenter)</a></li>
                <li><a href="">Riaz Bhai (Carpenter)</a></li>
                <li><a href="">Riaz Bhai (Carpenter)</a></li>
                <li><a href="">Riaz Bhai (Carpenter)</a></li>
            </ol>
        </div>
        <div class="details_container">
        </div>
    </div>
</body>
</html>