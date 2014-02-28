<?php session_start(); ?>
<html>
 <head>
  <title>Account Settings - Delete Account</title>
  <link rel="stylesheet" type="text/css" href="gonzo.css" />
 </head>
<body>
<div id="container">
<!--- Top Header Bar --->
<center><a href="index.php">
<div id="title">GONZO</div></a>
<div id="subtitle">
Account Settings - Deleting Your Account
</div>
</center>

<?php
/* accountSettings.php
   -------------------

   This console allows users to modify basic accounts settings, and remove their profile/account
   entirely.

   28th Nov 12  */

   include 'connect.php';
   include 'userbar.php';
   include 'aboutbar.php';

   $usershow = $_GET["usershow"];
   $id = $_GET["id"];	
   $user = $_SESSION['user'];
   
   echoUserbar();
?>

   <!--- Sure? --->

   <center>

   <p>Are you absolutely sure, you want to delete your Account?</p>   
     
   <p><img src="cry.jpg"></p>

   <p>
   <a class="button" href="deleteAccount.php">Yes! Delete my account right now!</a>
   <a class="button" href="accountSettings.php">No, I clicked the option for no logical reason. </a>
   </p>

   </center>

<?php echo aboutBar(); ?>
</div></body>
</html>
