<?php

function getMessage(){
	
	if(isset($_GET["message"])){
				echo "<div class='main-center'><h1>".$_GET["message"]."</h1></div><br>";
			}
	
}

function checkProfilePhoto($con, $id){
	
	$path = "images/profilepics/";
	$file = "default.jfif";
	
	if(isset($_SESSION["SESS_MEMBER_ID"])){
	
		$sql = "SELECT profile_pic FROM users WHERE user_id = ".$id."";
		
		$result = mysqli_query($con, $sql);
		
		$row = mysqli_fetch_assoc($result);
		
		if($row["profile_pic"] != ""){
		
		$file = $row["profile_pic"];
		
		}
		
	}
	
	return $path.$file;
	
}

function getUserInfo($con, $id){
	
	$info = array(
	"fName" => "",
	"lName" => "",
	"username" => "",
	"address" => "",
	"province" => "",
	"postal_code" => "",
	"contact_number" => "",
	"email" => "",
	"url" => "",
	"description" => "",
	"location" => "",
	"profile_pic" => checkProfilePhoto($con, $id)
	);
	
	$sql = "SELECT first_name, last_name, screen_name, address, province, postal_code, contact_number, email, url, description, location FROM users WHERE user_id = ".$id."";
	
	$result = mysqli_query($con, $sql);
	
	if($result){
		
		$row = mysqli_fetch_assoc($result);
		
		$info["fName"] = $row["first_name"];
		$info["lName"] = $row["last_name"];
		$info["username"] = $row["screen_name"];
		$info["address"] = $row["address"];
		$info["province"] = $row["province"];
		$info["postal_code"] = $row["postal_code"];
		$info["contact_number"] = $row["contact_number"];
		$info["email"] = $row["email"];
		$info["url"] = $row["url"];
		$info["description"] = $row["description"];
		$info["location"] = $row["location"];		
		
	}
	
	return $info;	
	
}

function checkTime($time){
	
	setlocale(LC_ALL, "can-EN");
	date_default_timezone_set("America/Halifax");
	
	$now = new DateTime(); //the current date time
	$dateTweeted = new DateTime($time); //this should come from the database
	$interval = $now->diff($dateTweeted); //get the interval between 2 dates
	//echo $interval->format("%d %h %i %s") . "  formatted<BR>";
	
	//echo $interval->i;
	
	$result ="no result";
		
	if ($interval->y > 1) {
		$result = $interval->format("%y years ago");
	} elseif ($interval->y > 0) {
		$result = $interval->format("%y year ago");
	} elseif ($interval->m > 1) {
		$result = $interval->format("%m months ago");
	} elseif ($interval->m > 0) {
		$result = $interval->format("%m month ago");
	} elseif ($interval->d > 1) {
		$result = $interval->format("%d days ago");
	} elseif ($interval->d > 0) {
		$result = $interval->format("%d day ago");
	} elseif ($interval->h > 1) {
		$result = $interval->format("%h hours ago");
	} elseif ($interval->h > 0) {
		$result = $interval->format("%h hour ago");
	} elseif ($interval->i > 1) {
		$result = $interval->format("%i minutes ago");
	} elseif ($interval->i > 0) {
		$result = $interval->format("%i minute ago");
	} elseif ($interval->s > 1) {
		$result = $interval->format("%s seconds ago");
	} elseif ($interval->s > 0) {
		$result = $interval->format("%s second ago");
	}

	return $result; // Output the result

}

?>