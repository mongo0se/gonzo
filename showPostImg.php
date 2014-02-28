<?php
	
	include "connect.php";
	
	// ==============================================================
	// SHOW POST IMAGE
	// ~~~~~~~~~~~~~~~
	// Returns img stored as BLOB from USER post table.
	// 11-12-12
	// ==============================================================
	
	$connection = connect($db_host, $db_user, $db_pass, $db_name);
	
	// Get which user from URL
	$id   = $_GET['id'];
	$user = $_GET['user'];
		
	$query = "SELECT img
			  FROM ".$user."_posts
			  WHERE id = '$id' ";
	
	$result = mysql_query($query)
		or die(mysql_error());   
	
    	mysql_close($connection);
	
	while ($row = mysql_fetch_array($result)) { 
		header("Content-type: image/gif"); // or whatever 
        	echo $row['img'];   
	}
	

?>
