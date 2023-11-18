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
				<img class="bannericons" src="">
				<a href="userpage.php?user_id=">Jimmy Jones</a><BR></div>
				<table>
				<tr><td>
				tweets</td><td>following</td><td>followers</td></tr>
				<tr><td>0</td><td>0</td><td>0</td>
				</tr></table><BR><BR><BR><BR><BR>
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
						<input type="submit" name="button" id="button" value="Send" class="btn btn-primary btn-lg btn-block login-button"/>
						
					</div>
					</form>
				</div>
				<div class="img-rounded">
				<!--display list of tweets here-->
				</div>
			</div>
			<div class="col-md-3">
				<div class="whoToTroll img-rounded">
				<div class="bold">Who to Troll?<BR></div>
				<!-- display people you may know here-->
				
				<?php
				
					//Get the users already following and add this profile id
				
					$sql_follows = "SELECT to_id FROM follows WHERE from_id = '".$_SESSION["SESS_MEMBER_ID"]."'";
					
					$retrieve_already_following = mysqli_query($con, $sql_follows);
					
					$not_follow = $_SESSION["SESS_MEMBER_ID"];
					
					$users_following = array();
					
					while($row = mysqli_fetch_array($retrieve_already_following)){
						
						$users_following[] = $row;
						
					}
					
					foreach($users_following as $row){
						
							
							$not_follow = $not_follow.", ".$row["to_id"];
							
						
					}
					
					//Getting 3 users to follow
					
					$sql_getting_users = "SELECT user_id, first_name, last_name, profile_pic FROM users WHERE user_id NOT IN(".$not_follow.") LIMIT 3";
					
					$retrieve_users = mysqli_query($con, $sql_getting_users);
					
					while($row_users = mysqli_fetch_array($retrieve_users)){
						
						echo '<div>';
						echo '<img src="Images/profilepics/'.$row_users["profile_pic"].'" style="max-width: 60px; max-height: 60px;margin-right: 20px;">';
						echo '<a href="follow_proc.php?user_id='.$row_users["user_id"].'">'.$row_users["first_name"]." ".$row_users["last_name"]."</a>";
						echo '<br><a href="follow_proc.php?user_id='.$row_users["user_id"].'" class="btn btn-primary" style="background: black; border-color: black; font-size: 1em; margin-left: 80px;">Follow</a>';
						echo '</div>';
						
					}
					
				
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