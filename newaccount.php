<?php session_start();  ?>
<html>
	
<head>
	<title>GONZO</title>
	<link rel="stylesheet" type="text/css" href="gonzo.css" />
</head>

<?php
    include 'connect.php';
    include 'aboutbar.php';
    include 'simple-php-captcha.php';
	
    if (isset($_GET['url']))
	    $url = $_SESSION['last_url'];
    else
	    $url = $_SERVER['HTTP_REFERER'];

    $_SESSION = array();
    $_SESSION['captcha'] = captcha();
?>

<body>
<div id="container">
<!--- Top Header Bar --->
<center><a href="index.php">
<div id="title">
New Account</div></a>
</center>
<!--- User Bar --->
<div id="userbar"> 
<a href="<?php echo $url; ?>"> Cancel</a>
</div>
<!--- Error --->
<?php
	     echo "<p>".$_GET['error']."</p>";
	 
?>
<p>Enter new account details into the form below.</p>
<!-- Entry Form --> 
<form action="validate_newaccount.php" method="post">
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
 <td>Confirm Password</td>
 <td><input type="password" name="password_chk" /></td>
 </tr>

 <td>Password Hint</td>
 <td><input type="text" name="passwordHint" value="[OPTIONAL]"/></td>
 </tr>
 <tr>
 <td>Email Address</td>
 <td><input type="text" name="email" value="[OPTIONAL]"/></td>
 </tr>

 </table>
 
 <td>Captcha</td>
 
 <tr><td></td><td>
 <?php
        echo '<img src="' . $_SESSION['captcha']   ['image_src'] . '" alt="CAPTCHA" />';

 ?>
 <p>Please note that Captcha Code is case sensitive!</p>
 </tr></td>
 
 <tr><td></td>
 <td><input type="text" name="captchacode" /></td>
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
	
