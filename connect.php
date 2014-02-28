<?php

	/* Connect to DB
	*/

	$db_host = '#';
	$db_user = '#';
	$db_pass = '#';
	$db_name = '#';
	
	function connect($db_host, $db_user, $db_pass, $db_name) {
		$con = mysql_connect($db_host,$db_user,$db_pass);
		if (!$con) die('Could not connect: ' . mysql_error());
			mysql_select_db($db_name, $con);
		return $con;
	}
		
		

?>
