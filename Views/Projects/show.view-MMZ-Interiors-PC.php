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
                            <label for="layout">Drag file(s) here or Click here to choose file(s)</label>
                            <button type="submit">Upload</button>
                        </form>
                        <div class="success">Success</div>
                        <div class="error">Error</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="phpErrors"></div>
    </div>
    <script>
    let phpErrors = $('.phpErrors');
    let forms = $('.project_files form');
    forms.each(function (index, element) {
        $(element).submit(function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            resetIndecators(element);
            $.ajax({
                type: 'POST',
                url: '/upload-projects-files',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    setProjectFiles(response, element);
                },
                error: function (xhr, status, error) {
                    console.log("ERROR");
                    var error_message = xhr.responseText;
                    alert('Error: ' + error_message);
                }
            });
            return false;
        });
    })
    function resetIndecators(element){
        var successDiv  =   $(element).siblings('.success');
        var errorDiv  =   $(element).siblings('.error');
        successDiv.hide();
        errorDiv.hide();
    }
    function setProjectFiles(response, element) {
        console.log(JSON.parse(response));
        phpErrors.html(response);
        var successDiv  =   $(element).siblings('.success');
        var errorDiv  =   $(element).siblings('.error');
        parsedResponse =   JSON.parse(response);
        if(parsedResponse['success']   !== undefined){
            successDiv.show();
            errorDiv.hide();
        }
        if(parsedResponse['errors']   !== undefined){
            successDiv.hide();
            errorDiv.text(parsedResponse['errors']);
            errorDiv.show();
        }
    }
</script>

</body>
</html>