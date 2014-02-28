<?php session_start(); ?>
<html>
 <head>
  <title>Upload Picture</title>
  <link rel="stylesheet" type="text/css" href="gonzo.css" />
 </head>
<body>
<div id="container">
<!--- Top Header Bar --->
<center><div id="title">Upload Picture</div></center>
<?php

	// uploadPic.php
	// 30th Nov 12

	include 'connect.php';
	include 'redirect.php';
	include 'userbar.php';
	
	$con = connect($db_host, $db_user, $db_pass, $db_name);
	
	// --- USER BAR ---
	echoUserBar();

    // ----------------------------------------------------------
	// ----------------- VALIDATION -----------------------------

	                
		 // Insert IMG into TABLE
		 $user = $_SESSION['user'];

		 $query = "DELETE FROM userProfileImgs
				   WHERE user='".$user."'";
				   

		 if (!mysql_query($query, $con)) {
			 
			 echo "Failed to delete profile img!<br />";
   
		  } else {
			  
			  echo "Image Deleted OK. <br />";
			  
		  }               
          

?>
