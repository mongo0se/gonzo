<?php

     /* about.php
      * 14-12-12
      * Define the bottom bar
      */
      
      function aboutbar() {
		  
		  $year = date('Y');
      
	      echo "<div id='aboutbar'><p>
				
				<a href='http://clintveasey.co.uk'>clintveasey.co.uk</a>
				
				| <a href='about.php'>About</a>
				
				| GONZO Script v1.0 (Clint Veasey ".$year.")
				
				</p></div>";
          }

?>
