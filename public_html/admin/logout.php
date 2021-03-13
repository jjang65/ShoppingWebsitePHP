<?php

require_once("../../resources/config.php");
session_destroy();

session_start();
set_message("Successfully logged out");

header("Location: ../../public_html");

 ?>