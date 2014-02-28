<?php   session_start(); 
	include 'connect.php';
	include 'aboutbar.php';
	
?>
<html>
	
<head>
	<title>GONZO</title>
	<link rel="stylesheet" type="text/css" href="gonzo.css" />
</head>
<body>
<div id="container">
<!--- Top Header Bar --->
<center>
<div id="title">
Login</div>
</center>
<!--- Messages From Failed Attempts --->
<?php
		 include 'redirect.php';

		 if (isset($_GET['url']))
			$url = $_SESSION['last_url'];
		 else
			$url = $_SERVER['HTTP_REFERER'];
?>
<!--- User Bar --->
<div id="userbar"><a href="<?php echo $url; ?>">Cancel</a></div>


<? echo $_GET['error']; ?>
<p>Please enter your login details below.</p>

<!-- Entry Form -->
<form action="validate_login.php" method="post">
<table>
 <tr>
 <td>Username</td>
 <td><input type="text" name="username" /></td>
 </tr>
 <tr>
 <td>Password</td>
 <td><input type="password" name="password" /></td>
 </tr>
 <tr>
 <td>
	 <input type="hidden" name="url" value="<?php echo $url; ?>" />
	 <input type="submit" value="login" /></td>
 </tr>
</table>

</form>
<?php echo aboutBar(); ?>	
</body>
</html>	
	
