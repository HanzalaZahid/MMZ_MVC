<?php 
function controller($dir, $controller){
    global $config, $page_title, $errors;
    require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . "Controllers"    .   DIRECTORY_SEPARATOR .   $dir    .   DIRECTORY_SEPARATOR .   $controller .   ".php";
}
function view($dir, $view, $args =   []){
    extract($args);
    global $config, $page_title, $args;
    require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . "Views"    .   DIRECTORY_SEPARATOR .   $dir    .   DIRECTORY_SEPARATOR .   $view   .   ".view.php";
}
function base_location($file){
    require __DIR__    .    DIRECTORY_SEPARATOR .   ".."    .   DIRECTORY_SEPARATOR   .   $file;
}
function models($file){
    require __DIR__    .    DIRECTORY_SEPARATOR .   ".."    .   DIRECTORY_SEPARATOR   .   "Models"   .   DIRECTORY_SEPARATOR .   $file   .   ".php";
}
function core($file){
    require(__DIR__    .   DIRECTORY_SEPARATOR   .   $file  .   ".php");
}
function abort($message =   "",$error_code  =   404){
    http_response_code($error_code);
    $args['message']    =   $message;
    view("Errors", $error_code, $args);
    die();
}
spl_autoload_register(function($class) {
    base_location(str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php');
});
?>
