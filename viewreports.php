<?php
	include_once('connection.php');
   include_once('session.php');
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>SnapReport &mdash; </title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Template by FREEHTML5.CO" />
	<meta name="keywords" content="free html5, free template, free bootstrap, html5, css3, mobile first, responsive" />
	<meta name="author" content="FREEHTML5.CO" />

  <!-- 
	//////////////////////////////////////////////////////

	FREE HTML5 TEMPLATE 
	DESIGNED & DEVELOPED by FREEHTML5.CO
		
	Website: 		http://freehtml5.co/
	Email: 			info@freehtml5.co
	Twitter: 		http://twitter.com/fh5co
	Facebook: 		https://www.facebook.com/fh5co

	//////////////////////////////////////////////////////
	 -->

  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="shortcut icon" href="favicon.ico">

	<!-- <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'> -->
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="css2/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css2/icomoon.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css2/bootstrap.css">
	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css2/magnific-popup.css">
	<!-- Superfish -->
	<link rel="stylesheet" href="css2/superfish.css">

	<link rel="stylesheet" href="css2/style.css">	
	<!-- Bootswatch core CSS -->
    <link href="css/bootstrap5.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/justified-nav.css" rel="stylesheet">


	<!-- Modernizr JS -->
	<script src="js2/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->
	
		<center><img class =logo2 src="images/Logo2.png" alt="Mountain View"></center>
        <div class="register-panel text-center font-semibold"> <big><a href="profile.php">Home <span class="menu-icon"><i class="fa fa-angle-double-right fa-fw"></i></span></a></big> </div>
        <hr>
	</head>
	<body>
        <div id="fh5co-wrapper">
		<div id="fh5co-page">
		
			<div class="jumbotron">
			<h2>Reports<br><small>View all previously submitted reports</small></h2><br><br>

		<?php	
		
		$sql = "SELECT * FROM reports LEFT JOIN users on reports.userid = users.userid ORDER BY date DESC";
	    $result = mysqli_query($db,$sql);
		if (!$result) 
		{
			die("Database query failed" . mysqli_error($db));
		}
					
				
		if ($result->num_rows > 0) 
		{
			echo '<div class="container">';
    		// output data of each row
    		while($row = $result->fetch_assoc()) 
    		{
				echo '<div class="row text-center">';
				echo '<div class="col-md-4 col-sm-4"><div class="services animate-box">
					<span><div class="body"><img src="uploads/' . $row['photo'] . '" width="200px" height="200px"></div></i></span><p>' .
					 $row["name"] . '</p><i>' . 
					 $row["description"] . '<br>' .
					 $row["category"] . '<br>' .
					 $row["location"] . '<br>' .
					 $row["date"] . '<br>' .
					 $row["status"]  . '<br>' .
					 $row["fname"] . ' ' . $row["lname"] .'<br></i></div></div>';
				 if ($row = $result->fetch_assoc()){
					 echo '<div class="col-md-4 col-sm-4"><div class="services animate-box">
					<span><div class="body"><img src="uploads/' . $row['photo'] . '" width="200px" height="200px"></div></i></span><p>' .
					 $row["name"] . '</p><i>' . 
					 $row["description"] . '<br>' .
					 $row["category"] . '<br>' .
					 $row["location"] . '<br>' .
					 $row["date"] . '<br>' .
					 $row["status"]  . '<br>' .
					 $row["fname"] . ' ' . $row["lname"] .'<br></i></div></div>';
					 if ($row = $result->fetch_assoc()){
						 echo '<div class="col-md-4 col-sm-4"><div class="services animate-box">
						<span><div class="body"><img src="uploads/' . $row['photo'] . '" width="200px" height="200px"></div></i></span><p>' .
						 $row["name"] . '</p><i>' . 
						 $row["description"] . '<br>' .
						 $row["category"] . '<br>' .
						 $row["location"] . '<br>' .
						 $row["date"] . '<br>' .
						 $row["status"]  . '<br>' .
						 $row["fname"] . ' ' . $row["lname"] .'<br></i></div></div>';
					 }
				 }
				 echo '</div>';
    		}
    		echo "</div>";
		} 
		else 
		{
    		echo "0 results";
		}
		?>
		</div></div></div>

		<!-- fh5co-content-section -->


	
		<!-- fh5co-blog-section -->


	<!-- END fh5co-wrapper -->

	<!-- jQuery -->


	<script src="js2/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js2/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js2/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js2/jquery.waypoints.min.js"></script>
	<!-- Stellar -->
	<script src="js2/jquery.stellar.min.js"></script>
	<!-- Superfish -->
	<script src="js2/hoverIntent.js"></script>
	<script src="js2/superfish.js"></script>
	<!-- Magnific Popup -->
	<script src="js2/jquery.magnific-popup.min.js"></script>
	<script src="js2/magnific-popup-options.js"></script>

	<!-- Main JS -->
	<script src="js2/main.js"></script>
	<script src="js2/image.js"></script>

	</body>
</html>

<?php
	//Close connection
	mysqli_close($db);
?>