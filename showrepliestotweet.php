<?php 
//insert a tweet into the database
session_start();
include_once('connect.php');
include_once('functions.php');
include_once('tweet.php');

$msg = "";

if(isset($_GET["idReplies"])){
	
	if($_GET["idReplies"] != ""){
		
		$sql = "SELECT * FROM tweets WHERE reply_to_tweet_id = ".$_GET["idReplies"]." ORDER BY date_created DESC";
		
		$result = mysqli_query($con, $sql);
		
		if($result){
						
			while($row = mysqli_fetch_array($result)){
			
			$userInfo = new User(null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
			$userInfo->Populate($row["user_id"], $con);
			
			$tweetInfo = new Tweet(null, null, null, null, null, null);
			$tweetInfo->Populate($row["tweet_id"], $con);
			
			echo '<div class="row" style="background: #f2f2f2; margin-left: 80px; margin-bottom: 20px; border-radius: 20px; padding: 20px;">
			<div class="col-2" style="">
			<img src="'.checkProfilePhoto($con, $userInfo->user_id).'" style="max-width: 60px; max-height: 60px;margin-right: 20px;">
			</div>
			
			<div class="col-10">';
			echo '
			<a href="userpage.php?user_id='.$tweetInfo->user_id.'">'.$userInfo->first_name.' '.$userInfo->last_name.' @'.$userInfo->screen_name.'</a>
			<a alt="">'.checkTime($tweetInfo->date_created).'</a>
			<br>'.$tweetInfo->tweet_text.'<br>
			
						
						</div>
						
						
						</div>';
						
			}
			
			if(mysqli_num_rows($result) == 0){
				echo 'There are no replies to show.';
			}
			
		}
		
		else {
			
			echo "Oops! Something happened while retrieving the replies.";
			
		}
		
	}
	
	else {
		
		echo "Field must be valid. Please try again.";
		
	}
	
}

else {
	
	echo "You shouldn't be here.";
	
}

?>