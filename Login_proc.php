<?php 
//verify the user's login credentials. if they are valid redirect them to index.php/
//if they are invalid send them back to login.php

include_once("connect.php");

include_once("user.php");

session_start();

if(isset($_POST["button"])){
	
	$username = mysqli_real_escape_string($con, $_POST["username"]);
	$password = mysqli_real_escape_string($con, $_POST["password"]);
	
	$sql = "SELECT user_id, password FROM users WHERE screen_name = '".$username."'";
	
	$execute = mysqli_query($con, $sql);
	
	if(mysqli_affected_rows($con) > 0){
		
		$info = mysqli_fetch_assoc($execute);
		
		if(password_verify($password, $info["password"])){
		
		$currentUser = new User(null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
		
		$_SESSION["SESS_MEMBER_ID"] = $info["user_id"];
		
		$currentUser->Populate($info["user_id"], $con);
		
		$_SESSION["SESS_FIRST_NAME"] = $currentUser->first_name;
		$_SESSION["SESS_LAST_NAME"] = $currentUser->last_name;
		
		header('location: index.php');
		
		}
		
		else {
			header('location: login.php?message=Password does not match, please try again.');
		}
		
	}
	
	else {
		
		header('location: login.php?message=Credentials are invalid, please try again.');
		
	}
	
}


?>