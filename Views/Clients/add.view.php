<?php
view("partials","head");
view("partials","header");
?>
<body>
    <div class="main_content">
        <div class="content_head">
            <h2 class="title">Add Client</h2>
        </div>
        <form action="/store-client" method="post" class="grid">
            <div class="form_group">
                <label for="name">Client Name</label>
                <input type="text" name="name" class="form_field" id="name" placeholder="Enter Client Name" required>
            </div>
            <div class="form_group">
                <label for="">Client Type</label>
                <div class="radio_group">
                    <div>
                        <input type="radio" name="type" value="private" id="private" required>
                        <label for="private">Private</label>
                    </div>
                    <div>
                        <input type="radio" name="type" value="company" id="company">
                        <label for="company">Company</label>
                    </div>
                </div>
            </div>
            <div class="form_group">
                <label for="address">Client Address</label>
                <input type="text" name="address" class="form_field" id="address" placeholder="Enter Client Address">
            </div>
            <div class="form_group">
                <label for="city">City</label>
                <select name="city" id="city" required>
                    <option value="">--Select City--</option>
                    <?php foreach($cities as $city): ?>
                        <option value="<?php echo $city['city_id']; ?>"><?php echo $city['city_name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form_group">
                <label for="cell1">Phone Number</label>
                <input type="text" name="cell1" class="form_field" id="cell1" placeholder="Enter Client Mobile">
            </div>
            <div class="form_group">
                <label for="cell2">Phone Number</label>
                <input type="text" name="cell2" class="form_field" id="cell2" placeholder="Enter Client Mobile">
            </div>
            <div class="form_group">
                <button type="submit" name="submit">Add Client</button>
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