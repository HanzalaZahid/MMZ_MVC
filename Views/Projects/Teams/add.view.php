<?php 
view("partials","head");
view("partials","header");
?>
<body>
    <div class="main_content">
        <div class="content_head">
            <h2 class="title">Add Team</h2>
        </div>
        <form action="store-project-team" method="post" class="grid add-team-member">
            <input type="hidden" name="project_id" value="<?php echo $project_id ?>">
            
            <?php if (isset($team) && !empty($team)):?>
                <?php foreach($team as $member):?>
                    <div class="form_group">
                        <label for="employee">Employee Name</label>
                        <select name="employee[]" id="employee">
                            <option value="">--select employee--</option>
                            <?php if(!empty($employees)):?>
                                <?php foreach($employees as $employee): ?>
                                    <?php extract($employee); ?>
                                    <option value="<?php echo $employee_id; ?>" <?php echo ($employee_id ==  $member['employee_id'])?'Selected':"";?>>
                                    <?php echo $employee_name . " - ". $employee_category_name; ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                <?php endforeach;?>
            <?php else: ?>
                <div class="form_group">
                    <label for="employee">Employee Name</label>
                    <select name="employee[]" id="employee">
                        <option value="">--select employee--</option>
                        <?php if(!empty($employees)):?>
                        <?php foreach($employees as $employee): ?>
                            <?php extract($employee); ?>
                            <option value="<?php echo $employee_id; ?>">
                            <?php echo $employee_name . " - ". $employee_category_name; ?></option>
                        <?php endforeach ?>
                        <?php endif ?>
                    </select>
                </div>
                <div class="form_group">
                    <label for="employee">Employee Name</label>
                    <select name="employee[]" id="employee">
                        <option value="">--select employee--</option>
                        <?php if(!empty($employees)):?>
                        <?php foreach($employees as $employee): ?>
                            <?php extract($employee); ?>
                            <option value="<?php echo $employee_id; ?>">
                            <?php echo $employee_name . " - ". $employee_category_name; ?></option>
                        <?php endforeach ?>
                        <?php endif ?>
                    </select>
                </div>
                <div class="form_group">
                    <label for="employee">Employee Name</label>
                    <select name="employee[]" id="employee">
                        <option value="">--select employee--</option>
                        <?php if(!empty($employees)):?>
                        <?php foreach($employees as $employee): ?>
                            <?php extract($employee); ?>
                            <option value="<?php echo $employee_id; ?>">
                            <?php echo $employee_name . " - ". $employee_category_name; ?></option>
                        <?php endforeach ?>
                        <?php endif ?>
                    </select>
                </div>
                <div class="form_group">
                    <label for="employee">Employee Name</label>
                    <select name="employee[]" id="employee">
                        <option value="">--select employee--</option>
                        <?php if(!empty($employees)):?>
                        <?php foreach($employees as $employee): ?>
                            <?php extract($employee); ?>
                            <option value="<?php echo $employee_id; ?>">
                            <?php echo $employee_name . " - ". $employee_category_name; ?></option>
                        <?php endforeach ?>
                        <?php endif ?>
                    </select>
                </div>
                <div class="form_group">
                    <label for="employee">Employee Name</label>
                    <select name="employee[]" id="employee">
                        <option value="">--select employee--</option>
                        <?php if(!empty($employees)):?>
                        <?php foreach($employees as $employee): ?>
                            <?php extract($employee); ?>
                            <option value="<?php echo $employee_id; ?>">
                            <?php echo $employee_name . " - ". $employee_category_name; ?></option>
                        <?php endforeach ?>
                        <?php endif ?>
                    </select>
                </div>
                <div class="form_group">
                    <label for="employee">Employee Name</label>
                    <select name="employee[]" id="employee">
                        <option value="">--select employee--</option>
                        <?php if(!empty($employees)):?>
                        <?php foreach($employees as $employee): ?>
                            <?php extract($employee); ?>
                            <option value="<?php echo $employee_id; ?>">
                            <?php echo $employee_name . " - ". $employee_category_name; ?></option>
                        <?php endforeach ?>
                        <?php endif ?>
                    </select>
                </div>
            <?php endif; ?>
            <button class="team-member-generator generator_button" type="button"><i class="fa fa-plus" aria-hidden="true"></i></button>

            <div class="form_group">
                <button type="submit" name="submit">Add Team</button>
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