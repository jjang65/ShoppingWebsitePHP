<?php 

require_once("../../resources/config.php");

session_start();
session_destroy();

session_start();
set_message("Successfully logged out");

header("Location: ../../public_html");

 ?>