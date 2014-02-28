<?php session_start();  ?>
<html>
 <head>
  <title>Upload Picture</title>
  <link rel="stylesheet" type="text/css" href="gonzo.css" />
 </head>
<body>
<div id="container">
<!--- Top Header Bar --->
<center><a href="index.php">
<div id="title">Upload Picture</div></center>
<?php
   // uploadPictureForm.php
   // -------------------
   // 30th Nov 12           

   include 'connect.php';
   include 'userbar.php';
   include 'aboutbar.php';

   $usershow = $_GET["usershow"];
   $id = $_GET["id"];	
   $user = $_SESSION['user'];
   
   echoUserbar();
?>

   <p>Please choose your image file. This will be used as your banner, and your button from the
      main page!</p>
   <!--- UPLOAD FORM --->
   <form action="uploadPic.php" method="post"
   enctype="multipart/form-data">
   <label for="file">Filename:</label>
   <input type="file" name="file" id="file"><br>
   <input type="submit" name="submit" value="Submit">
   </form>

<?php echo aboutBar(); ?>
</div>
</body>
</html>
