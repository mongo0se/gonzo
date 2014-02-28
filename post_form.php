<?php   session_start();

	include 'connect.php';
	include 'redirect.php';
	include 'aboutbar.php';
	include 'userbar.php';
	
	$user = $_SESSION['user'];
?>
<html>
<head>
	<title>GONZO
	<?php echo " : " . $user; ?>
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
<!-- Entry Form -->
<form action="post.php" method="post" enctype="multipart/form-data">
<table>
	
 <tr><td>
 <p>Title</p>
 <textarea rows="1" cols = "70" name="title"></textarea>
 </td></tr>
	
 <tr><td>
 <p>Body</p>
 <textarea rows="10" cols="70" name="text"></textarea>
 </td></tr>
 
 <tr>
 <td>
   <input type="submit" value="publish" />
   <label for="file">Attach Image:</label>
   <input type="file" name="file" id="file"></td>
 </tr>
 </table>
</form>

<?php echo aboutBar(); ?>
</div>	
</body>
</html>	
	
