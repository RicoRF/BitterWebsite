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
	
	include_once("user.php");
	
	$newUser = new User(0, $fName, $lName, $screenName, $password, $street, $province, $postalCode, $phone, $email, $url, $description, $location, null, null);
	
	$add = $newUser->AddUser($con);

	if($add != false){
		
		header('location: login.php?message=User created succesfully. User ID: '.$add);
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