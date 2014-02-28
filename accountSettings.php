<?php  session_start(); ?>
<html>
 <head>
  <title>Account Settings</title>
  <link rel="stylesheet" type="text/css" href="gonzo.css" />
 </head>
<body>
<div id="container">
<!--- Top Header Bar --->
<center><a href="index.php">
<div id="title">Account Settings</div></center></a>
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
   <!--- CHANGE PASSWORD --->
   <p>
   <a class="button" href="changePasswordForm.php">Change Password</a>
   - Change your password.
   </p>

   <!--- DELETE ACCOUNT --->
   <p>
   <a class="button" href="deleteAccountSure.php">Delete Account</a>
   - Delete your entire account. Forever.
   </p>

   <!--- UPLOAD PROFILE PICTURE --->
   <p>
   <a class="button" href="uploadPicForm.php">Upload Profile Picture</a>
   - Express yourself with a profile picture
   </p>
   
   <!--- REMOVE PROFILE PICTURE --->
   <p>
   <a class="button" href="deletePic.php">Remove Profile Picture</a>
   - Remove your profile image!
   </p>

<?php echo aboutBar(); ?>
</div></body>
</html>
