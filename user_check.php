<?php

include_once('connect.php');

if(isset($_GET["username"])){
	
	$sql = "SELECT screen_name FROM users WHERE screen_name = '".$_GET["username"]."'";
	
	$execute = mysqli_query($con, $sql);
	
	if(mysqli_num_rows($execute) == 1){
		
			echo "1";
		
		}
	
}

else {
	
	header('location: index.php');
	
}

?>