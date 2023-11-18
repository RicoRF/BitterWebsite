<?php 
//insert a tweet into the database
session_start();
include_once('connect.php');

$msg = "";

if(isset($_POST["buttonTweet"]) && isset($_SESSION["SESS_MEMBER_ID"])){
	
	if($_POST["myTweet"] != ""){
		
		$sql = "INSERT INTO tweets (user_id, tweet_text) VALUES(".$_SESSION["SESS_MEMBER_ID"].", '".htmlspecialchars($_POST["myTweet"])."')";
		
		if(mysqli_query($con, $sql)){
			
			$msg = "Tweet added successfully.";
			
		}
		
	}
	
	else {
		
		$msg = "Field must not be empty. Please try again.";
		
	}
	
}

else {
	
	header('location: index.php');
	die;
	
}

header('location: index.php?message='.$msg.'');
?>