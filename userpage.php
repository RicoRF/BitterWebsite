<?php
//displays all the details for a particular Bitter user
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
				<img class="bannericons" src="images/profilepics/default.jfif">
				Jimmy Jones<BR></div>
				<table>
				<tr><td>
				tweets</td><td>following</td><td>followers</td></tr>
				<tr><td>0</td><td>0</td><td>0</td>
				</tr></table>
				<img class="icon" src="images/location_icon.jpg">New Brunswick
				<div class="bold">Member Since:</div>
				<div>jan 1, 2001</div>
				</div><BR><BR>
				
				<div class="trending img-rounded">
				<div class="bold">0 &nbsp;Followers you know<BR>
				
				</div>
				</div>
				
			</div>
			<div class="col-md-6">
				<div class="img-rounded">
					
				</div>
				<div class="img-rounded">
				
				</div>
			</div>
			<div class="col-md-3">
				<div class="whoToTroll img-rounded">
				<div class="bold">Who to Troll?<BR></div>
								
				
				</div><BR>
				
			</div>
		</div> <!-- end row -->
    </div><!-- /.container -->

	<?php include_once("footer.php") ?>