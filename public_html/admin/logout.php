<?php 

session_start();
session_destroy();

session_start();
$_SESSION['messsage'] = 'Successfully logged out';

header("Location: ../../public_html");

 ?>