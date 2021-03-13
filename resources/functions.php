<?php

require_once("connect.php");

function debug_to_console( $data ) {
    $output = $data;
    if ( is_array( $output ) )
        $output = implode( ',', $output);

    echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
}

function redirect($location){
	header("Location: $location ");
}

function redirect_prior_page($prior_webpage_name){
	redirect("../../../public_html/{$prior_webpage_name}");
}

function set_message($msg){
	if (!empty($msg)){
		$_SESSION['message'] = $msg;
	} else {
		$msg = "";
	}
}

function display_message(){
	if(isset($_SESSION['message'])){
		echo $_SESSION['message'];
		unset($_SESSION['message']);
	}
}

function toast_message() {
	if(isset($_SESSION['message'])) {
        echo '<script type="text/javascript">', 'let message =', json_encode($_SESSION['message']), ';', '</script>';
        echo '<script type="text/javascript">', 'toastr.options.closeButton = true;', 'toastr.info(message);', '</script>';
        unset($_SESSION['message']);
    }
}

function file_upload_path($original_filename, $upload_subfolder_name = '../../public_html/resources/uploads') {
	$path_segments = [$upload_subfolder_name, basename($original_filename)];
	return join(DIRECTORY_SEPARATOR, $path_segments);
}

function file_is_an_image($temporary_path, $new_path) {
	$allowed_mime_types = ['image/gif', 'image/jpeg', 'image/png'];
	$allowed_file_extensions = ['gif', 'jpg', 'jpeg', 'png'];
	$actual_file_extension = pathinfo($new_path, PATHINFO_EXTENSION);
	$actual_mime_type = getimagesize($temporary_path)['mime'];
	$file_extension_is_valid = in_array($actual_file_extension, $allowed_file_extensions);
	$mime_type_is_valid = in_array($actual_mime_type, $allowed_mime_types);
	return $file_extension_is_valid && $mime_type_is_valid;
}

function sanitize_email() {
	return filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}

function valid_email() {
	return filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
}

function sanitize_password() {
	return filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}

function valid_password() {
	$password_length = strlen(sanitize_password());
	return $password_length >= 8;
}

function is_admin($db, $email) {
	$query = "SELECT * FROM users WHERE role='admin'";
	$statement = $db->prepare($query);
	$statement->execute();
	$admins = $statement->fetchAll();
	foreach ($admins as $admin) {
		if ($admin['email'] = $email) {
			return true;
		}
	}
	return false;
}

?>