<?php
	
	include "connect.php";
	include "imageresize.php";
	
	$connection = connect($db_host, $db_user, $db_pass, $db_name);
	
	$id   = $_GET['id'];
	$user = $_GET['user'];
		
	if(isset($id) && is_numeric($id) && isset($user)) {
		
		$query = "SELECT img
				  FROM ".$user."_posts
				  WHERE id='$id' ";
	
		if(!mysql_query($query)) 
			echo "Error: " . mysql_error();
			
		$result = mysql_query($query)
			or die(mysql_error());   
		
	    mysql_close($connection);
		
		$row = mysql_fetch_array($result);
	    
	    $image = $row['img'];
	    
	 	$image = imageresize($image, 75, 75);
	    	
		$img_type = "image/jpeg";	
		header('Content-type: ' . $img_type); // 'image/jpeg' for JPEG images
	   
	    //echo $image;
	    imagejpeg($image, null, 80);		
	    
	    echo "ass";
	}
	
	else {
		 echo 'Needs ID and User to work!';
	}

?>
