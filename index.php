<?php	
	session_start();
	
	include 'CONFIG.php';
	include 'connect.php';
	include 'userbar.php';
	include 'aboutbar.php';
	include 'install.php';

	if(isset($_SESSION['usershow']))
		unset($_SESSION['usershow']);
		
	if (!isset($_GET['startrow']) or !is_numeric($_GET['startrow'])) 
		$startrow = 0;
	else 
		$startrow = $_GET['startrow'];
?>
<html>
<head>
	<title><? echo $title; ?></title>
	<link rel="stylesheet" type="text/css" href="gonzo.css" />
	<link rel="shortcut icon" href="fist.ico" />
</head>

<body>
<div id="container">
<!--- Top Header Bar -->
<div id="title"><? echo $title; ?></div>
<!--- User Bar -->
<?php echoUserbar(); ?>

<p>Gonzo is a free simple service designed to allow the user to publish
there own thoughts and ideas.</p>
<p>Current users: </p>

<!--- Show Accounts -->
<?php

	$connection = connect($db_host, $db_user, $db_pass, $db_name);
	
	// Link to more before
	if ($startrow > 9) {	
		// startrow is set
		if ($startrow < 10) $startrowlink = 0;
		else $startrowlink = $startrow - 10;
		echo "<a href=\"index.php?usershow=$usershow&startrow=$startrowlink\"> << </a>";
	}
	
    $query = "SELECT username FROM users
			  LIMIT ".$startrow.", 100";
			  
	if(!mysql_query($query)) {
		echo "Error: " . mysql_error();
		install($connection, $db_name,
				$max_username, $max_password);
	}
	
	$result = mysql_query($query) or die(mysql_error());
	$userno = mysql_num_rows($result);
	
	// ECHO LINKS TO USER BLOGS
	while ($row = mysql_fetch_array($result)) {
		$username = $row['username'];
		
	    echo '<a class="ubutton"
	    style="background-image:url(\'showProfileImg.php?user='.$username.'\')"
	    href="show_account.php?usershow=' . $username . '">'.
	    $username.'</a> ';

	}
	
	// Link to more 
	if ($userno > 99) {
		// startrow is set
		$startrowlink = $startrow + 10;
		echo "<a href=\"index.php?usershow=$usershow&startrow=$startrowlink\">
		>> </a>";
	}
	
	echo aboutbar();
	
	mysql_close($connection);
?>

</div>
</body>
</html>

