<?php   session_start();
	/* changePassword.php
	
	   Change Password Script
	   
           29th Nov 12
	 */

	include 'connect.php';
	include 'redirect.php';

	// Connect
	$con = connectToDB($db_host, $db_user, $db_pass, $db_name);

	$url = $_POST['url'];
	$_SESSION['last_url'] = $url;	
	$user = strtolower($_SESSION["user"]);

	// $oldPassword = $_POST["oldPassword"];
	$newPassword = $_POST["newPassword1"];
	$chkPassword = $_POST["newPassword2"];


	// Check old password is correct
	$query = "SELECT password
	          FROM users
                  WHERE username = ".
	    	 "'".$user."'";
	$result = mysql_query($query);   
	$row = mysql_fetch_array($result);
	
        if ( md5($_POST["oldPassword"]) != $row["password"] ) {
		redirect("changePasswordForm.php?error=\"Old Password was incorrect!".
		$user.$row["password"]." \"&url=".$url);
	}
	
       	// Check entered passwords match one another
	else if ($_POST["newPassword"] != $_POST["chkPassword"]) {
		redirect("changePasswordForm.php?error=\"Passwords did not match.\"&url=".$url);
	}
	


	// Enter Data into Table
 	$newPassword  = md5($newPassword);

	$passwordHint = $_POST["passwordHint"];
	if ($_POST["passwordHint"] == "[OPTIONAL]") { $passwordHint = NULL; }

 	$query = "UPDATE users SET password='$newPassword', passwordHint='$passwordHint' WHERE username='$user'";

	if (!mysql_query($query,$con)) {
	    redirect("changePasswordForm.php?error=\"Error updating table!\"&url=".$url);
	}

 	mysql_close($con);
 	redirect("passwordChanged.php");
 ?>
