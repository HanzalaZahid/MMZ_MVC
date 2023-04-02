<?php 
use core\Router;
use core\Database;
$config =   require("../config.php");
$uri    =   parse_url($_SERVER['REQUEST_URI'])['path'];
$method =   isset($_POST['__method'])?$_POST['__method']:$_SERVER['REQUEST_METHOD'];
require ('../core/helpers.php');
core("Database");
core('router');
$router =   new Router();
require("../routes.php");
$router->route($uri,$method);
?>