<?php 
require_once("../../resources/config.php");

if(isset($_GET['delete_user_id'])){
	$id = filter_input(INPUT_GET, 'delete_user_id', FILTER_SANITIZE_NUMBER_INT);
	$query = "DELETE FROM users WHERE id = :id";
	$statement = $db->prepare($query);
	$statement->bindValue(':id', $id, PDO::PARAM_INT);
	$statement->execute();

	set_message("User Deleted");
	redirect("index.php?users");
}else{
	set_message("Failed to delete");
	redirect("index.php?users");
}


 ?>