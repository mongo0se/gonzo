<?php 
	
	/* LOGOUT
	   End session, log user out.
	   02 FEB 12 - Clint
	*/
	
	session_start(); 
	session_destroy();
	
	include 'redirect.php';
	redirect($_SERVER['HTTP_REFERER']);
	
?>
