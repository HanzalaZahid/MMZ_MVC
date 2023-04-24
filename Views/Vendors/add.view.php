<?php 
view("partials","head");
view("partials","header");
?>
<body>
    <div class="main_content">
        <div class="content_head">
            <h2 class="title"><?php echo isset($vendor)?"Edit":"Add";?> Vendor</h2>
        </div>
        <form action="<?php echo isset($vendor)?"/put-vendor":"/store-vendor"?>" method="post" class="grid">
            <?php if(isset($vendor)):?>
                <input type="hidden" name="__method"    value="put">
                <input type="hidden" name="vendor_id" value="<?php echo $vendor['vendor_id']?>">
            <?php endif; ?>
            <div class="form_title">Personal Information</div>
            <div class="form_group">
                <label for="name">Vendor Name</label>
                <input type="text" name="name" id="name" class="form_field" placeholder="Enter Vendor Name" required <?php echo isset($vendor['vendor_name'])?"value    =   '{$vendor['vendor_name']}'":"";?>>
            </div>
            <div class="form_group">
                <label for="city">Vendor City</label>
                <select name="city" id="city">
                    <option value="">--select city--</option>
                    <?php if (!empty($cities)):?>
                        <?php foreach($cities as $city): ?>
                            <?php extract($city); ?>
                            <option value="<?php echo $city_id; ?>" <?php echo (isset($vendor['vendor_city'])   &&  $vendor['vendor_city']  ==  $city_id)?"Selected":"";?>><?php echo $city_name; ?></option>
                        <?php endforeach; ?>
                    <?php endif;?>
                </select>
            </div>
            <div class="form_group">
                <label for="cell1">Vendor Mobile</label>
                <input type="text" name="cell1" id="cell1" class="form_field" placeholder="Enter Vendor Mobile Number" <?php echo isset($vendor['vendor_cell_primary'])?"value    =   '{$vendor['vendor_cell_primary']}'":"";?>>
            </div>
            <div class="form_group">
                <label for="cell2">Vendor Mobile</label>
                <input type="text" name="cell2" id="cell2" class="form_field" placeholder="Enter Vendor Mobile Number" <?php echo isset($vendor['vendor_cell_secondary'])?"value    =   '{$vendor['vendor_cell_secondary']}'":"";?>>
            </div>
            <div class="form_group">
                <label for="about">About Vendor</label>
                <input type="text" name="about" id="about" class="form_field" placeholder="Enter Vendor Details" <?php echo isset($vendor['vendor_about'])?"value    =   '{$vendor['vendor_about']}'":"";?>>
            </div>
            <div class="form_title">Banking Information</div>
            <div class="form_group">
                <label for="bank">Bank Name</label>
                <select name="bank" id="bank">
                    <option value="">--select bank--</option>
                    <?php if (!empty($banks)):?>
                        <?php foreach($banks as $bank): ?>
                            <?php extract($bank); ?>
                            <?php
                            $name   =   str_replace("(","",$bank_name);
                            $name   =   str_replace(")"," -",$name);
                            ?>
                            <option value="<?php echo $bank_id; ?>"  <?php echo (isset($vendor['bank_account_bank'])   &&  $vendor['bank_account_bank']  ==  $bank_id)?"Selected":"";?>><?php echo $name; ?></option>
                        <?php endforeach; ?>
                    <?php endif;?>
                </select>
            </div>
            <div class="form_group">
                <label for="account_title">Account Title</label>
                <input type="text" name="account_title" id="account_title" placeholder="Enter Account Title" <?php echo isset($vendor['bank_account_title'])?"value    =   '{$vendor['bank_account_title']}'":"";?>>
            </div>
            <div class="form_group">
                <label for="account_number">Account Number</label>
                <input type="text" name="account_number" id="account_number" placeholder="Enter Account Number" <?php echo isset($vendor['bank_account_number'])?"value    =   '{$vendor['bank_account_number']}'":"";?>>
            </div>
            <div class="form_group">
                <button type="submit" name="submit"><?php echo isset($vendor)?"Edit":"Add";?> Vendor</button>
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