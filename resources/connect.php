<?php

require_once(VENDOR . "autoload.php");
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

try {
	$db = new PDO($_ENV['DB_DSN'], $_ENV['DB_USER'], $_ENV['DB_PASS']);
} catch(PDOException $e) {
	print "Error: " . $e->getMessage();
	die();
}

?>
