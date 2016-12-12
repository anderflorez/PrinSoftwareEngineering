<?php
	include_once('connection.php');
   include_once('session.php');
?>
<html">
   
   <head>
      <title>Welcome </title>
   </head>
   
   <body>
      <h1>Welcome <?php echo $_SESSION['fname']; ?></h1> 
      <h2><a href = "logout.php">Sign Out</a></h2>
	  <h2><a href = "newreport.php">Submit New Report</a></h2>
   </body>
   
</html>

<?php
	//Close connection
	mysqli_close($db);
?>