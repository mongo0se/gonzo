<?php   session_start(); 
	
	/* Show individual post
	 * Show author delete button
	 * Show comments
	 */

	include 'connect.php';
	include 'userbar.php';
	include 'aboutbar.php';

	
	$usershow = $_GET["usershow"];
	$id = $_GET["id"];
	
	$user = $_SESSION['user'];
?>
<html>
<head>
	<title>GONZO
	<?php echo " : " . $usershow; ?>
	
	</title>
	<link rel="stylesheet" type="text/css" href="gonzo.css" />
</head>
<body>
<div id="container">
<!--- Top Header Bar --->
<center><a href="index.php">
<div id="title">GONZO</div></a>
<div id="subtitle">
<?php echo "<a href=\"show_account.php?usershow=$usershow\">$usershow</a>"; ?>
</div>
</center>
<!--- User Bar --->
<?php echoUserbar(); ?>
<!--- Show Post --->

<div id="post">
<?php

	$connection = connect($db_host, $db_user, $db_pass, $db_name);
	
    $query = "SELECT * FROM "
             .$usershow."_posts
               WHERE id=".$id;
             
	if(!mysql_query($query)) echo "Error: " . mysql_error();
	
	$result = mysql_query($query) or die(mysql_error());   
		
	while($row = mysql_fetch_array($result)) {
		
			$dtg = $row['date_time_created'];		
			$text = $row['text'];
			$title = $row['title'];
			
			// Title
			echo "<p>".$title."</p>";
		
			// Date Time
			echo "<p><a href=\"show_post.php?usershow=$usershow&id=$id\">
				  <i>".$dtg."</i></a></p>";
				  
		    // Attached Img
		    $imgsrc = "showPostHeader.php? 
		               user=".$usershow."&
		               id=".$id;
		    // Attached Img Link
		    $imglnk = "showPostImg.php? 
		               user=".$usershow."&
		               id=".$id;
		              
		    echo "<p id='imgheader'><a href=\"$imglnk\">
		          <img src=\"$imgsrc\">
		          </a></p>";
			
			// Text Body
			echo "<p>".$text."</p>";
			
			// Delete Button
			if ($usershow == $user) 
				echo "<p><a href=\"delete_post.php?id=$id\">Delete Post</a></p>";
	}

?>

</div>
<!--- Comment Box --->
<?php 

	if(isset($_SESSION['user'])) {
		 
    echo "<form action=\"comment.php\" method=\"post\">
	<table>
	<tr>
	<td><input type=\"text\" name=\"comment\" /></td>
	<td><input type=\"submit\" value=\"comment\" />
	
	<input type='hidden' name='usershow' value='".$usershow."' />
	<input type='hidden' name='id' value='".$id."' />
	</td>
	</tr>
	</table>
	</form>";
	
	} 
	else { 
		echo "<p>You must be logged in to post comments.</p>";
	}
?>
<A NAME="comments">
<?php

	$query = "SELECT * FROM "
			.$usershow."_postcomments_".$id."
			ORDER BY id DESC";
	
	$result = mysql_query($query) or die(mysql_error());  
	
	while ($row = mysql_fetch_array($result)) { 
		
		echo "<table id=\"comment\">
		      <tr>
		      
		      <td>
		      <b>
		     ".$row['username']."
		      </b><br />"
		       .$row['date_time_created']."
		      </td>
		      
		      <td><p>".$row['text']."</p></td></tr>";
		      
		if($_SESSION['user'] == $usershow) {
			if($_SESSION['user'] == $row['username']) {
				$commentid = $row['id'];
				echo "<tr><td><a href=\"delete_comment.php?postid=".$id."&commentid=".$commentid."\">
					delete</a></td></tr>";
			}
			else {
				$commentid = $row['id'];
				echo "<tr><td id=\"other\"><a href=\"delete_comment.php?postid=".$id."&commentid=".$commentid."\">
					delete</a></td></tr>";
			}
		}   
		      
		
		      
		echo "</tr>";      
		echo "</table><br />";
  
	}
	
	mysql_close($connection);

?>
<?php echo aboutBar(); ?>
</div>
</body>
</html>

