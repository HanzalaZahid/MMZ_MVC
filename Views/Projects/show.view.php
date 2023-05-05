<?php 
view("partials","head", $head);
view("partials","header");
?>
<body>
    <?php extract($project)?>
    <div class="main_content">
    <div class="model-dialogue delete-project-files">
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
        <?php endif; ?>`
            
        </div>
        <div class="project_files">
            <div class="wrapper">
                <div class="files">
                    <div class="title">Estimates</div>
                    <div class="list">
                        <ul>
                            <li>
                                <a href="">File Name</a>
                                <div class="options">
                                    <button class="delete"><i class="fa-solid fa-xmark"></i></button>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="uploader">
                        <form action="upload-projects-files" method="post" enctype= "multipart/form-data">
                            <input type="hidden" name="__method" value="patch">
                            <input type="hidden" name="dir" value="<?php echo $project_name?>">
                            <input type="hidden" name="file_type" value="estimate">
                            <input type="file" name="file[]" id="estimate" multiple>
                            <label for="estimate">Drag file(s) here or Click here to choose file(s)</label>
                            <button type="submit">Upload</button>
                        </form>
                        <div class="info"></div>
                        <div class="success">Success</div>
                        <div class="error">Error</div>
                    </div>
                </div>
                <div class="files">
                    <div class="title">Layouts</div>
                    <div class="list">
                        <ul>
                            <li>
                                <a href="">File Name</a>
                                <div class="options">
                                    <button class="delete"><i class="fa-solid fa-xmark"></i></button>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="uploader">
                        <form action="upload-projects-files" method="post" enctype= "multipart/form-data">
                            <input type="hidden" name="__method" value="patch">
                            <input type="hidden" name="dir" value="<?php echo $project_name?>">
                            <input type="hidden" name="file_type" value="layout">
                            <input type="file" name="file[]" id="layout" multiple>
                            <label for="layout">Drag file(s) here or Click here to choose file(s)</label>
                            <button type="submit">Upload</button>
                        </form>
                        <div class="info"></div>
                        <div class="success">Success</div>
                        <div class="error">Error</div>
                    </div>
                </div>
                <div class="files">
                    <div class="title">Statement of Work</div>
                    <div class="list">
                        <ul>
                            <li>
                                <a href="">File Name</a>
                                <div class="options">
                                    <button class="delete"><i class="fa-solid fa-xmark"></i></button>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="uploader">
                        <form action="upload-projects-files" method="post" enctype= "multipart/form-data">
                            <input type="hidden" name="__method" value="patch">
                            <input type="hidden" name="dir" value="<?php echo $project_name?>">
                            <input type="hidden" name="file_type" value="sow">
                            <input type="file" name="file[]" id="sow" multiple>
                            <label for="layout">Drag file(s) here or Click here to choose file(s)</label>
                            <button type="submit">Upload</button>
                        </form>
                        <div class="info"></div>
                        <div class="success">Success</div>
                        <div class="error">Error</div>
                    </div>
                </div>
                <div class="files">
                    <div class="title">Invoices</div>
                    <div class="list">
                        <ul>
                            <li>
                                <a href="">File Name</a>
                                <div class="options">
                                    <button class="delete"><i class="fa-solid fa-xmark"></i></button>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="uploader">
                        <form action="upload-projects-files" method="post" enctype= "multipart/form-data">
                            <input type="hidden" name="__method" value="patch">
                            <input type="hidden" name="dir" value="<?php echo $project_name?>">
                            <input type="hidden" name="file_type" value="invoice">
                            <input type="file" name="file[]" id="invoice" multiple>
                            <label for="layout">Drag file(s) here or Click here to choose file(s)</label>
                            <button type="submit">Upload</button>
                        </form>
                        <div class="info"></div>
                        <div class="success">Success</div>
                        <div class="error">Error</div>
                    </div>
                </div>
                <div class="files">
                    <div class="title">Bills</div>
                    <div class="list">
                        <ul>
                            <li>
                                <a href="">File Name</a>
                                <div class="options">
                                    <button class="delete"><i class="fa-solid fa-xmark"></i></button>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="uploader">
                        <form action="upload-projects-files" method="post" enctype= "multipart/form-data">
                            <input type="hidden" name="__method" value="patch">
                            <input type="hidden" name="dir" value="<?php echo $project_name?>">
                            <input type="hidden" name="file_type" value="bill">
                            <input type="file" name="file[]" id="bill" multiple>
                            <label for="layout">Drag file(s) here or Click here to choose file(s)</label>
                            <button type="submit">Upload</button>
                        </form>
                        <div class="info"></div>
                        <div class="success">Success</div>
                        <div class="error">Error</div>
                    </div>
                </div>
                <div class="files">
                    <div class="title">Images</div>
                    <div class="list">
                        <ul>
                            <li>
                                <a href="">File Name</a>
                                <div class="options">
                                    <button class="delete"><i class="fa-solid fa-xmark"></i></button>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="uploader">
                        <form action="upload-projects-files" method="post" enctype= "multipart/form-data">
                            <input type="hidden" name="__method" value="patch">
                            <input type="hidden" name="dir" value="<?php echo $project_name?>">
                            <input type="hidden" name="file_type" value="image">
                            <input type="file" name="file[]" id="image" multiple>
                            <label for="image">Drag file(s) here or Click here to choose file(s)</label>
                            <button type="submit">Upload</button>
                        </form>
                        <div class="info"></div>
                        <div class="success">Success</div>
                        <div class="error">Error</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="phpErrors">
            
        </div>
    </div>
</body>
</html>