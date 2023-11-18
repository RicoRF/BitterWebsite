<?php

class User {
    private $user_id;
    private $first_name;
    private $last_name;
	private $screen_name;
	private $password;
	private $address;
	private $province;
	private $postal_code;
	private $contact_number;
	private $email;
	private $url;
	private $description;
	private $location;
	private $date_created;
	private $profile_pic;	
	
    public function __set($property, $value) {
        $this->$property = $value;
    } //end set
    public function __get($property) {
        return $this->$property;
    }//end get
    //cannot be overloaded
    public function __construct($user_id, $first_name, $last_name, $screen_name, $password, $address,
	$province, $postal_code, $contact_number, $email, $url, $description, $location, $date_created, $profile_pic) {
        $this->user_id = $user_id;
		$this->first_name = $first_name;
		$this->last_name = $last_name;
		$this->screen_name = $screen_name;
		$this->password = $password;
		$this->address = $address;
		$this->province = $province;
		$this->postal_code = $postal_code;
		$this->contact_number = $contact_number;
		$this->email = $email;
		$this->url = $url;
		$this->description = $description;
		$this->location = $location;
		$this->date_created = $date_created;
		$this->profile_pic = $profile_pic;
    }//end constructor
	
	//public function __construct(){}
    
	public function Populate($id, $con){
		
	$sql = "SELECT user_id, first_name, last_name, screen_name, password, address, province, postal_code, contact_number, email, url, description, location, date_created, profile_pic FROM users WHERE user_id = ".$id."";
	
	$result = mysqli_query($con, $sql);
	
	if($result){
		
		$row = mysqli_fetch_assoc($result);
		
		if(mysqli_num_rows($result)==0){
			
			header('location: index.php?message=User entered does not exist.');
			return $this;
			
		}
		
		else {
		
		$this->user_id = $row["user_id"];
		$this->first_name = $row["first_name"];
		$this->last_name = $row["last_name"];
		$this->screen_name = $row["screen_name"];
		$this->password = $row["password"];
		$this->address = $row["address"];
		$this->province = $row["province"];
		$this->postal_code = $row["postal_code"];
		$this->contact_number = $row["contact_number"];
		$this->email = $row["email"];
		$this->url = $row["url"];
		$this->description = $row["description"];
		$this->location = $row["location"];
		$this->date_created = $row["date_created"];
		$this->profile_pic = $row["profile_pic"];
		
		return $this;
		
		}
		
	}
	
	else {
		
		return false;
		
	}
		
	}
	
	public function UpdateUser($con, $property, $value){
		
		$this->$property = $value;
		
		$sql = "UPDATE `users` SET ".$property." = '".$value."' WHERE user_id = ".$this->user_id."";
		
		if(mysqli_query($con, $sql)){
			return true;
		}
		else {
			return false;
		}
		
	}
	
    public function AddUser($con) {
        //addUser function will insert a user record into the users table 
        //of the DB AND return the user_id of the record you just inserted
        //on the signup_proc.php page, populate the user object with all
        //the data from the form. Then call your AddUser function to insert
        //the data into the DB.
        //you could make AddUser static and pass in a User object to insert
        //$conn->insert_id to get the id that was just inserted
		
		$query = "INSERT INTO `users`(`first_name`,
			`last_name`, `screen_name`, `password`, `address`, `province`, `postal_code`, `contact_number`, `email`, `url`, `description`,
			`location`)
			VALUES (
			'".$this->first_name."',
			'".$this->last_name."',
			'".$this->screen_name."',
			'".password_hash($this->password, PASSWORD_DEFAULT)."',
			'".$this->address."',
			'".$this->province."',
			'".$this->postal_code."',
			'".$this->contact_number."',
			'".$this->email."',
			'".$this->url."',
			'".$this->description."',
			'".$this->location."');
		";
		
		if(mysqli_query($con, $query)){
		
			return $con->insert_id;
			
		}
		
		else {
			
			return false;
			
		}
        
    }//end user
}
    
