<?php 
//insert a tweet into the database
session_start();
include_once('connect.php');

$msg = "";

if(isset($_GET["tweet_id"]) && isset($_SESSION["SESS_MEMBER_ID"])){
	
	
		$sql_select = "SELECT * FROM tweets WHERE tweet_id = ".$_GET["tweet_id"]."";
	
		$result_tweet = mysqli_query($con, $sql_select);
		
		$result_tweet_info = mysqli_fetch_assoc($result_tweet);
		
		$sql = "INSERT INTO tweets (user_id, tweet_text, original_tweet_id) VALUES(".$_SESSION["SESS_MEMBER_ID"].", '".$result_tweet_info["tweet_text"]."', ".$_GET["tweet_id"].")";
		
		if(mysqli_query($con, $sql)){
			
			$msg = "Tweet added successfully.";
			
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