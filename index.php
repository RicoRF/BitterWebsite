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
include_once("user.php");

$currentUser = new User(null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);

$currentUser->Populate($_SESSION["SESS_MEMBER_ID"], $con);

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
	//just a little jquery to make the textbox appear/disappear like the real Twitter website does
	$(document).ready(function() {
		//hide the submit button on page load
		$("#button").hide();
		$("#tweet_form").submit(function() {
			
			$("#button").hide();
		});
		$("#myTweet").click( function() {			
			this.attributes["rows"].nodeValue = 5;
			$("#button").show();
			
		});//end of click event
		$("#myTweet").blur( function() {			
			this.attributes["rows"].nodeValue = 1;
                        //$("#button").hide();

		});//end of click event
	});//end of ready event handler
    
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
				<div class="mainprofile img-rounded">
				<div class="bold">
				<img class="bannericons" src="<?php echo checkProfilePhoto($con, $currentUser->user_id); ?>">
				<a href="userpage.php?user_id=<?php echo $currentUser->user_id; ?>"><?php echo $currentUser->first_name." ".$currentUser->last_name; ?></a><BR></div>
				
				<?php getTFF($con, $currentUser->user_id) ?>
				
				<BR><BR><BR><BR><BR>
				</div><BR><BR>
				<div class="trending img-rounded">
				<div class="bold">Trending</div>
				</div>
				
			</div>
			<div class="col-md-6">
			
				<?php
				
				getMessage();
				
				?>
			
				<div class="img-rounded">
					<form method="post" id="tweet_form" action="tweet_proc.php">
					<div class="form-group">
						<textarea class="form-control" name="myTweet" id="myTweet" rows="1" placeholder="What are you bitter about today?"></textarea>
						<input type="submit" name="buttonTweet" id="button" value="Send" class="btn btn-primary btn-lg btn-block login-button"/>
						
					</div>
					</form>
				</div>
				<div class="img-rounded">
				
				
				
				
				
				<?php
				
					retrieveTweets($con, $currentUser->user_id, 10, $currentUser->user_id);
				
				?>
				
				
				
				
				
				
				
				
				</div>
			</div>
			<div class="col-md-3">
				<div class="whoToTroll img-rounded">
				<div class="bold">Who to Troll?<BR></div>
				<!-- display people you may know here-->
				
				<?php
				
					whoToTroll($con, $currentUser->user_id);					
				
				?>
				
				</div><BR>
				<!--don't need this div for now 
				<div class="trending img-rounded">
				© 2021 Bitter
				</div>-->
			</div>
		</div> <!-- end row -->
    </div><!-- /.container -->

	<?php include_once("footer.php"); ?>