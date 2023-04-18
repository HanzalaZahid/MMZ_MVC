<?php
view("partials","head");
view("partials","header");
?>
<body>
    <div class="main_content">
        <div class="content_head">
            <h2 class="title"><?php echo isset($client)?"Edit Client":"Add Client";?></h2>
        </div>
        <?php if(isset($client)):?>
            <?php extract($client)?>
        <?php endif?>
        <form action="/store-client" method="post" class="grid">
            <?php if(isset($client)):?>
                <input type="hidden" name="__method" value="put">
                <input type="hidden" name="client_id" value="<?php echo $client_id?>">
            <?php endif ?>
            <div class="form_group">
                <label for="name">Client Name</label>
                <input type="text" name="name" class="form_field" id="name" placeholder="Enter Client Name" <?php echo isset($client_name)?"value='$client_name'":"" ?> required>
            </div>
            <div class="form_group">
                <label for="">Client Type</label>
                <div class="radio_group">
                    <div>
                        <input type="radio" name="type" value="private" id="private" required <?php
                        if (isset($client_type) &&  $client_type    ==  "private"){
                            echo "checked";
                        }
                        ?>>
                        <label for="private">Private</label>
                    </div>
                    <div>
                        <input type="radio" name="type" value="company" id="company" <?php
                        if (isset($client_type) &&  $client_type    ==  "company"){
                            echo "checked";
                        }
                        ?>>
                        <label for="company">Company</label>
                    </div>
                </div>
            </div>
            <div class="form_group">
                <label for="address">Client Address</label>
                <input type="text" name="address" class="form_field" id="address" placeholder="Enter Client Address" <?php echo isset($client_address)?"value='$client_address'":"";?>>
            </div>
            <div class="form_group">
                <label for="city">City</label>
                <select name="city" id="city" required>
                    <option value="">--Select City--</option>
                    <?php foreach($cities as $city): ?>
                        <option value="<?php echo $city['city_id']; ?>" 
                        <?php
                            if (isset($client_city) &&  $client_city    ==  $city['city_id']){
                                echo "selected";
                            }
                        ?>
                        ><?php echo $city['city_name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form_group">
                <label for="cell1">Phone Number</label>
                <input type="text" name="cell1" class="form_field" id="cell1" placeholder="Enter Client Mobile" <?php echo isset($client_cell_primary)?"value='$client_cell_primary'":"";?>>
            </div>
            <div class="form_group">
                <label for="cell2">Phone Number</label>
                <input type="text" name="cell2" class="form_field" id="cell2" placeholder="Enter Client Mobile" <?php echo isset($client_cell_secondary)?"value='$client_cell_secondary'":"";?>>
            </div>
            <div class="form_group">
                <button type="submit" name="submit"><?php echo isset($client)?"Edit Client":"Add Client";?></button>
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