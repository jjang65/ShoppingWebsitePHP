<?php 

require_once("../../config.php");

if(isset($_POST['email'])){

	$email = null;

	if(sanitize_email() == valid_email()) {
		$email = sanitize_email();
	} else {
		set_message("Please input valid email.");
		header('Location: ../../../public_html/about.php');
		exit();
	}

	$queryForDuplicate = "SELECT * FROM subscriptions WHERE email = :email";
	$statementForDuplicate = $db->prepare($queryForDuplicate);
	$statementForDuplicate->bindValue(':email', $email);
	$statementForDuplicate->execute();
	$row = $statementForDuplicate->fetch();

	if($row) {
		set_message("Faile to subscribe. <br> This email has been already registered.");
		header('Location: ../../../public_html/about.php');
	} else {
		$query = "INSERT INTO subscriptions (email) VALUES (:email)";
		$statement = $db->prepare($query);
		$statement->bindValue(':email', $email);
		$statement->execute();

		set_message("Thank you for your subscription");
		header('Location: ../../../public_html/about.php');
	}
} else {
	set_message("Failed to subscribe...");
	header('Location: ../../../public_html/about.php');
}

 ?>