<?php 
$filePath   =   $_POST['filePath'];
$parsedPath =   str_replace('assets/uploads/', '', $filePath);
$uploadFolder   =   getUploadPath(). 'Projects'. DIRECTORY_SEPARATOR;
$finalPath  =   $uploadFolder.$parsedPath;
if(unlink($finalPath)){
    echo true;
}else{
    echo false;
}
?>