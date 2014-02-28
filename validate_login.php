<?php

	session_start();

	/* VALIDATE EXISTING USER
	   validate_existing_user.php
	   01 JAN 12 - Clint
	   
	   See if account exists etc. */
	   
	   include 'connect.php';
	   include 'redirect.php';
	   
	   // Select DB
	   $con = connect($db_host, $db_user, $db_pass, $db_name);
	   
	   // Fetch Username and Password Combos from User Index
	   $query = "SELECT username, password
	   			 FROM users
                 WHERE username=".
				 "'".strtolower($_POST["username"])."'";
	   $result = mysql_query($query);   
	   $row = mysql_fetch_array($result, MYSQL_BOTH);
	   
	   $url = $_POST['url'];
	   $_SESSION['last_url'] = $url;
		
		// Check Username
		if (mysql_num_rows($result) == FALSE) {
			redirect('login.php?error=<p>
			                    Username does not exist.
			                    Have you created an account yet?<p />&url='.$url);
		}
		
		// Check Password
	        else if (md5($_POST["password"]) != $row["password"]) {

			// Return Hint, if user is stuck
          		if (isset($_SESSION['attempt'])) {
			   $_SESSION['attempt'] = $_SESSION['attempt'] + 1;
			   if (isset($_SESSION['attempt']) >= 3) {

			       // Grab Password Hint
                               $query = "SELECT passwordHint
	   			         FROM users
                                         WHERE username=".
				         "'".strtolower($_POST["username"])."'";
	                       $result = mysql_query($query);   
	                       $row = mysql_fetch_array($result, MYSQL_BOTH);
                               
			       $hint = $row['passwordHint'];
			       if ($hint == NULL) {
                                 $hint = "You did not enter a password hint.";
                               }

			       redirect('login.php?error=<p>Invalid Password!</p><p>Your hint was: "'.$hint.'"</p>&url='.$url);
                           }
			}
			else
			   $_SESSION['attempt'] = 1;

			redirect('login.php?error=<p>Invalid Password!</p>&url='.$url);
		}
		
		else {
		
			// Attach successful ID to $session
			$_SESSION['user']=$row["username"];
			redirect($url);
			
		}
?>
