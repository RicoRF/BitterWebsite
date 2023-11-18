
						function displayReply(){
							
							let id = "reply_tweet_" + this.getAttribute("data-tweetid");
							
							let tweet = document.getElementById(id);
							tweet.classList.remove("reply_default");
							
						}
						
						function hideReplyForm(idToHide){
							
							let id = "reply_tweet_" + idToHide;
							
							let tweet = document.getElementById(id);
							tweet.classList.add("reply_default");
							
						}
						
						async function replyTweet(){
							
							let idToReply = this.getAttribute("data-tweetid");
							let message = document.getElementById("replyText_" + idToReply).value;
							let userFrom = document.getElementById("userFrom_" + idToReply).value;
														
							let xmlhttp = new XMLHttpRequest();
							xmlhttp.onreadystatechange = function() {
								
							   if (this.status===200) {			   
								   
								   if(this.responseText == "ok"){
									   
									   hideReplyForm(idToReply);
									   let to_click = document.getElementById("show_replies_link_" + idToReply);
									   to_click.click();
								   
								   }
								   
								   else {
									   
									   document.getElementById("error_for_reply_" + idToReply).innerHTML = this.responseText;
									   
								   }
								   
							   } 
							   
							   /*else {
								   
								   alert("Error replying to the tweet");
								   
							   }*/
								
							};
							
							
							
							let prmReply = "replytotweet.php?idToReply=" + idToReply +"&message=" + message + "&userFrom=" + userFrom;
							
							xmlhttp.open("GET", prmReply);
							xmlhttp.send();
							
						}
						
						function showReplies(){
							
							let tweetId = this.getAttribute("data-tweetid");
							
							//alert(tweetId);

							let xmlhttp = new XMLHttpRequest();
							xmlhttp.onreadystatechange = function() {
								
							   if (this.status===200) {			   
								   
								   if(this.responseText == "ok"){
									   
									   document.getElementById("see_replies_" + tweetId).innerHTML = this.responseText;
									   
								   
								   }
								   
								   else {
									   
									   //document.getElementById("error_for_reply_" + idToReply).innerHTML = this.responseText;
									   document.getElementById("see_replies_" + tweetId).innerHTML = this.responseText;
									   									   
								   }
								   
							   } 
							   
							   /*else {
								   
								   alert("Error replying to the tweet");
								   
							   }*/
								
							};
																					
							let prmReply = "showrepliestotweet.php?idReplies=" + tweetId;
							
							xmlhttp.open("GET", prmReply);
							xmlhttp.send();
							
							document.getElementById("show_replies_link_" + tweetId).text = "Update replies";
							
						}
											