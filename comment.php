<?php

	session_start();

	/* POST (SQUELCH)
	   post.php
	   02 FEB 12 - Clint
	   
	   Append post to user_post table.
	*/
	
	include 'connect.php';
	include 'redirect.php';
	
	$con = connect($db_host, $db_user, $db_pass, $db_name);
	
	$id = $_POST["id"];
	$usershow = $_POST["usershow"];
	
	$text = addslashes($_POST["comment"]);
	$user = $_SESSION['user'];
		
	// Push Post
 	$sql="INSERT INTO ".$usershow."_postcomments_".$id."
 	(date_time_created, username, text)
 	VALUES
 	( NOW(), '$user', '$text')";

 	if (!mysql_query($sql,$con)) die('Error: ' . mysql_error());
	else {
		mysql_close($con);	
		redirect("show_post.php?usershow=$usershow&id=$id");
	}
?>

