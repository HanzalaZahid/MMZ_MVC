<?php 
try {
    $uploadPath = getUploadPath() . 'Projects' . DIRECTORY_SEPARATOR;
    $parentFolder = isset($_POST['parent_folder']) ? $_POST['parent_folder'] : null;
    $dir = isset($_POST['dir']) ? ucfirst($_POST['dir']) : null;

    if (!$parentFolder || !$dir) {
        throw new Exception('Missing required parameter(s)');
    }

    $path = $uploadPath . $parentFolder . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR;

    if (!is_dir($path)) {
        throw new Exception('Directory not found');
    }

    $files = array_slice(scandir($path), 2);

    echo json_encode($files);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
