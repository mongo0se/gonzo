<?php

	session_start();

	/* DELETE POST
	   deletepost.php
	   06 FEB 12 - Clint
	   
	   Delete post row from post stack.
	*/
	
	include 'connect.php';
	include 'redirect.php';
	
	$con = connect($db_host, $db_user, $db_pass, $db_name);
	
	// Find User's Post Table 
	$user = $_SESSION['user'];
	$postid = $_GET["postid"];
	$commentid = $_GET["commentid"];
	
	
	$query = "DELETE FROM ".$user."_postcomments_".$postid.
	          " WHERE id='".$commentid."'";

 	if (!mysql_query($query, $con)) die('Error: ' . mysql_error() . "<br />" . $query);
	
	else {
		mysql_close($con);	
		redirect("show_post.php?usershow=$user&id=$postid");
	}
?>
