<?php

	/* Install user index table
	*/

	//include 'connect.php';
	
	function install($connection, $db_name,
	                 $max_username, $max_password) {
		
		echo "<p>Setting up Database...</p>";
		
		/* Create Database */
	
		echo "Installing Database ". $db_name . "<br />";
	
		$query = "CREATE DATABASE
			  IF NOT EXISTS
			  ".$db_name;
	
		if(!mysql_query($query)) echo "Error: " . mysql_error();
	
		/* Create User Index Table */
	
		echo "Installing user table <Br />";
		mysql_select_db($db_name);
	
		$query = "CREATE TABLE 
	                  
	                  users
	                  (
	                  id INT NOT NULL AUTO_INCREMENT,
	                  PRIMARY KEY(id),
	
				      username VARCHAR(".$max_username."),
			              password VARCHAR(".$max_password."),
	                          
				      passwordHint VARCHAR(255),
				      email VARCHAR(255)
	                  )";
	
	          if(!mysql_query($query)) echo "Error: " . mysql_error();
	
	          /* End */
	          mysql_close($connection);
		  }
	          
	          
	?>
	
