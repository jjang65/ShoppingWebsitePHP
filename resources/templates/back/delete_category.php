<?php 
require_once("../../resources/config.php"); 

if(isset($_GET['delete_category_id'])){

	$id = filter_input(INPUT_GET, 'delete_category_id', FILTER_SANITIZE_NUMBER_INT);
	$query = "DELETE FROM categories WHERE id = :id";
	$statement = $db->prepare($query);
	$statement->bindValue(':id', $id, PDO::PARAM_INT);
	$statement->execute();

	set_message("Category Deleted.");
	redirect("index.php?categories");

}else{

	redirect("index.php?categories");

}

 ?>