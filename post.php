<?php

	session_start();

	/* ---------------------------------
	   POST (SQUELCH)
	   post.php
	   02 FEB 12 - Clint
	   
	   Append post to user_post table.
	*/
	
	include 'connect.php';
	include 'redirect.php';
	include 'make_post_comment_table.php';
	
	$connection = connect($db_host, $db_user, $db_pass, $db_name);
	
	$user  = $_SESSION['user'];
	$text  = $_POST['text'];
	$title = $_POST['title'];
 	$allowedExts = array("jpg", "jpeg", "gif", "png");
	$extension = end(explode(".", $_FILES["file"]["name"]));
	//--
	if ((($_FILES["file"]["type"] == "image/gif")
	  || ($_FILES["file"]["type"] == "image/jpeg")
	  || ($_FILES["file"]["type"] == "image/png")
	  || ($_FILES["file"]["type"] == "image/pjpeg"))
	  && ($_FILES["file"]["size"] < 200000)
	  && in_array($extension, $allowedExts)) {
		//*
		$blob = file_get_contents($_FILES["file"]["tmp_name"]);
		$bdata = addslashes($blob);
		//*
		
	} else {
		
		$blob = NULL;
		$bdata = NULL;

	}
	//----
	
	$text = nl2br($text);
	$text = mysql_real_escape_string($text, $connection);
	$title = nl2br($title);
	$title = mysql_real_escape_string($title, $connection); 
		
	// Push Post
 	$sql="INSERT INTO ".$user."_posts
 	(date_time_created, title, text, img)
 	VALUES
 	( NOW(), '$title', '$text', '$bdata')";

 	if (!mysql_query($sql,$connection)) die('Error: ' . mysql_error());
 	
	else {
		
		if (!make_post_comment_table($user, $connection))
			die ('Error: ' . mysql_error());
		
		mysql_close($connection);
		
		redirect("show_account.php?usershow=".$user);	
	}
?>
