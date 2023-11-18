<?php

include_once("user.php");
include_once("tweet.php");

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
	
	$result ="less than a second ago";
		
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

	function getTFF($con, $id){
		
		$sql = "SELECT COUNT(*) FROM tweets WHERE user_id = ".$id."";
		
		$tweets = mysqli_query($con, $sql);
		
		$tweets_result = mysqli_fetch_array($tweets);
		
		$sql_followers = "SELECT COUNT(*) FROM follows WHERE to_id = ".$id."";
		
		$followers = mysqli_query($con, $sql_followers);
		
		$followers_result = mysqli_fetch_array($followers);
		
		$sql_following = "SELECT COUNT(*) FROM follows WHERE from_id = ".$id."";
		
		$following = mysqli_query($con, $sql_following);
		
		$following_result = mysqli_fetch_array($following);
		
		
		
		if($tweets_result == true && $followers_result == true && $following_result == true){
			
			echo '<table>
				<tr><td>
				tweets</td><td>following</td><td>followers</td></tr>
				<tr><td>'.$tweets_result[0].'</td><td>'.$following_result[0].'</td><td>'.$followers_result[0].'</td>
				</tr></table>';
			
		}
		
		else {
			
			echo "<table>
				Unable to get the user's information.
				</tr></table>";
			
		}
		
	}
	
	function whoToTroll($con, $id){
		
		//Get the users already following and add this profile id
				
					$sql_follows = "SELECT to_id FROM follows WHERE from_id = '".$id."'";
					
					$retrieve_already_following = mysqli_query($con, $sql_follows);
					
					$not_follow = $id;
					
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
						echo '<img src="'.checkProfilePhoto($con, $row_users["user_id"]).'" style="max-width: 60px; max-height: 60px;margin-right: 20px;">';
						echo '<a href="userpage.php?user_id='.$row_users["user_id"].'">'.$row_users["first_name"]." ".$row_users["last_name"]."</a>";
						echo '<br><a href="follow_proc.php?user_id='.$row_users["user_id"].'" class="btn btn-primary" style="background: black; border-color: black; font-size: 1em; margin-left: 80px;">Follow</a>';
						echo '</div>';
						
					}
		
	}
	
	function followersYouKnow($con, $pageUserID, $currentUserID){
		
		if($pageUserID != $currentUserID){
			
			//Select followers of pageUser
			
			$sql = "SELECT * from follows where to_id = ".$pageUserID."";
			
			$followers_id = "";
			
			$fetch_followers = mysqli_query($con, $sql);
			
			while($row_followers = mysqli_fetch_array($fetch_followers)){
				
				$followers_id = $followers_id . $row_followers["from_id"].", ";
				
			}
			
			$followers_id = substr($followers_id, 0, -2);
			
			if($followers_id != ""){
			
			$sql_following = "SELECT * FROM follows WHERE from_id = ".$currentUserID." AND to_id IN(".$followers_id.")";
			
			$result_following = mysqli_query($con, $sql_following);
			
			$final_result = mysqli_num_rows($result_following);
			
			if($final_result != 1){
				
				echo $final_result . " followers you know.";
				
			}
			
			if($final_result == 1){
				
				echo "1 follower you know.";
				
			}
			
			$num_users = 0;
			
			$result_following_limit_3 = mysqli_query($con, "SELECT * FROM follows WHERE from_id = ".$currentUserID." AND to_id IN(".$followers_id.") ORDER BY RAND() LIMIT 3");
			
			while($rs = mysqli_fetch_array($result_following_limit_3)){
				
				$userInfo = new User(null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
				$userInfo->Populate($rs[2], $con);
				echo '<a href="userpage.php?user_id='.$userInfo->user_id.'"><div style="margin-top: 10px; margin-left: 6px; margin-right: 6px;">
				<img style="border: 4px solid black; width: 64px; margin-right: 6px;" src="'.checkProfilePhoto($con, $userInfo->user_id).'" style="max-width: 60px; max-height: 60px;margin-right: 20px;">';
				echo '@'.$userInfo->screen_name.' '.$userInfo->first_name.' '.$userInfo->last_name;
				echo '</div></a>';
								
			}
			
			//echo '<div style="padding-top: 10px; border-top: 4px solid white; margin-top: 10px; margin-bottom: 10px;"></div>';
			
			}
			
			else {
				
				echo '0 followers you know.';
				
			}
			//Select following 
			
		}
		
	}
	
	function retrieveTweets($con, $user_id, $tweets_limit, $currentUserId){
		
				$sql_follows = "SELECT to_id FROM follows WHERE from_id = '".$user_id."'";
					
					$retrieve_already_following = mysqli_query($con, $sql_follows);
					
					$users_to_show = $user_id;
					
					$users_following = array();
					
					while($row = mysqli_fetch_array($retrieve_already_following)){
						
						$users_following[] = $row;
						
					}
					
					foreach($users_following as $row){
						
							
							$users_to_show = $users_to_show.", ".$row["to_id"];
							
						
					}
					
					//Getting tweets
					
					$sql_getting_tweets = "SELECT * FROM tweets WHERE user_id IN(".$users_to_show.") ORDER BY date_created DESC LIMIT ".$tweets_limit."";
					
					$retrieve_tweets = mysqli_query($con, $sql_getting_tweets);
					
					echo '<script src="Includes/requests.js"></script>';
					
					while($row_tweets = mysqli_fetch_array($retrieve_tweets)){
						
						//$userInfo = getUserInfo($con, $row_tweets["user_id"]);
						$userInfo = new User(null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
						$userInfo->Populate($row_tweets["user_id"], $con);
						
						$tweetInfo = new Tweet(null, null, null, null, null, null);
						$tweetInfo->Populate($row_tweets["tweet_id"], $con);
						
						echo '<div class="row" id="tweet_number_'.$tweetInfo->tweet_id.'" style="background: #fff; margin-bottom: 20px; border-radius: 20px; padding: 20px;">';
						echo '<div class="col-2" style=""><img src="'.checkProfilePhoto($con, $userInfo->user_id).'" style="max-width: 60px; max-height: 60px;margin-right: 20px;"></div>';
						echo '<div class="col-10">';
						if($tweetInfo->original_tweet_id != 0){							
							
							$result = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM tweets WHERE tweet_id = ".$tweetInfo->original_tweet_id.""));
							
							$resultUser = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM users WHERE user_id = ".$result["user_id"].""));
							
							echo '<span style="font-size: 14px;">Retweet from <a href="userpage.php?user_id='.$result["user_id"].'" style="">@';
							
							echo $resultUser["screen_name"]."</a> ".checkTime($result["date_created"])."</span><br>";
							
						}
						
						if($tweetInfo->reply_to_tweet_id != 0){							
							
							$result = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM tweets WHERE tweet_id = ".$tweetInfo->reply_to_tweet_id.""));
							
							$resultUser = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM users WHERE user_id = ".$result["user_id"].""));
							
							echo '<span style="font-size: 14px;">Replying to <a href="userpage.php?user_id='.$result["user_id"].'" style="">@';
							
							echo $resultUser["screen_name"]."</a> ".checkTime($result["date_created"])."</span><br>";
							
						}
						
						echo '<a href="userpage.php?user_id='.$tweetInfo->user_id.'">'.$userInfo->first_name." ".$userInfo->last_name." @".$userInfo->screen_name."</a> <a alt='".$tweetInfo->date_created."'>".checkTime($tweetInfo->date_created)."</a>";
						echo '<br>';
						echo $tweetInfo->tweet_text;
						echo '<br><a href="retweet.php?tweet_id='.$tweetInfo->tweet_id.'"><img src="Images/retweet.png" style="max-width: 24px;"></a> <a onclick="displayReply.call(this)" data-tweetid="'.$tweetInfo->tweet_id.'"><img src="Images/reply.png" style="max-width: 32px;"></a>';
						
						echo '<br>';
						
						echo '<style>.reply_default { display: none; }</style>';
						
						echo '<div name="reply_tweet" id="reply_tweet_'.$tweetInfo->tweet_id.'" class="reply_default">
						
						<span id="error_for_reply_'.$tweetInfo->tweet_id.'"></span>
						
						<textarea class="form-control" name="replyText" id="replyText_'.$tweetInfo->tweet_id.'"></textarea><br>
						<input type="hidden" name="original_tweet_id" value="'.$tweetInfo->original_tweet_id.'">
						<input type="hidden" name="user_from" id="userFrom_'.$tweetInfo->tweet_id.'" value="'.$currentUserId.'">
						<input class="btn btn-primary btn-lg btn-block login-button" onclick="replyTweet.call(this)" data-tweetid="'.$tweetInfo->tweet_id.'" type="submit" name="btnSubmit">
						
						</div>
						
						';
						
						echo '</div>
						
							<hr style="width: 100%; height: 1px; background: #f2f2f2;">
						
							<div style="width: 100%; text-align: center;">
						
							<div id="see_replies_'.$tweetInfo->tweet_id.'" style="width: 100%; text-align: center;">
							
							</div>
							
							<a class="replies_link_style" onclick="showReplies.call(this)" id="show_replies_link_'.$tweetInfo->tweet_id.'" data-tweetid="'.$tweetInfo->tweet_id.'">See replies</a>
							
							</div>
						
						</div>';
						
					}
		
	}
	
	function retrieveUserTweets($con, $user_id, $tweets_limit, $currentUserId){
		
					$sql_getting_tweets = "SELECT * FROM tweets WHERE user_id = ".$user_id." ORDER BY date_created DESC LIMIT ".$tweets_limit."";
					
					$retrieve_tweets = mysqli_query($con, $sql_getting_tweets);
					
					echo '<script src="Includes/requests.js"></script>';
					
					while($row_tweets = mysqli_fetch_array($retrieve_tweets)){
						
						//$userInfo = getUserInfo($con, $row_tweets["user_id"]);
						$userInfo = new User(null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
						$userInfo->Populate($row_tweets["user_id"], $con);
						
						$tweetInfo = new Tweet(null, null, null, null, null, null);
						$tweetInfo->Populate($row_tweets["tweet_id"], $con);
						
						echo '<div class="row" id="tweet_number_'.$tweetInfo->tweet_id.'" style="background: #fff; margin-bottom: 20px; border-radius: 20px; padding: 20px;">';
						echo '<div class="col-2" style=""><img src="'.checkProfilePhoto($con, $userInfo->user_id).'" style="max-width: 60px; max-height: 60px;margin-right: 20px;"></div>';
						echo '<div class="col-10">';
						if($tweetInfo->original_tweet_id != 0){							
							
							$result = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM tweets WHERE tweet_id = ".$tweetInfo->original_tweet_id.""));
							
							$resultUser = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM users WHERE user_id = ".$result["user_id"].""));
							
							echo '<span style="font-size: 14px;">Retweet from <a href="userpage.php?user_id='.$result["user_id"].'" style="">@';
							
							echo $resultUser["screen_name"]."</a> ".checkTime($result["date_created"])."</span><br>";
							
						}
						
						if($tweetInfo->reply_to_tweet_id != 0){							
							
							$result = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM tweets WHERE tweet_id = ".$tweetInfo->reply_to_tweet_id.""));
							
							$resultUser = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM users WHERE user_id = ".$result["user_id"].""));
							
							echo '<span style="font-size: 14px;">Replying to <a href="userpage.php?user_id='.$result["user_id"].'" style="">@';
							
							echo $resultUser["screen_name"]."</a> ".checkTime($result["date_created"])."</span><br>";
							
						}
						echo '<a href="userpage.php?user_id='.$tweetInfo->user_id.'">'.$userInfo->first_name." ".$userInfo->last_name." @".$userInfo->screen_name."</a> <a alt='".$tweetInfo->date_created."'>".checkTime($tweetInfo->date_created)."</a>";
						echo '<br>';
						echo $tweetInfo->tweet_text;
						echo '<br><a href="retweet.php?tweet_id='.$tweetInfo->tweet_id.'"><img src="Images/retweet.png" style="max-width: 24px;"></a> <a onclick="displayReply.call(this)" data-tweetid="'.$tweetInfo->tweet_id.'"><img src="Images/reply.png" style="max-width: 32px;"></a>';
						
						echo '<br>';
						
						echo '<style>.reply_default { display: none; }</style>';
						
						echo '<div name="reply_tweet" id="reply_tweet_'.$tweetInfo->tweet_id.'" class="reply_default">
						
						<span id="error_for_reply_'.$tweetInfo->tweet_id.'"></span>
						
						<textarea class="form-control" name="replyText" id="replyText_'.$tweetInfo->tweet_id.'"></textarea><br>
						<input type="hidden" name="original_tweet_id" value="'.$tweetInfo->original_tweet_id.'">
						<input type="hidden" name="user_from" id="userFrom_'.$tweetInfo->tweet_id.'" value="'.$currentUserId.'">
						<input class="btn btn-primary btn-lg btn-block login-button" onclick="replyTweet.call(this)" data-tweetid="'.$tweetInfo->tweet_id.'" type="submit" name="btnSubmit">
						
						</div>
						
						';
						
						echo '</div>
						
							<hr style="width: 100%; height: 1px; background: #f2f2f2;">
						
							<div style="width: 100%; text-align: center;">
						
							<div id="see_replies_'.$tweetInfo->tweet_id.'" style="width: 100%; text-align: center;">
							
							</div>
							
							<a class="replies_link_style" onclick="showReplies.call(this)" id="show_replies_link_'.$tweetInfo->tweet_id.'" data-tweetid="'.$tweetInfo->tweet_id.'">See replies</a>
							
							</div>
						
						</div>';
						
					}
		
	}
	
	function displayUsersSearch($con, $value, $currentUserId){
		
			$value = strtolower($value);
			$value = htmlspecialchars($value);
		
			$sql = "SELECT user_id FROM users WHERE screen_name = '".$value."' OR first_name = '".$value."' OR last_name = '".$value."'";
			
			$rs = mysqli_query($con, $sql);
			
			if(mysqli_num_rows($rs) == 0){
						echo '<p>No results were found.</p>';
					}
						
			while($row = mysqli_fetch_array($rs)){
				
				$userInfo = new User(null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
				$userInfo->Populate($row[0], $con);
				
				echo '<div style="background: #fff; margin-bottom: 20px; border-radius: 20px; padding: 20px;">';
				
				echo '<img style="border: 4px solid yellow; background: white; width: 64px; margin-right: 6px;" src="'.checkProfilePhoto($con, $userInfo->user_id).'" style="max-width: 60px; max-height: 60px;margin-right: 20px;">';
				echo '<a href="userpage.php?user_id='.$userInfo->user_id.'">'.$userInfo->first_name.' '.$userInfo->last_name.' @'.$userInfo->screen_name.'</a>';

				if($userInfo->user_id != $currentUserId){
				
				if(checkFollow($con, $currentUserId, $userInfo->user_id)){
					echo ' Following';
				}
				
				else {
					
					echo '<a href="follow_proc.php?user_id='.$userInfo->user_id.'" class="btn btn-primary" style="background: black; border-color: black; font-size: 1em; margin-left: 80px;">Follow</a>';
					
				}
				
				if(checkFollow($con, $userInfo->user_id, $currentUserId)){
					echo ' | Following you';
				}
				
				}
				
				echo '</div>';
				
			}
		
	}
	
	function checkFollow($con, $follower_id, $followed_id){
		
		$sql = "SELECT * FROM follows WHERE from_id = ".$follower_id." AND to_id = ".$followed_id."";
		$query = mysqli_query($con, $sql);
		$result = mysqli_num_rows($query);
		if($result > 0){
			return true;
		}
		else {
			return false;
		}
		
	}
	
	function displayTweetsSearch($con, $value, $currentUserId){
		
		$value = strtolower($value);
		$value = htmlspecialchars($value);
		
		
		$sql_getting_tweets = "SELECT * FROM tweets WHERE tweet_text LIKE '%".$value."%' ORDER BY date_created DESC";
					
					$retrieve_tweets = mysqli_query($con, $sql_getting_tweets);
					
					if(mysqli_num_rows($retrieve_tweets) == 0){
						echo '<p>No results were found.</p>';
					}
					
					echo '<script src="Includes/requests.js"></script>';
					
					while($row_tweets = mysqli_fetch_array($retrieve_tweets)){
						
						//$userInfo = getUserInfo($con, $row_tweets["user_id"]);
						$userInfo = new User(null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
						$userInfo->Populate($row_tweets["user_id"], $con);
						
						$tweetInfo = new Tweet(null, null, null, null, null, null);
						$tweetInfo->Populate($row_tweets["tweet_id"], $con);
						
						echo '<div class="row" id="tweet_number_'.$tweetInfo->tweet_id.'" style="background: #fff; margin-bottom: 20px; border-radius: 20px; padding: 20px;">';
						echo '<div class="col-2" style=""><img src="'.checkProfilePhoto($con, $userInfo->user_id).'" style="max-width: 60px; max-height: 60px;margin-right: 20px;"></div>';
						echo '<div class="col-10">';
						if($tweetInfo->original_tweet_id != 0){							
							
							$result = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM tweets WHERE tweet_id = ".$tweetInfo->original_tweet_id.""));
							
							$resultUser = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM users WHERE user_id = ".$result["user_id"].""));
							
							echo '<span style="font-size: 14px;">Retweet from <a href="userpage.php?user_id='.$result["user_id"].'" style="">@';
							
							echo $resultUser["screen_name"]."</a> ".checkTime($result["date_created"])."</span><br>";
							
						}
						
						if($tweetInfo->reply_to_tweet_id != 0){							
							
							$result = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM tweets WHERE tweet_id = ".$tweetInfo->reply_to_tweet_id.""));
							
							$resultUser = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM users WHERE user_id = ".$result["user_id"].""));
							
							echo '<span style="font-size: 14px;">Replying to <a href="userpage.php?user_id='.$result["user_id"].'" style="">@';
							
							echo $resultUser["screen_name"]."</a> ".checkTime($result["date_created"])."</span><br>";
							
						}
						echo '<a href="userpage.php?user_id='.$tweetInfo->user_id.'">'.$userInfo->first_name." ".$userInfo->last_name." @".$userInfo->screen_name."</a> <a alt='".$tweetInfo->date_created."'>".checkTime($tweetInfo->date_created)."</a>";
						echo '<br>';
						echo $tweetInfo->tweet_text;
						echo '<br><a href="retweet.php?tweet_id='.$tweetInfo->tweet_id.'"><img src="Images/retweet.png" style="max-width: 24px;"></a> <a onclick="displayReply.call(this)" data-tweetid="'.$tweetInfo->tweet_id.'"><img src="Images/reply.png" style="max-width: 32px;"></a>';
						
						echo '<br>';
						
						echo '<style>.reply_default { display: none; }</style>';
						
						echo '<div name="reply_tweet" id="reply_tweet_'.$tweetInfo->tweet_id.'" class="reply_default">
						
						<span id="error_for_reply_'.$tweetInfo->tweet_id.'"></span>
						
						<textarea class="form-control" name="replyText" id="replyText_'.$tweetInfo->tweet_id.'"></textarea><br>
						<input type="hidden" name="original_tweet_id" value="'.$tweetInfo->original_tweet_id.'">
						<input type="hidden" name="user_from" id="userFrom_'.$tweetInfo->tweet_id.'" value="'.$currentUserId.'">
						<input class="btn btn-primary btn-lg btn-block login-button" onclick="replyTweet.call(this)" data-tweetid="'.$tweetInfo->tweet_id.'" type="submit" name="btnSubmit">
						
						</div>
						
						';
						
						echo '</div>
						
							<hr style="width: 100%; height: 1px; background: #f2f2f2;">
						
							<div style="width: 100%; text-align: center;">
						
							<div id="see_replies_'.$tweetInfo->tweet_id.'" style="width: 100%; text-align: center;">
							
							</div>
							
							<a class="replies_link_style" onclick="showReplies.call(this)" id="show_replies_link_'.$tweetInfo->tweet_id.'" data-tweetid="'.$tweetInfo->tweet_id.'">See replies</a>
							
							</div>
						
						</div>';
						
					}
		
			
		
		
	}

?>