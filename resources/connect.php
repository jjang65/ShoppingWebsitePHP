<?php 

define('DB_DSN','mysql:host=localhost;dbname=ecom');
define('DB_USER','serveruser2');
define('DB_PASS','gorgonzola7!');

try {
	$db = new PDO(DB_DSN, DB_USER, DB_PASS);	
} catch(PDOException $e) {
	print "Error: " . $e->getMessage();
	die();
}

 ?>