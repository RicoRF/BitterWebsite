<?php

session_start();
if(isset($_SESSION["SESS_MEMBER_ID"])){
	
	header('location: index.php');
	
}

include_once("functions.php");

?>


<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="This is the registration page for the Bitter website">
    <meta name="author" content="Rico Ferrante - fferrante01@mynbcc.ca">
    <link rel="icon" href="favicon.ico">

    <title>Signup - Bitter</title>

    <!-- Bootstrap core CSS -->
    <link href="includes/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="includes/starter-template.css" rel="stylesheet">
	<!-- Bootstrap core JavaScript-->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
	
    <script src="includes/bootstrap.min.js"></script>
    
	<script type="text/javascript">
		
	var existsDoubleCheck = false;
		
	function checkUsername(username) {
		
		if (username.length > 0) {
		
			let xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				
			   if (this.status===200 && this.responseText != "") {			   
				   
				   document.getElementById("exists").innerHTML = "Username already exists.";
				   existsDoubleCheck = true;

			   } 
			   
			   else {
				   
				   document.getElementById("exists").innerHTML = "";
				   existsDoubleCheck = false;
				   
			   }
				
			};
			
			xmlhttp.open("GET", "user_check.php?username=" + username);
			xmlhttp.send();
			
		}
		
		else {
				   
				   document.getElementById("exists").innerHTML = "";
				   
		}
		
	}
	
	
	
	function validateForm(event){
		
		//event.preventDefault();
		
		//Declaring variables
		
		let valid = true;
		
		let result = "";
						
		let fName = document.querySelector("#firstname").value;
		let lName = document.querySelector("#lastname").value;
		let username = document.querySelector("#username").value;
		let email = document.querySelector("#email").value;
		let password = document.querySelector("#password").value;
		let confirm = document.querySelector("#confirm").value;
		let phone = document.querySelector("#phone").value;
		let address = document.querySelector("#address").value;
		let province = document.querySelector("#province").value;
		let postalCode = document.querySelector("#postalCode").value;
		let desc = document.querySelector("#desc").value;
		let url = document.querySelector("#url").value;
		let location = document.querySelector("#location").value;
		
		//Empty and valid format check
		
		if(fName == ""){
			
			result += "First Name is empty.\n";
			valid = false;
			
		}
						
		if(lName == ""){
			
			result += "Last Name is empty.\n";
			valid = false;
			
		}
		
		if(username == ""){
			
			result += "Username is empty.\n";
			valid = false;
			
		}
		
		if(username != "" && existsDoubleCheck){
			
			result += "Username already exists.\n";
			valid = false;
			
		}
		
		//RegEx extracted from chatGPT
		
		let emailRegex = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/;
		
		if(!emailRegex.test(email)){
			
			result += "Email is not valid.\n";
			valid = false;
			
		}
		
		if(password == ""){
			
			result += "Password is empty.\n";
			valid = false;
			
		}
		
		if(password != confirm){
			
			result += "Passwords don't match.\n";
			valid = false;
			
		}
		
		//RegEx extracted from chatGPT
		
		phone = phone = phone.replace(/[^0-9]/g, '');
		
		if(phone.length != 10){
			
			result += "Phone is not valid. \n\tFormats accepted are: XXX-XXX-XXXX and (XXX) XXX-XXXX\n";
			valid = false;
			
		}
		
		if(address == ""){
			
			result += "Address is empty.\n";
			valid = false;
			
		}
		
		if(province == ""){
			
			result += "Province is empty.\n";
			valid = false;
			
		}
		
		//RegEx extracted from chatGPT
		
		/*postalCode = postalCode.replace(/[^A-Za-z0-9]/g, '');

		//RegEx extracted from https://stackoverflow.com/questions/15774555/efficient-regex-for-canadian-postal-code-function
		let postalCodeRegex = /^[ABCEGHJ-NPRSTVXY]\d[ABCEGHJ-NPRSTV-Z][ -]?\d[ABCEGHJ-NPRSTV-Z]\d$/i;
		
		if(!postalCodeRegex.test(postalCode)){
			
			result += "Postal Code is not valid.\n";
			valid = false;
			
		}*/
		
		if(desc == ""){
			
			result += "Description is empty.\n";
			valid = false;
			
		}
		
		//Length of characters check
		
		if(fName.length > 50){
			
			result += "First Name is too long.\n";
			valid = false;
			
		}
		
		if(lName.length > 50){
			
			result += "Last Name is too long.\n";
			valid = false;
			
		}
		
		if(username.length > 50){
			
			result += "Username is too long.\n";
			valid = false;
			
		}
		
		if(password.length > 250){
			
			result += "Password is too long.\n";
			valid = false;
			
		}
		
		if(address.length > 200){
			
			result += "Address is too long.\n";
			valid = false;
			
		}
		
		if(province.length > 50){
			
			result += "Province is too long.\n";
			valid = false;
			
		}
		
		if(postalCode.length > 7){
			
			result += "Postal Code is too long.\n";
			valid = false;
			
		}
		
		if(phone.length > 25){
			
			result += "Phone is too long.\n";
			valid = false;
			
		}
		
		if(email.length > 100){
			
			result += "Email is too long.\n";
			valid = false;
			
		}
		
		if(url.length > 50){
			
			result += "URL is too long.\n";
			valid = false;
			
		}
		
		if(desc.length > 160){
			
			result += "Description is too long.\n";
			valid = false;
			
		}
		
		if(location.length > 50){
			
			result += "Location is too long.\n";
			valid = false;
			
		}
		
		if(valid != true){
			
			event.preventDefault();
			alert(result);
			
		}
		
	}
	
	$( document ).ready(function() {
    document.querySelector("#button").addEventListener("click", validateForm, false);
});
	
	</script>
  </head>

  <body>

    <?php
	
	include_once('includes/header.php');
	
	?>

	<BR><BR>
    <div class="container">
		<div class="row">
			
			<div class="main-login main-center">
				<?php
				
					getMessage();
				
				?>
				<h5>Sign up once and troll as many people as you like!</h5>
					<form method="post" id="registration_form" name="registration_form" action="signup_proc.php">
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">First Name*</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
									<input type="text" class="form-control"  name="firstname" id="firstname"  placeholder="Enter your First Name"/>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Last Name*</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
									<input type="text" class="form-control"  name="lastname" id="lastname"  placeholder="Enter your Last Name"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="email" class="cols-sm-2 control-label">Your Email*</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
									<input type="text" class="form-control"  name="email" id="email"  placeholder="Enter your Email"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="username" class="cols-sm-2 control-label">Screen Name*</label>
							<div class="cols-sm-10">
								<div class="input-group">									
									<input type="text" class="form-control"  name="username" id="username"  placeholder="Enter your Screen Name" onkeyup="checkUsername(this.value)" />
								</div>
								<div id="exists">
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="password" class="cols-sm-2 control-label">Password*</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
									<input type="password" class="form-control"  name="password" id="password"  placeholder="Enter your Password"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="confirm" class="cols-sm-2 control-label">Confirm Password*</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
									<input type="password" class="form-control"  name="confirm" id="confirm"  placeholder="Confirm your Password"/>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Phone Number*</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
									<input type="text" class="form-control"  name="phone" id="phone"  placeholder="Enter your Phone Number"/>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Address*</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
									<input type="text" class="form-control"  name="address" id="address"  placeholder="Enter your Address"/>
								</div>
							</div>
						</div>
						
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Province*</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
									<select name="province" id="province" class="textfield1" ><?php echo $vprovince; ?> 
										<option> </option>
										<option value="British Columbia">British Columbia</option>
										<option value="Alberta">Alberta</option>
										<option value="Saskatchewan">Saskatchewan</option>
										<option value="Manitoba">Manitoba</option>
										<option value="Ontario">Ontario</option>
										<option value="Quebec">Quebec</option>
										<option value="New Brunswick">New Brunswick</option>
										<option value="Prince Edward Island">Prince Edward Island</option>
										<option value="Nova Scotia">Nova Scotia</option>
										<option value="Newfoundland and Labrador">Newfoundland and Labrador</option>
										<option value="Northwest Territories">Northwest Territories</option>
										<option value="Nunavut">Nunavut</option>
										<option value="Yukon">Yukon</option>
									  </select>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Postal Code*</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
									<input type="text" class="form-control"  name="postalCode" id="postalCode"  placeholder="Enter your Postal Code"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Url</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
									<input type="text" class="form-control" name="url" id="url"  placeholder="Enter your URL"/>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Description*</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
									<input type="text" class="form-control"  name="desc" id="desc"  placeholder="Description of your profile"/>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Location</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
									<input type="text" class="form-control" name="location" id="location"  placeholder="Enter your Location"/>
								</div>
							</div>
						</div>
						
						
						<div class="form-group ">
							<input type="submit" name="button" id="button" value="Register" class="btn btn-primary btn-lg btn-block login-button"/>
							
						</div>
						
					</form>
				</div>
			
		</div> <!-- end row -->
    </div><!-- /.container -->
    <?php include_once("footer.php"); ?>