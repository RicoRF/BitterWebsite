<?php
//this is the main page for our Bitter website, 
//it will display all tweets from those we are trolling
//as well as recommend people we should be trolling.
//you can also post a tweet from here

session_start();
if(!isset($_SESSION["SESS_MEMBER_ID"])){
	
	header('location: login.php');
	
}

include_once("connect.php");
include_once("functions.php");

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="DESC MISSING">
    <meta name="author" content="Nick Taggart, nick.taggart@nbcc.ca">
    <link rel="icon" href="favicon.ico">

    <title>Bitter - Social Media for Trolls, Narcissists, Bullies and Presidents</title>

    <!-- Bootstrap core CSS -->
    <link href="includes/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="includes/starter-template.css" rel="stylesheet">
	<!-- Bootstrap core JavaScript-->
    <script src="https://code.jquery.com/jquery-1.10.2.js" ></script>
	
	<script>

	</script>
  </head>

  <body>

    <?php
	include_once("includes/header.php");
	?>
	<BR><BR>
    <div class="container">
		<div class="row">
			<div class="col-md-3">
				
				
			</div>
			<div class="col-md-6">
			
				<?php
				
				getMessage();
				
				?>
			
				<h1>Edit Profile Photo</h1><br>
			
				<div class="img-rounded">
					<form method="post" id="upload_image" action="edit_photo_proc.php" enctype="multipart/form-data">
					<div class="form-group">
						<!--<input type="hidden" name="MAX_FILE_SIZE" value="5000" />-->
						<input type="file" class="form-control" name="photo" id="photo"  rows="1">
						<input type="submit" name="buttonUploadPhoto" id="button" value="Send" class="btn btn-primary btn-lg btn-block login-button"/>						
					</div>
					</form>
				</div>
				<div class="img-rounded">
				<!--display list of tweets here-->
				</div>
			</div>
			<div class="col-md-3">
			
				
				</div><BR>
				<!--don't need this div for now 
				<div class="trending img-rounded">
				© 2021 Bitter
				</div>-->
			</div>
		</div> <!-- end row -->
    </div><!-- /.container -->

	<?php include_once("footer.php"); ?>