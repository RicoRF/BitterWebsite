<?php
//this page will be used when the user clicks on the "follow" button for a particular user
//process the transaction and insert a record into the database, then redirect the user back
// to index.php

session_start();

include_once("connect.php");

if(isset($_SESSION["SESS_MEMBER_ID"]) && isset($_GET["user_id"])){
	
	$sql = "INSERT INTO follows (from_id, to_id) VALUES(".$_SESSION["SESS_MEMBER_ID"].", ".$_GET["user_id"].")";
	
	if(mysqli_query($con, $sql)){
		
		header("location: index.php?message=Success");
		
	}
	
	else {
		
		echo "There was an error";
		
	}
	
}

else {
	
	header("location: index.php");
	
}

?>