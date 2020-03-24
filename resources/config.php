<?php 

ob_start();

session_start();

//session_destroy();

$current_folder = __DIR__;

define("DS", DIRECTORY_SEPARATOR);

define("TEMPLATE_FRONT", __DIR__ . DS . "templates/front");

define("TEMPLATE_BACK", __DIR__ . DS . "templates/back");

define("RESOURCES", __DIR__ . DS);

define("VENDOR", __DIR__ . DS . ".." . DS . "vendor" . DS);

define("UPLOAD_DIRECTORY", "../resources/uploads");

require_once("functions.php");
require_once("connect.php");
require_once("email_config.php");
require_once(VENDOR . "autoload.php");

 ?>