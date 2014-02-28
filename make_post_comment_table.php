<?php

	function make_post_comment_table($user, $con) {

				$lastid = mysql_insert_id($con);
			
				// Create post table
				$query = "CREATE TABLE ".$user."_postcomments_".$lastid."
						
						(
						id INT NOT NULL AUTO_INCREMENT,
						PRIMARY KEY(id),
						date_time_created DATETIME DEFAULT NULL,
						username VARCHAR(16),
						text VARCHAR(250)
						)";
                  
				if (!mysql_query($query,$con)) {
					echo "Error: " . mysql_error();
					return FALSE;
				}
				
			return TRUE;
	}

?>
