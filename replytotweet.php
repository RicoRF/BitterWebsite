<?php 
//insert a tweet into the database
session_start();
include_once('connect.php');

$msg = "";

if(isset($_GET["idToReply"]) && isset($_GET["message"]) && isset($_GET["userFrom"]) && isset($_SESSION["SESS_MEMBER_ID"])){
	
	if($_GET["message"] != ""){
		
		$sql = "INSERT INTO tweets (user_id, tweet_text, reply_to_tweet_id) VALUES(".$_GET["userFrom"].", '".htmlspecialchars($_GET["message"])."', ".$_GET["idToReply"].")";
		
		if(mysqli_query($con, $sql)){
			
			echo "ok";
			
		}
		
		else {
			
			echo "Oops! Something happened while submitting your reply.";
			
		}
		
	}
	
	else {
		
		echo "Field must not be empty. Please try again.";
		
	}
	
}

else {
	
	echo "You shouldn't be here.";
	
}

?>