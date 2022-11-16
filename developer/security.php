<?php
	
	session_start();
	if(isset($_SESSION["SAEP_session"])){
		
	}else{
		header("Location: ../login/");
	}

?>
