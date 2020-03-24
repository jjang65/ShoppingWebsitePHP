<?php 
require_once("../../resources/config.php"); 

if(isset($_GET['delete_subscription_id'])){

	$id = filter_input(INPUT_GET, 'delete_subscription_id', FILTER_SANITIZE_NUMBER_INT);
	$query = "DELETE FROM subscriptions WHERE id = :id";
	$statement = $db->prepare($query);
	$statement->bindValue(':id', $id, PDO::PARAM_INT);
	$statement->execute();

	set_message("Subscription Deleted.");
	redirect("index.php?subscriptions");

}else{

	redirect("index.php?subscriptions");

}

 ?>