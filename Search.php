<?php

session_start();
if(!isset($_SESSION["SESS_MEMBER_ID"])){
	
	header('location: login.php');
	
}

if(!isset($_GET["search"])){
	
	header('location: login.php');
	
}

include_once("connect.php");
include_once("functions.php");
include_once("user.php");

$currentUser = new User(null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
$currentUser->Populate($_SESSION["SESS_MEMBER_ID"], $con);

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
	$search_value = htmlspecialchars($_GET["search"]);
	
	?>
	
	<BR><BR>
    <div class="container">
		<div class="row">
			<div class="col-md-6">
				<h1 style="margin-bottom: 20px;">Users</h1>
				<?php
				
					displayUsersSearch($con, $search_value, $currentUser->user_id);
				
				?>
			</div>
			<div class="col-md-6">
				<h1 style="margin-bottom: 20px;">Tweets</h1>
				<?php
				
					displayTweetsSearch($con, $search_value, $currentUser->user_id);
				
				?>
			</div>
			<BR>
				
			</div>
		</div> <!-- end row -->
    </div><!-- /.container -->

	<?php include_once("footer.php") ?>