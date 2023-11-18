<?php 
//verify the user's login credentials. if they are valid redirect them to index.php/
//if they are invalid send them back to login.php

include_once("connect.php");

session_start();

if(isset($_POST["button"])){
	
	$username = $_POST["username"];
	$password = $_POST["password"];
	
	$sql = "SELECT user_id, first_name, last_name FROM users WHERE screen_name = '".$username."' AND password = '".$password."'";
	
	$execute = mysqli_query($con, $sql);
	
	if(mysqli_affected_rows($con) > 0){
		
		$info = mysqli_fetch_assoc($execute);
		
		$_SESSION["SESS_MEMBER_ID"] = $info["user_id"];
		$_SESSION["SESS_FIRST_NAME"] = $info["first_name"];
		$_SESSION["SESS_LAST_NAME"] = $info["last_name"];
		
		header('location: index.php');
		
	}
	
	else {
		
		header('location: login.php?message=Credentials are invalid, please try again.');
		
	}
	
}


?>