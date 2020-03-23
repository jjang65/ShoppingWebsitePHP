<?php 

require_once("../../resources/config.php");

if(isset($_GET['delete_product_id'])){
	$id = filter_input(INPUT_GET, 'delete_product_id', FILTER_SANITIZE_NUMBER_INT);
	$query = "DELETE FROM products WHERE id = :id";
	$statement = $db->prepare($query);
	$statement->bindValue(':id', $id, PDO::PARAM_INT);
	$statement->execute();

	set_message("Product Deleted");
	redirect("index.php?products");
}else{
	set_message("Failed to delete");
	redirect("index.php?products");
}



 ?>