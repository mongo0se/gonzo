<?php session_start(); ?>
<html>
	
<head>
	<title>GONZO</title>
	<link rel="stylesheet" type="text/css" href="gonzo.css" />
</head>

<?php
    include 'connect.php';
    include 'redirect.php';
	include 'aboutbar.php'; 

    // This will boot user back to index if they are not part of a logical session.
    
    if (isset($_SESSION['user']))
	$user = $_SESSION['user'];
    else
	redirect('index.php');
    	
    if (isset($_GET['url']))
	$url = $_SESSION['last_url'];
    else
	$url = $_SERVER['HTTP_REFERER'];

    
?>

<body>
<div id="container">
<!--- Top Header Bar --->
<center><a href="index.php">
<div id="title">
CHANGE PASSWORD</div>
</center>
<!--- User Bar --->
<div id="userbar"> 
<a href="accountSettings.php">Cancel</a>
</div>
<!--- Error --->
<?php
	     echo "<p>".$_GET['error']."</p>";
	     echo "Changing password for account: ". $user;
	 
?>
<!-- Entry Form --> 
<form action="changePassword.php" method="post">
<table>
 <tr>
 <td>Old Password</td>
 <td><input type="password" name="oldPassword" /></td>
 </tr>
 <tr>
 <td>New Password</td>
 <td><input type="password" name="newPassword1" /></td>
 </tr>
 <tr>
 <td>Confirm New Password</td>
 <td><input type="password" name="newPassword2" /></td>
 </tr>

 <td>Password Hint</td>
 <td><input type="text" name="passwordHint" value="[OPTIONAL]"/></td>
 </tr>

 
 <tr><td></td>
 <td><input type="hidden" name="url" value="<?php echo $url; ?>" />
	 <input type="submit" value="submit details" /></td>
 </tr>
</table>


</form>

<?php echo aboutBar(); ?>
</div></body>
</html>	
	
