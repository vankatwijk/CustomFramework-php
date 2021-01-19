<?php

require('config.php');
require('classes/Bootstrap.php');

print_r($_GET);

$bootstrap = new Bootstrap($_GET);
