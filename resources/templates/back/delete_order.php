<?php
require_once("../../resources/config.php");

if(isset($_SESSION['admin']) && isset($_GET['delete_order_id'])){
	$id = filter_input(INPUT_GET, 'delete_order_id', FILTER_SANITIZE_NUMBER_INT);
	$query = "DELETE FROM orders WHERE id = :id";
	$statement = $db->prepare($query);
	$statement->bindValue(':id', $id, PDO::PARAM_INT);
	$statement->execute();

	set_message("Order Deleted");
	redirect("index.php?orders");
}else{
	set_message("Failed to delete");
	redirect("index.php?orders");
}


 ?>