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

$thisPageUser = new User(null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);

if(!isset($_GET["user_id"])){

	$thisPageUser->Populate($_SESSION["SESS_MEMBER_ID"], $con);
	
}

else {
	
	$thisPageUser->Populate($_GET["user_id"], $con);
	
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Bitter - Social Media for Trolls, Narcissists, Bullies and Presidents</title>

    <!-- Bootstrap core CSS -->
    <link href="includes/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="includes/starter-template.css" rel="stylesheet">
	<!-- Bootstrap core JavaScript-->
    <script src="https://code.jquery.com/jquery-1.10.2.js" ></script>
	
	
  </head>

  <body>

    <?php
	
	include_once("includes/header.php");
	
	?>
	
	<BR><BR>
    <div class="container">
		<div class="row">
			<div class="col-md-3">
				<div class="mainprofile img-rounded">
				<div class="bold">
				<img class="bannericons" src="<?php echo checkProfilePhoto($con, $thisPageUser->user_id); ?>">
				<?php echo $thisPageUser->first_name." ".$thisPageUser->last_name; ?><BR></div>
				<?php getTFF($con, $thisPageUser->user_id) ?>
				<img class="icon" src="images/location_icon.jpg"><?php echo $thisPageUser->province; ?>
				<div class="bold">Member Since:</div>
				<div><?php echo $thisPageUser->date_created; ?></div>
				</div><BR><BR>
				
				<div class="trending img-rounded">
				<div class="bold"><?php followersYouKnow($con, $thisPageUser->user_id, $currentUser->user_id); ?><BR>
				
				</div>
				</div>
				
			</div>
			<div class="col-md-6">
				<div class="img-rounded">
					
				</div>
				<div class="img-rounded">
				<?php retrieveUserTweets($con, $thisPageUser->user_id, 20, $currentUser->user_id); ?>
				</div>
			</div>
			<div class="col-md-3">
				<div class="whoToTroll img-rounded">
				<div class="bold">Who to Troll?<BR></div>
				
				<?php whoToTroll($con, $currentUser->user_id);	?>
				
				</div><BR>
				
			</div>
		</div> <!-- end row -->
    </div><!-- /.container -->

	<?php include_once("footer.php") ?>