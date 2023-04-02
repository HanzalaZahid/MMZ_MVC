<?php 
view("partials","head", $head);
view("partials","header");
?>
<body>
    <div class="main_content">
        <div class="content_head">
            <h2 class="title">Add Project</h2>
        </div>
        <form action="/store-project" method="post" class="grid">
            <div class="form_group">
                <label for="client">Client Name</label>
                <select name="client" id="client" required>
                    <option value="">--select client--</option>
                    <?php if(!empty($clients)):?>
                    <?php foreach($clients as $client): ?>
                        <?php extract($client); ?>
                        <option value="<?php echo $client_id; ?>"><?php echo $client_name . " - ". $city_name; ?></option>
                    <?php endforeach ?>
                    <?php endif ?>
                </select>
            </div>
            <div class="form_group">
                <label for="city">Project City</label>
                <select name="city" id="city" required>
                    <option value="">--select city--</option>
                    <?php if(!empty($cities)): ?>
                        <?php foreach($cities as $city): ?>
                            <?php extract($city); ?>
                            <option value="<?php echo $city_id; ?>"><?php echo $city_name; ?></option>
                        <?php endforeach ?>
                    <?php endif ?>
                </select>
            </div>
            <div class="form_group">
                <label for="location">Project Location</label>
                <input type="text" name="location" id="location" placeholder="Enter Project Location" required>
            </div>
            <div class="form_group">
                <label for="project_name">Project Name</label>
                <input type="text" name="project_name" id="project_name" placeholder="Enter Project Name" required>
            </div>
            <div class="form_group">
                <label for="start_date">Start Date</label>
                <input type="date" name="start_date" id="start_date" required>
            </div>
            <div class="form_group">
                <label for="end_date">End Date</label>
                <input type="date" name="end_date" id="end_date" required>
            </div>
            
            <div class="form_group">
                <button type="submit" name="submit">Add Project</button>
            </div>
        </form>
        <?php if(!empty($errors)):?>
            <div class="form_errors">
                <ol>
                    <?php foreach($errors as $error):?>
                        <li><?php echo $error?></li>
                    <?php endforeach ?>
                    </ol>
            </div>
        <?php endif ?>
    </div>
</body>
</html>