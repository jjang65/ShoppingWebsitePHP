<?php 

require_once("../../config.php");

if($_POST['submit']) {

	$email = null;

	if(sanitize_email() == valid_email()) {
		$email = sanitize_email();
	}

	$password = null;

	if(valid_password()) {
		$password = sanitize_password();
	}

	$queryForDuplicate = "SELECT email FROM users WHERE email = :email";
	$statementForDuplicate = $db->prepare($queryForDuplicate);
	$statementForDuplicate->bindValue(':email', $email);
	$statementForDuplicate->execute();
	$row = $statementForDuplicate->fetch();

	if($row) {
		set_message("Registration failed. <br> This email has been already registered.");
		header('Location: ../../../public_html/register.php');
	} else {
		$query = "INSERT INTO users (email, password) VALUES (:email, :password)";
		$statement = $db->prepare($query);
		$statement->bindValue(':email', $email);
		$statement->bindValue(':password', $password);
		$statement->execute();

		set_message("Registration succeeded, please login");
		header('Location: ../../../public_html/register.php');
	}
} else {
	set_message("Failed to register...");
	header('Location: ../../../public_html/register.php');
}



 ?>