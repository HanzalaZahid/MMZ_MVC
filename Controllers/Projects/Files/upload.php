<?php
$uploadPath = getUploadPath().'Projects'. DIRECTORY_SEPARATOR;
if (!file_exists($uploadPath)){
    mkdir($uploadPath);
}
$dir = $_POST['dir'];
$uploadedFileType = $_POST['file_type'];

// Directories for different file types
$fileTypeDirectories = [
    'estimate' => 'Estimate',
    'layout' => 'Layout',
    'sow' => 'SOW',
    'invoice' => 'Invoice',
    'bill' => 'Bill',
    'image' => 'Image',
];
$fileTypeAllowed = [
    'estimate' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
    'layout' => 'application/pdf',
    'sow' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
    'invoice' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
    'bill' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
    'image' => 'image/jpeg',
];

// Check if project directory exists, create it if it doesn't
if (!file_exists($uploadPath . $dir)) {
    mkdir($uploadPath . $dir);
}

// Check if directory for this file type exists, create it if it doesn't
if (!array_key_exists($uploadedFileType, $fileTypeDirectories)) {
    $error = ['error' => ['File type does not match']];
    echo json_encode($error);
    return;
}

$fileTypeDirectory = $fileTypeDirectories[$uploadedFileType];
if (!file_exists($uploadPath . $dir . DIRECTORY_SEPARATOR . $fileTypeDirectory)) {
    mkdir($uploadPath . $dir . DIRECTORY_SEPARATOR . $fileTypeDirectory);
}

// Upload files
$errors = [];
$files = $_FILES['file'];
foreach ($files['tmp_name'] as $index => $tmpName) {
    $fileName = $files['name'][$index];
    $fileType = $files['type'][$index];
    $fileSize = $files['size'][$index];
    $fileError = $files['error'][$index];
    
    // FILE VALIDATION
    if ($fileType   !== $fileTypeAllowed[$uploadedFileType]) {
        $errors[] = 'Invalid file type for ' . $fileName;
        continue;
    }
    
    if ($fileError !== UPLOAD_ERR_OK) {
        $errors[] = 'Error uploading ' . $fileName;
        continue;
    }

    $destination = $uploadPath . $dir . DIRECTORY_SEPARATOR . $fileTypeDirectory . DIRECTORY_SEPARATOR . $fileName;
    if(empty($errors)){
        if (!move_uploaded_file($tmpName, $destination)) {
            $errors[] = 'Error moving ' . $fileName;
        }
    }
}

if (!empty($errors)) {
    $response = ['errors' => $errors];
    echo json_encode($response);
} else {
    echo json_encode(['success' => true]);
}
