<?php 

require_once("../../resources/config.php");

if(isset($_GET['delete_report_id'])){
	$order_id = filter_input(INPUT_GET, 'order_id', FILTER_SANITIZE_NUMBER_INT);
	$id = filter_input(INPUT_GET, 'delete_report_id', FILTER_SANITIZE_NUMBER_INT);
	$query = "DELETE FROM reports WHERE id = :id";
	$statement = $db->prepare($query);
	$statement->bindValue(':id', $id, PDO::PARAM_INT);
	$statement->execute();

	set_message("Report Deleted");
	redirect("index.php?reports&id=$order_id");
}else{
	set_message("Failed to delete");
	redirect("index.php?reports&id=$order_id");
}


 ?>