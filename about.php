<?php
	session_start();

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

<p><b>Publish yourself, and your friends.</b></p>

<p>The Gonzo script allows you and your friends to publish blog posts,
articles, rants, rambles and upload photos.</p>

<p><b>Easy to Install</b></p>

<p>Simply extract the files into the "www" working directory of your
LAMP / WAMP and go! Even a monkey could do it.</p>

<p>All you need to do beforehand, is edit the <b>CONFIG.php</b> to
configure the script to use your own personal MySQL logon details.</p>

<p><b>Add your own twist.</b></p>

<p>Initially you can drop any images you like into the "header_imgs"
directory. Every page header will be made up of a randomly selected
image. </p>

<p>Your users can upload there own profile images as well. This enables
them to customise their button from the index page as well as add a bit
of personality to their personal page!</p>

<p>More geeky users of this script will be able to change the look and
feel of the script by editing the "gonzo.css" file.</p>

<p><b>Legal Stuff</b></p>

<p>The Captcha script: Copyright 2011 by Cory LaViska for A Beautiful Site, LLC.</p>

<p>This script can be used anyway you want, it is free to be modified and
expanded upon. All I ask is that credit is granted where credit is due,
and to keep me in the loop if this script has been found useful.</p>

<p><b>Questions, Request</b><p>
	
<p>Please send them to <i>clint.veasey(at)gmail.com</i>.</p>

<?php echo aboutBar(); ?>
</div>
</body>
</html>

