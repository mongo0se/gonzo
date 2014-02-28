<?php session_start();  ?>
<html>
 <head>
  <title>Account Settings</title>
  <link rel="stylesheet" type="text/css" href="gonzo.css" />
 </head>
<body>
<div id="container">
<!--- Top Header Bar --->
<center><a href="index.php">
<div id="title">Account Settings</div></center>
<?php
/* accountSettings.php
   -------------------

   This console allows users to modify basic accounts settings, and remove their profile/account
   entirely.

   28th Nov 12  */

   include 'connect.php';
   include 'userbar.php';

   $user = $_SESSION['user'];
   
   echoUserbar();
?>

   <p>
   PASSWORD SUCCESSFULLY CHANGED!
   </p>


</div></body>
</html>
