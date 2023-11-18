<?php

//log the user out and redirect them back to the login page.

session_start();
session_unset(); //removes all variables from session (but keeps the session_id)
session_destroy(); //kills the session completely 
header("location:login.php");
?>
