<?php 
//insert the user's data into the users table of the DB
//if everything is successful, redirect them to the login page.
//if there is an error, redirect back to the signup page with a friendly message

include_once('connect.php');

if(isset($_POST["button"])){
	
	$fName = mysqli_real_escape_string($con, $_POST["firstname"]);
	$lName = mysqli_real_escape_string($con, $_POST["lastname"]);
	$email = mysqli_real_escape_string($con, $_POST["email"]);
	$screenName = mysqli_real_escape_string($con, $_POST["username"]);
	$password = mysqli_real_escape_string($con, $_POST["password"]);
	$confirmPassword = mysqli_real_escape_string($con, $_POST["confirm"]);
	$phone = mysqli_real_escape_string($con, $_POST["phone"]);
	$street = mysqli_real_escape_string($con, $_POST["address"]);
	$province = mysqli_real_escape_string($con, $_POST["province"]);
	$postalCode = mysqli_real_escape_string($con, $_POST["postalCode"]);
	$url = mysqli_real_escape_string($con, $_POST["url"]);
	$description = mysqli_real_escape_string($con, $_POST["desc"]);
	$location = mysqli_real_escape_string($con, $_POST["location"]);
	
	$query = "INSERT INTO `users`(`first_name`,
	`last_name`, `screen_name`, `password`, `address`, `province`, `postal_code`, `contact_number`, `email`, `url`, `description`,
	`location`)
	VALUES ('".$fName."',
	'".$lName."',
	'".$screenName."',
	'".password_hash($password, PASSWORD_DEFAULT)."',
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