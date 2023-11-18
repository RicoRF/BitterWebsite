<?php 
//insert the user's data into the users table of the DB
//if everything is successful, redirect them to the login page.
//if there is an error, redirect back to the signup page with a friendly message

include_once('connect.php');

if(isset($_POST["button"])){
	
	$fName = $_POST["firstname"];
	$lName = $_POST["lastname"];
	$email = $_POST["email"];
	$screenName = $_POST["username"];
	$password = $_POST["password"];
	$confirmPassword = $_POST["confirm"];
	$phone = $_POST["phone"];
	$street = $_POST["address"];
	$province = $_POST["province"];
	$postalCode = $_POST["postalCode"];
	$url = $_POST["url"];
	$description = $_POST["desc"];
	$location = $_POST["location"];
	
	$query = "INSERT INTO `users`(`first_name`,
	`last_name`, `screen_name`, `password`, `address`, `province`, `postal_code`, `contact_number`, `email`, `url`, `description`,
	`location`)
	VALUES ('".$fName."',
	'".$lName."',
	'".$screenName."',
	'".$password."',
	'".$street."',
	'".$province."',
	'".$postalCode."',
	'".$phone."',
	'".$email."',
	'".$url."',
	'".$description."',
	'".$location."');
";

	if(mysqli_query($con, $query)){
		
		header('location: login.php?message=User created succesfully.');
		exit;
		
	}
	
	else {
		
		$msg = "Error during registration process. Please contact administrator.";
		
	}
	
}

else {
	
	$msg = "Form was not submitted.";
	
}

header('location: signup.php?message='.$msg.'');

?>