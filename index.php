<?php
 
 ini_set('display_errors', 1);
 ini_set('display_startup_errors', 1);
 error_reporting(E_ALL);

require('config.php');
require('classes/Bootstrap.php');
require('classes/Controller.php');
require('classes/Model.php');


//all controllers
require('controllers/home.php');
require('controllers/shares.php');
require('controllers/users.php');

//all models
require('models/home.php');
require('models/share.php');
require('models/user.php');


print_r($_GET);

$bootstrap = new Bootstrap($_GET);
$controller = $bootstrap->createController();
if($controller){
    $controller->executeAction();
}