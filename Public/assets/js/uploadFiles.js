
// let phpErrors = $('.phpErrors');
let forms = $('.project_files form');
// UPLOADING FILES
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
    var successDiv  =   $(element).siblings('.success');
    var errorDiv  =   $(element).siblings('.error');
    parsedResponse =   JSON.parse(response);
    if(parsedResponse['success']   !== undefined){
        successDiv.show();
        errorDiv.hide();
    }
    if(parsedResponse['errors']   !== undefined){
        successDiv.hide();
        errorDiv.text(parsedResponse['errors'])
        errorDiv.show();
    }
    // GETTING FILES NAMES
    let parentFolder    =   $(element).find('input[name="dir"]').val();
    let dir    =   $(element).find('input[name="file_type"]').val();
    console.log(parentFolder);
    console.log(dir);
    var filesToDisplay  =   getProjectFiles(parentFolder, dir, element);
}
function getProjectFiles(parentFolder, dir, element){
    $.ajax(
        {
            type: 'POST',
            url: '/get-project-files',
            data: {
                parent_folder: parentFolder,
                dir: dir
            },
            success: function(response){
                handleResponse(response, element);
            }
        }
    );
}
function handleResponse(response, element){
    let target    =   $(element).parent('.uploader').siblings('.list').children('ul');
    target.empty();
    let thumbnails  =   $(element).siblings('.info');
    thumbnails.empty();
    let data      =   JSON.parse(response);
    let parentFolder    =   $(element).find('input[name="dir"]').val();
    let dir    =   $(element).find('input[name="file_type"]').val();
    // assuming data is an array of file names
    data.forEach(function(fileName) {
        const li = $('<li>');
        const a = $('<a>', {
        href: 'assets/uploads/' + parentFolder + '/' + dir + '/' + fileName,
        download: fileName
        }).text(fileName); // add the file name as the link text
        li.append(a);
        const button    =   $('<button>',{
            value   :   'assets/uploads/' + parentFolder + '/' + dir + '/' + fileName,
            class   :   'delete_file',
        }).html('<i class="fa-solid fa-xmark"></i>')
        li.append(button);
        target.append(li);
    });
    
}
// GENERATING THUMBNAILS
const fileIcons = {
'pdf': 'fa-file-pdf',
'doc': 'fa-file-word',
'docx': 'fa-file-word',
'xls': 'fa-file-excel',
'xlsx': 'fa-file-excel',
'ppt': 'fa-file-powerpoint',
'pptx': 'fa-file-powerpoint',
'txt': 'fa-file-alt',
'zip': 'fa-file-archive',
'rar': 'fa-file-archive',
'7z': 'fa-file-archive'
};

const getIconClass = (filename) => {
    const extension = filename.split('.').pop().toLowerCase();
    return fileIcons[extension] || 'fa-file';
};

const fileInputs = $('.project_files input[type=file]');
fileInputs.each(function() {
    $(this).on('change', function(event) {
        const infoDiv = $(this).parent('form').siblings('.info');
        infoDiv.empty();

        // Getting file names
        const fileNames = [...event.target.files].map(file => file.name).join(', ');

        // Generating thumbnails for files
        [...event.target.files].forEach(file => {
            const iconClass = getIconClass(file.name);
            const icon = $('<i>', {
                class: `fas ${iconClass}`
            });
            // const filename = $('<div>', {
            //     class: 'filename',
            //     text: file.name
            // });
            const thumb = $('<div>',{
                class: 'thumbnail'
            });
            const thumbWrapper  = $('<div>',{
                class: 'wrapper'
            });
            thumbWrapper.append(icon);
            thumb.append(thumbWrapper);
            // CREATING DOWNLOAD LINKS
            const fileUrl = URL.createObjectURL(file);
            const link = $('<a>', {
                href: fileUrl,
                download: file.name
            }).text(file.name);
            const dl = $('<div>',{
                class: 'download'
            })
            dl.append(link);
            thumb.append(dl);
            infoDiv.append(thumb);
        });
    });
});
forms.each(function() {
    const parent = $(this).find('input[name="dir"]').val();
    const dir = $(this).find('input[name="file_type"]').val();
    getProjectFiles(parent, dir, $(this));
  });
  

//   DELETEING FILE
$(document).on('click', '.files .delete_file', function(event) {
    event.preventDefault();
    let fileToDelete = $(this).val();
    let form        =   $(this).parent().parent().parent().siblings('.uploader').find('form');
    let parentFolder    =   form.find('input[name="dir"]').val();
    let dir    =   form.find('input[name="file_type"]').val();
    if(confirm('Delete '+fileToDelete.split('/').pop()+'?')){
        $.ajax({
        type: 'POST',
        data:   {'filePath': fileToDelete},
        url: 'delete-project-file',
        success: function(response){
            if(response){
                getProjectFiles(parentFolder, dir, form);
            }
        }
    });
    }
})

// $(document).on('click', '.files .delete_file', function(event) {
//     event.preventDefault();
//     let fileToDelete = $(this).val();
//     let form        =   $(this).parent().parent().parent().siblings('.uploader').find('form');
//     let parentFolder    =   form.find('input[name="dir"]').val();
//     let dir    =   form.find('input[name="file_type"]').val();
    
//     if (confirm("Are you sure you want to delete this file?")) {
//         $.ajax({
//             type: 'POST',
//             data:   {'filePath': fileToDelete},
//             url: 'delete-project-file',
//             success: function(response){
//                 console.log(response)
//                 if(response){
//                     getProjectFiles(parentFolder, dir, form);
//                 }
//             }
//         });
//     }
// })