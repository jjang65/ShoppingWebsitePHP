<?php

require_once("../../resources/config.php");

if(isset($_SESSION['admin']) && isset($_GET['page']) && isset($_GET['delete_image_id']) && isset($_GET['filename'])) {
	$page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	$id = filter_input(INPUT_GET, 'delete_image_id', FILTER_SANITIZE_NUMBER_INT);
	$filename = filter_input(INPUT_GET, 'filename', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

	if($page === 'products') {
		$query = "UPDATE products SET image = null WHERE id = :id";
		$statement = $db->prepare($query);
		$statement->bindValue(':id', $id, PDO::PARAM_INT);
		$statement->execute();

		delete_image_file($filename, $page);

	} else if($page === 'users') {
		$query = "UPDATE users SET photo = null WHERE id = :id";
		$statement = $db->prepare($query);
		$statement->bindValue(':id', $id, PDO::PARAM_INT);
		$statement->execute();

		delete_image_file($filename, $page);
	}

} else {
	set_message("Failed to deleted");
    redirect("index.php");
    exit();
}

function delete_image_file($filename, $page) {
	if(file_exists(UPLOAD_DIRECTORY . DS . $filename)) {

		// Delete a resized image
		unlink(UPLOAD_DIRECTORY . DS . $filename);

		// Delete an original image
		$extension = '_medium.ext';
		$original_image_name = str_replace($extension, '', $filename);

		if(file_exists(UPLOAD_DIRECTORY . DS . $original_image_name)) {
			unlink(UPLOAD_DIRECTORY . DS . $original_image_name);
		}

		set_message("Image Deleted");
		redirect("index.php?" . $page);
		exit();
	} else {
		set_message("Failed to delete the file");
		redirect("index.php?" . $page);
	}
}

?>
