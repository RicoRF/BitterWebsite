<?php

function getMessage(){
	
	if(isset($_GET["message"])){
				echo "<div class='main-center'><h1>".$_GET["message"]."</h1></div><br>";
			}
	
}

?>