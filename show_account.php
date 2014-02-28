<?php   session_start(); 
	include 'connect.php';
	include 'aboutbar.php';
	include 'userbar.php';

	$user = $_SESSION['user'];
	$usershow = $_GET["usershow"];
	
	if (!isset($_GET['startrow']) or !is_numeric($_GET['startrow'])) 
		$startrow = 0;
	else 
		$startrow = $_GET['startrow'];
?>
<html>
<head>
	
	<title>
	<?php echo $title . " : " . $usershow; ?>
	</title>
	
	<link rel="stylesheet" type="text/css" href="gonzo.css" />
	
</head>
<body>
<?php echo "<div id=\"container\" 
            style=\"
                background-image:url('showProfileImg.php?user=$usershow');
                background-repeat:no-repeat;
				background-attachment:fixed;
				background-position:center; 
                
            \">";
?>
<!--- Top Header Bar --->
<center><a href="index.php">
<div id="title">
<?php

  echo "
		<a href=\"show_account.php?usershow=$usershow\">
		$usershow</a>
        "; 

?>

</div>
</center>
<!--- User Bar --->
<?php echoUserbar(); ?>
<!--- Show Post Form Link --->

<?php
	if ($usershow == $user) 
		echo '<a href="post_form.php" class="button">New Entry</a>';
		
?>

<!--- Newer Posts -->
<?php
	if ($startrow >= 10) {
		
		// startrow is set
		if ($startrow < 10) $startrowlink = 0;
		else $startrowlink = $startrow - 10;
		
		echo "<center><p>";
		echo "<a href=\"show_account.php?usershow=$usershow&startrow=$startrowlink\">Newer Posts</a>";
		echo "</center></p>";
	}
?>
<!--- Show Posts -->

<?php

	$connection = connect($db_host, $db_user, $db_pass, $db_name);
	
    $query = "SELECT * FROM "
             .$usershow."_posts
             ORDER BY id DESC
             LIMIT ".$startrow. ", 10";
                          
	if(!mysql_query($query)) echo "Error: " . mysql_error();
	
	$result = mysql_query($query) or die(mysql_error());   
	$postno = mysql_num_rows($result);
	
	if ($postno < 1)
		echo "<p align=center>User $usershow has not written anything, yet.</p>";
	
	while ($row = mysql_fetch_array($result)) {
		
		$dtg = $row['date_time_created'];		
		$id = $row['id'];
		$text = $row['text'];
		$title = $row['title'];
		$img = $row['img'];
		

		echo '<div id="post">';
		
		//echo "<table><tr><td>";						// Positioning
		
		echo "<a href=\"show_post.php?usershow=$usershow&id=$id\">";
			 
		
		// Show Thumbnail
		if ($img != NULL) {
			
			echo "<table><tr><td>";	
		
		    $imgSrc = "showThumb.php?
		               user=".$usershow."&
		               id=".$id;
		    echo "<p>
		          <img id='thumbnail' src='$imgSrc'>
		          </p></a>"; 
	    }
	    
		echo "<td/><td>";							// Positioning
			  
	    // Title
		echo "<p id='postitle'>".$title."
		      </p>";

		// Date Time
		echo "<p class='postdtg'> <i>".$dtg."</i></p>";
	          
	    echo "</td></tr></table></a>";					// Positioning
			
		// Text Body
		echo "<p>".$text."</p>";

		// Comments
		echo "<a href=\"show_post.php?usershow=$usershow&id=$id#comments\">";
		$query = "SELECT id FROM ".$usershow."_postcomments_".$id;
		$result2 = mysql_query($query);
		$commentno = mysql_num_rows($result2);
		if ($commentno > 1) echo "<p id=\"commentcount\">".$commentno." Comments</p>";
		if ($commentno == 1) echo "<p id=\"commentcount\">".$commentno." Comment</p>";
		echo "</a>";	

		echo '</div>';
	}
		
	mysql_close($connection);

?>

<!--- Older Posts -->
<?php
	if ($postno >= 10) {
		
		// startrow is set
		$startrowlink = $startrow + 10;
		
		echo "<center><p>";
		echo "<a href=\"show_account.php?usershow=$usershow&startrow=$startrowlink\">Older Posts</a>";
		echo "</center></p>";
	}
?>
<?php echo aboutBar(); ?>
</div>
</body>
</html>

