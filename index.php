<?php

require('config.php');
require('classes/Bootstrap.php');
require('classes/Controller.php');


//all controllers
require('controllers/home.php');
require('controllers/shares.php');
require('controllers/users.php');



print_r($_GET);

$bootstrap = new Bootstrap($_GET);
$controller = $bootstrap->createController();
if($controller){
    $controller->executeAction();
}