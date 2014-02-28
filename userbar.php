<?php
/* userbar.php
   ~~~~~~~~~~~
   Defines the look and operation of the user account bar.
   
   28th Nov 12     */

   function echoUserbar() {

   echo "<div id=\"userbar\">";                   // Set appearance with CSS

	   echo "<a href=\"index.php\">index</a>";  // MAIN	
   
	   if(isset($_SESSION['user'])) {                 // If user is currently logged onto an account:
		
	        $user = $_SESSION['user'];
	        echo "<a href=\"show_account.php?usershow=$user\">Logged in as $user</a>";       
		echo "<a href=\"accountSettings.php\">settings</a>";  // SETTINGS
	        echo "<a href=\"logout.php\">logout</a>";             // LOGOUT
  
	   } else {
			 
	        echo "<a href=\"login.php\">login</a>";
		echo "<a href=\"newaccount.php\">new account</a>";    // LOGIN 
	 
	   } 
	
	   echo "</div>";
	   return 0;
   }

?>
