<?php session_start(); ?>
<html>
 <head>
  <title>Upload Picture</title>
  <link rel="stylesheet" type="text/css" href="gonzo.css" />
 </head>
<body>
<div id="container">
<!--- Top Header Bar --->
<center><div id="title">Upload Picture</div></center>
<?php

	// uploadPic.php
	// 30th Nov 12

	include 'connect.php';
	include 'redirect.php';
	include 'userbar.php';
	
	$con = connect($db_host, $db_user, $db_pass, $db_name);
	
	// --- USER BAR ---
	echoUserBar();

    // ----------------------------------------------------------
	// ----------------- VALIDATION -----------------------------

	$allowedExts = array("jpg", "jpeg", "gif", "png");
	$extension = end(explode(".", $_FILES["file"]["name"]));
	
	if ((($_FILES["file"]["type"] == "image/gif")
	|| ($_FILES["file"]["type"] == "image/jpeg")
	|| ($_FILES["file"]["type"] == "image/png")
	|| ($_FILES["file"]["type"] == "image/pjpeg"))
	&& ($_FILES["file"]["size"] < 20000)
	&& in_array($extension, $allowedExts)) {

  	    if ($_FILES["file"]["error"] > 0) {
   		echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
            }

            else {

                echo "Upload: " . $_FILES["file"]["name"] . "<br>";
                echo "Type: " . $_FILES["file"]["type"] . "<br>";
                echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
                echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

                // -----------------------------------------------------
                // -------------- UPLOAD IMG TO DB ---------------------
                
                // Create table if NOT exists
                
                $query = "CREATE TABLE IF NOT EXISTS userProfileImgs
                          (
							  id int(11) NOT NULL auto_increment,
							  PRIMARY KEY (id),
							  
                              user VARCHAR(16),
                              img  LONGBLOB
                           )";
                           
                 mysql_query($query, $con);
                 echo "Creating table if not already created.<br />";
                 
                 // Insert IMG into TABLE
                 $user = $_SESSION['user'];
                 
                 $blob = file_get_contents($_FILES["file"]["tmp_name"]);
				 $bdata = addslashes($blob);
                 
                 $query = "INSERT INTO userProfileImgs
                           (user, img)
						   VALUES
						   ('{$user}','{$bdata}')";
				 
				 if (!mysql_query($query, $con)) {
					 
					 echo "Failed to insert image " . 
					       $_FILES["file"]["tmp_name"] . 
					       "into Database!<br />";
	       
				  } else {
					  
					  echo "File uploaded OK. <br />";
					  
				  }               
                              
             }
        }
        
        else {
            echo "Invalid file";
        }

?>
