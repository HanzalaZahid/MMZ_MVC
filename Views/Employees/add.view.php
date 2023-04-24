<?php 
view("partials","head");
view("partials","header");
?>
<body>
    <div class="main_content">
        <div class="content_head">
            <h2 class="title"><?php echo isset($employee)?"Edit":"Add"; ?> Employee</h2>
        </div>
        <form action="<?php echo isset($employee)?"/put-employee":"/store-employee"?>" method="post" class="grid">
            <?php if(isset($employee)): ?>
                <input type="hidden" name="__method" value="put">
                <input type="hidden" name="employee_id" value="<?php echo $employee['employee_id']?>">
            <?php endif;?>
            <div class="form_title">Personal Information</div>
            <div class="form_group">
                <label for="name">Employee Name</label>
                <input type="text" name="name" placeholder="Enter Name" <?php echo isset($employee['employee_name'])?"value  ='{$employee['employee_name']}'":""; ?>>
            </div>
            <div class="form_group">
                <label for="Category">Employee Category</label>
                <select name="category" id="Category">
                    <option value="">--select category--</option>
                    <?php if(isset($categories)): ?>
                        <?php foreach($categories as $category):?>
                            <?php extract($category)?>
                            <option value="<?php echo $employee_category_id ?>" <?php echo (isset($employee['employee_category'])    &&  $employee_category_id   ==  $employee['employee_category'])?"selected": "";?>><?php echo $employee_category_name?></option>
                        <?php endforeach?>
                    <?php endif?>
                </select>
            </div>
            <div class="form_group">
                <label for="cell1">Mobile Number</label>
                <input type="text" name="cell1" id="cell1" placeholder="Enter Mobile Number" <?php echo isset($employee['employee_cell_primary'])?"value='{$employee['employee_cell_primary']}'":"";?>>
            </div>
            <div class="form_group">
                <label for="cell2">Mobile Number</label>
                <input type="text" name="cell2" id="cell2" placeholder="Enter Secondary Mobile Number" <?php echo isset($employee['employee_cell_secondary'])?"value='{$employee['employee_cell_secondary']}'":"";?>>
            </div>
            <div class="form_group">
                <label for="city">Employee City</label>
                <select name="city" id="city">
                    <option value="">--select city--</option>
                    <?php if(isset($cities)): ?>
                        <?php foreach($cities as $city):?>
                            <?php extract($city)?>
                            <option value="<?php echo $city_id ?>" <?php echo (isset($employee['employee_city']) && $city_id    ==  $employee['employee_city'])?"Selected":"";?>><?php echo $city_name?></option>
                        <?php endforeach?>
                    <?php endif?>
                </select>
            </div>
            <div class="form_group">
                <label for="about">About Employee</label>
                <input type="text" name="about" id="about" placeholder="Enter About Employee" <?php echo isset($employee['employee_about'])?"value='{$employee['employee_about']}'":"";?>>
            </div>
            <div class="form_title">Banking Information</div>
            <div class="form_group">
                <label for="bank">Bank Name</label>
                <select name="bank" id="bank">
                    <option value="">--select bank--</option>
                    <?php if(isset($banks)): ?>
                        <?php foreach($banks as $bank):?>
                            <?php 
                            extract($bank);
                            $bank_name  =   str_replace('(','',$bank_name);
                            $bank_name  =   str_replace(')',' -',$bank_name);
                            ?>
                            <option value="<?php echo $bank_id ?>" <?php echo (isset($employee['bank_id']) && $bank_id    ==  $employee['bank_id'])?"Selected":"";?>><?php echo $bank_name?></option>
                        <?php endforeach?>
                    <?php endif?>
                </select>
            </div>
            <div class="form_group">
                <label for="account_title">Account Title</label>
                <input type="text" name="account_title" id="account_title" placeholder="Enter Account Title" <?php echo isset($employee['bank_account_title'])?"value='{$employee['bank_account_title']}'":"";?>>
            </div>
            <div class="form_group">
                <label for="account_number">Account Number</label>
                <input type="text" name="account_number" id="account_number" placeholder="Enter Account Number" <?php echo isset($employee['bank_account_number'])?"value='{$employee['bank_account_number']}'":"";?>>
            </div>
            <div class="form_group">
                <button type="submit" name="submit"><?php echo isset($employee)?"Edit":"Add";?> Employee</button>
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