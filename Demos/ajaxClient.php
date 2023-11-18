<?php
// This code prevents page caching

	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 	// Date in the past
	header("Pragma: no-cache");
?> 

<?php
// Database Connectivity

	$db_connected = mysqli_connect("localhost", "root", "","ajaxDemo")
		or die("Not connected : " . mysql_error());
	$db_name = "ajaxDemo";
	//$db_selected = mysql_select_db($db_name, $db_connected)
	//	or die("Not selected : " . mysql_error());
?>


<html>
<head>
<title>Ajax Demo</title>

<!-- Required stylesheet 																-->
<link rel="stylesheet" type="text/css" href="../Includes/ajaxDemo.css" />

<!-- jQuery is a JavaScript library, used to extend, enhance, and simplify JavaScript. 	-->
<!-- jQuery is accessed by simply including a JavaScript file. -->

<script type="text/javascript" src="../Includes/jquery-3.3.1.min.js"></script>

<script type="text/javascript">	
	
	// STEP.1 -- This function is called when the page loads	
	// jQuery being used -  						
	$(() => {
			  // Clear the form (FF caches form data between refreshes by default)
			  // Activate the following code if you want all the form fields to be cleared on load.
			  // Be aware that any values you have initially set in radio buttons will be cleared by this code,
			  // so if you want to use it, you'll have to trap the user selected radio button and assign a value manually!
			  
			  // $(':input').each(	 function( ) {
			  //					 	if (this.type != "submit") {
			  //			   			   this.value="";
			  //						}
			  // 					 }
			  //				  );

			  // Initially hide the "Comment Submitted" message or http://api.jquery.com/hide 
			  $('#comment_submitted').hide( );
			 }
		);
	// End of jQuery STEP.1
	
</script>	

<script type="text/javascript">	
	//this might not be the best way to do AJAX, can you think of a better way?
	//		maybe from an earlier JavaScript course?
	// STEP.4 -- This JavaScript function will be called when you submit your comment via the form	
	let CommentSubmit =  function() {
		let url = "ajaxServer.php";
		let xhr = new XMLHttpRequest();
		
		//grab the 2 values from the form 
		let name = $("#name").val();
		let comment = $("#comment").val()
		
		
		xhr.open('POST', url, true); //tell it what URL we want to send it to
		xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send('name=' + name + '&comment=' + comment);
		// Comment was submitted, so hide the comment form or http://api.jquery.com/hide 
		$("#submit_a_comment").hide();

		// Show the "thank you" (STEP.8) message using a slideDown animation - http://api.jquery.com/slidedown
		$("#comment_submitted").slideDown("slow");

		var commentDiv = '<div class="user_comment">' +
            '<p><span class="user_comment_name">' +
            'You commented:' +
            '</span></p>' +
            '<p class="user_comment_text">' + comment + '</p>' +
            '<p><br/ ><br /><img src="../Images/stars_rating_03.gif" height=19 width=91 align=right></p>' +
            '</div>';

          // Prepend ("put before") the comment to the appropriate element
          // So, you're instructing the page to display the <div> you built above 			
          // just before the <div> called "previously_submitted_comments" (see HTML below).	
          $("#previously_submitted_comments").prepend(commentDiv);

          // Comment was submitted, so hide "the first" message
          $("#thefirst").hide();

		return false; //make sure the form doesn't submit
	} //end Comment submit 

</script>

</head>
<body>

<div id="wrapper">
<!-- These IDs are referenced by various code elements.  Ensure they are unique and correct! --> 

	 <h3>Comments:</h3>

	 <!-- STEP.2 -- Get previous comments (if any) from the database -->
	 <div id="previously_submitted_comments">
	 <!-- These IDs are referenced by various code elements.  Ensure they are unique and correct! --> 	 
	 <?php
	 
		  $strSQL = "SELECT name, comment FROM comments ORDER BY id DESC"; 
		  $rsComments = mysqli_query($db_connected, $strSQL)
				or die($db_name . " : " . $strSQL . " : " . mysql_error());
		  
		  if ( mysqli_num_rows($rsComments) == 0 ) { 
		  	 echo '
					 <div class="user_comment" id="thefirst">
					 	    <p>Customer reviews are submitted by consumers like you everyday! 
								  These perspectives are a series of views of the product in different settings 
								  that may help you in your purchasing decisions. 
								  We do not filter reviews based on positive or negative content.</p>
					 </div>
				';
		  
		   }
		   else while ($rowComments = mysqli_fetch_array($rsComments)) {
		  		echo '
					 <div class="user_comment">
					 	  <p>Submitted By: <span class="user_comment_name">' . $rowComments['name'] . '</span></p>
						  <p class="user_comment_text">' . $rowComments['comment'] . '</p>
						  <p><br /><br /><img src="../Images/stars_rating_00.gif" height=19 width=91 align=right></p>
					 </div>
				';
		  }
		  
		  mysqli_close($db_connected);
	 ?>
	 </div>	 
	 
	 <!-- STEP.3 -- Enter new comment -->
	 <div id="submit_a_comment" >
	 <!-- These IDs are referenced by various code elements.  Ensure they are unique and correct! --> 
	 	  <h3>Submit a Comment:</h3>
		  <form id="frmComment" name="frmComment" onsubmit="return CommentSubmit();">
		  <!-- These IDs are referenced by various code elements.  Ensure they are unique and correct! --> 
		  		<label for="name">Name:</label><br />
				<input type="text" id="name" name="name" value="" size="52" /><br />
				<label for="comment">Comment:</label><br />
				<textarea id="comment" name="comment" cols="40" rows="10"></textarea><br />
				<input type="button" onclick="CommentSubmit()" value="SUBMIT" name="submit" />
		  </form>
	 </div>	 
	 
	 <!-- STEP.8 -- Confirm receipt of comment -->
	 <p id="comment_submitted">Thank you for your comment.</p>
	 <!-- These IDs are referenced by various code elements.  Ensure they are unique and correct! --> 	 
</div>

</body>
</html>