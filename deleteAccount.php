<?php   session_start(); 

	/* deleteAccount.php
           -----------------

        This script deletes account for the user, then logs out the sessions after cleaning up.

        */

	include 'redirect.php';
	include 'connect.php';

        $usershow = $_GET["usershow"];
        $id = $_GET["id"];	
        $user = $_SESSION['user'];
	// $user = $_GET['username'];

	// CONNECT
	$con = connect($db_host, $db_user, $db_pass, $db_name);
	
	// Delete all comment tables
	$query = "SELECT id FROM ".$user."_posts";
 	$result = mysql_query($query) or die(mysql_error());   
	
	$post_id_list = array();
	while ($row = mysql_fetch_array($result)) {
			array_push($post_id_list, $row['id']);	
	}
	foreach($post_id_list as &$id) {
		$query = "DROP TABLE ".$user."_postcomments_".$id;
		mysql_query($query, $con) or die('Error: ' . mysql_error() . "<br />" . $query);
	}
	
	// Delete all posts
	$query = "DROP TABLE ".$user."_posts";
 	$result = mysql_query($query, $con) or die('Error: ' . mysql_error() . "<br />" . $query);
	
	// Delete User Profile Data from User Index
	$query = "DELETE FROM users
	          WHERE username='".$user."'";
 	$result = mysql_query($query, $con) or die('Error: ' . mysql_error() . "<br />" . $query);
	 
	// Delete User's Profile IMG
	$query = "DELETE FROM userProfileImgs
	          WHERE user='".$user."'";
	$result = mysql_query($query, $con) or die('Error: ' . mysql_error() . "<br />" . $query);

	
	mysql_close($con);

        session_start(); 
	session_destroy();

        redirect('index.php');
?>
