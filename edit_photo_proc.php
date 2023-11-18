<?php 
	
session_start();

if(!isset($_SESSION["SESS_MEMBER_ID"])){
	
	header('location: login.php');
	
}

include_once("connect.php");
include_once("functions.php");
include_once("user.php");

$currentUser = new User(null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);

$currentUser->Populate($_SESSION["SESS_MEMBER_ID"], $con);

$message = "SUCCESSFUL<BR>";

if (isset($_POST["buttonUploadPhoto"])) {
    
    if (empty($_FILES["photo"]["name"])) {
        //echo "YOU MUST UPLOAD A FILE"; 
        $message = "You must upload a file";
        //exit; 
    }
	
	else {
		
				$MAX_FILE_SIZE = 5 * 1024 * 1024;//5MB
			if ($_FILES["photo"]["size"] > $MAX_FILE_SIZE) {
				$message = "FILE SIZE MUST BE LESS THAN 5MB";
				unlink($_FILES["photo"]["tmp_name"]);
				//exit; 
			}
			
			else {
				
				$allowedExtensions = ['jpg', 'jpeg', 'png']; // Define the allowed extensions
				
				$fileExtension = pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION);
				
				$fileName = $currentUser->user_id.".".$fileExtension;
				
				$destFile = "Images/profilepics/" . $fileName;
								
				if(in_array(strtolower($fileExtension), $allowedExtensions)){					
					
				if (move_uploaded_file($_FILES["photo"]["tmp_name"], $destFile)) {
					
					//$sql = "UPDATE `users` SET profile_pic = '".$fileName."' WHERE user_id = ".$_SESSION["SESS_MEMBER_ID"]."";
					
					if($currentUser->UpdateUser($con, "profile_pic", $fileName)){
						
						$message = "Photo uploaded successfully.";
						
					}
					
					else {
						
						$message = "Error uploading the image. Please try again.";
						
					}
					
					
				}
				
				else {
					$message = "Error uploading the image. Please try again.";
					unlink($_FILES["photo"]["tmp_name"]); 
				}
					
				}
				
				else {
					
					$message = "File type must be jpg or png.";
					
				}
				
				
				
			}
		
	}	
    
}

else {
	
	header("location: index.php");
	die;
	
}

//redirect the user back to the main form when we are done.
header("location:edit_photo.php?message=$message");
//you must update the profile_pic field of the users table in the DB
//you must rename the profile pic file name to be $_SESSION["USER_ID"].jpg


?>