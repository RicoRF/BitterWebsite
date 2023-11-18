<?php

class Tweet {
    private $tweet_id;
    private $tweet_text;
    private $user_id;
	private $original_tweet_id;
	private $reply_to_tweet_id;
	private $date_created;
	
    public function __set($property, $value) {
        $this->$property = $value;
    } //end set
    public function __get($property) {
        return $this->$property;
    }//end get
    //cannot be overloaded
    public function __construct($tweet_id, $tweet_text, $user_id, $original_tweet_id, $reply_to_tweet_id, $date_created) {
        $this->tweet_id = $tweet_id;
		$this->tweet_text = $tweet_text;
		$this->user_id = $user_id;
		$this->original_tweet_id = $original_tweet_id;
		$this->reply_to_tweet_id = $reply_to_tweet_id;
		$this->date_created = $date_created;
    }//end constructor
    
    public function AddTweet() {
        //addUser function will insert a user record into the users table 
        //of the DB AND return the user_id of the record you just inserted
        //on the signup_proc.php page, populate the user object with all
        //the data from the form. Then call your AddUser function to insert
        //the data into the DB.
        //you could make AddUser static and pass in a User object to insert
        //$conn->insert_id to get the id that was just inserted
        
    }//end user
	
	public function Populate($id, $con){
		
		$result = mysqli_query($con, "SELECT * FROM tweets WHERE tweet_id = ".$id."");
		
		if($result){
		
		$row = mysqli_fetch_assoc($result);
		
		$this->tweet_id = $row["tweet_id"];
		$this->tweet_text = $row["tweet_text"];
		$this->user_id = $row["user_id"];
		$this->original_tweet_id = $row["original_tweet_id"];
		$this->reply_to_tweet_id = $row["reply_to_tweet_id"];
		$this->date_created = $row["date_created"];
		
		return $this;
		
		}
		
		else {
			
			return false;
			
		}
		
	}
}
    
