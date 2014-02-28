<?php
	
	include "connect.php";
	
	$connection = connect($db_host, $db_user, $db_pass, $db_name);
	
	// Get which user from URL
	$user = $_GET['user'];
		
	$query = "SELECT img
			  FROM userProfileImgs
			  WHERE user = '$user' ";
	
	$result = mysql_query($query)
		or die(mysql_error());   
	
    mysql_close($connection);
	
	while ($row = mysql_fetch_array($result)) { 
		header("Content-type: image/gif"); // or whatever 
        echo $row['img'];   
	}
	

?>
