<?php
	/* CREATE NEW ACCOUNT
	   newaccount.php
	   02 FEB 12 - Clint
	   
	   Todo - encrypt passwords, validate etc.
	 */

	session_start();
	
	include 'CONFIG.php';
	include 'connect.php';
	include 'redirect.php';

	// Connect
	$con = connect($db_host, $db_user, $db_pass, $db_name);

	$url = $_POST['url'];
	$_SESSION['last_url'] = $url;

	$newuser = $_POST["username"];
	$newuser = strtolower($newuser);
	
	// Check username / password is not too long
	if (strlen($_POST["password"]) > $max_username
	 || strlen($newuser) > $max_password) {
		 redirect("newaccount.php?error=\"Usernames and Passwords cannot exceed 32 characters.\"&url=".$url);
		 
	 }
	
    // Check Username does not already exist.
	$query = "SELECT username
	 		 FROM users
             WHERE username=".
	    	 "'".$newuser."'";
	$result = mysql_query($query);   
	$row = mysql_fetch_array($result, MYSQL_BOTH);
	
    if ($row['username'] == $newuser) {
		redirect("newaccount.php?error=\"Username ".$newuser." already exists.\"&url=".$url);
	}
	
	// Check username for illegal characters
	else if (strpbrk($newuser, ' _()[]{},.\/|:;"') != FALSE) {
		redirect("newaccount.php?error=\"Username  ".$newuser." contains invalid characters.\"&url=".$url);
	}
	
	// Check entered passwords match one another
	else if ($_POST["password"] != $_POST["password_chk"]) {
		redirect("newaccount.php?error=\"Passwords did not match.\"&url=".$url);
	}
	
	// Check Captcha
	if( $_REQUEST['captchacode'] === $_SESSION['captcha']['code'] ) {

		// Enter Data into Table
 		$password     = md5($_POST[password]);
		$passwordHint = $_POST["passwordHint"];
		$email        = $_POST["email"]; 		

		if ($_POST["passwordHint"] == "[OPTIONAL]") { $passwordHint = NULL; }
		if ($_POST["email"] == "[OPTIONAL]") { $email = NULL; }

 		$query="INSERT INTO users (username, password, passwordHint, email)
 		VALUES
 		('$newuser','$password', '$passwordHint', '$email')";

 		if (!mysql_query($query,$con)) {
		    redirect("newaccount.php?error=\"Error! Could not enter new data!\"&url=".$url);
		}
		    
   		
		
		// Create post table
		$query = "CREATE TABLE ".$newuser."_posts
                  (
                  id INT NOT NULL AUTO_INCREMENT,
                  PRIMARY KEY(id),
                  date_time_created DATETIME DEFAULT NULL,
                  title VARCHAR(100),
		          text VARCHAR(500),
		          img LONGBLOB
                  )";
                  
        if (!mysql_query($query,$con)) {
		    redirect("newaccount.php?error=\"Error creating table!\"&url=".$url);
		}
                  
		// Associate user ID with current session.
		$_SESSION['user']=$newuser;
		
	}
	
	else {

		redirect("newaccount.php?error=\"Invalid Captcha Code.\"&url=".$url);
	
 		
		
	}

 	mysql_close($con);
 	redirect($url);
 ?>
