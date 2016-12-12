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

	</head>
	<body>
			<center><img class =logo2 src="images/Logo2.png" alt="Mountain View"></center>
        	<div class="register-panel text-center font-semibold"> <big><a href="profile.php">Home <span class="menu-icon"><i class="fa fa-angle-double-right fa-fw"></i></span></a></big> </div>
        	<div class="jumbotron">
			<h2>Search<br><small>Search all reports and events</small></h2>
			<div class="container">    
				<div class="row">
				<!-- Form -->
					<div id="formParent" class="col-md-6 col-md-offset-3 well well-lg">
					<form class="form-horizontal" action="search.php" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label class="col-sm-2 control-label" for="inputName">Keyword</label>
						<div class="col-sm-10">
							<input id="inputName" name="inputName" class="form-control" type="text" placeholder="Enter a keyword here" required autofocus>
						</div>
					</div>
					<input class="btn btn-primary btn-sm" type="submit" name="submit" value="Submit">
					</form>
					</div>
		<?php
		if (isset($_POST["submit"])) {
			$numResults = 0;
			$search = "";
			
			$search = $_POST['inputName'];


			if(empty($search)){
				$errMSG = "Please enter a keyword";
			}
			// if no error occured, continue ....
			if(!isset($errMSG))
			{
				$sql = "SELECT * FROM users LEFT JOIN (SELECT userid, category, name, location, date, description, photo, status, votes FROM reports UNION SELECT userid, category, name, location, date, description, photo, Null as status, votes  FROM events) foo ON users.userid = foo.userid ORDER BY date DESC";
	    		$result = mysqli_query($db,$sql);
				if (!$result) 
				{
					die("Database query failed" . mysqli_error($db));
				}
					
				
				if ($result->num_rows > 0) 
				{
					echo '<div class="container"><div class="row text-center">';
    				// output data of each row
    				while($row = $result->fetch_assoc()) 
    				{
    				    if ((stripos($row["name"], $search) !== false) || (stripos($row["description"], $search) !== false) || (stripos($row["location"], $search) !== false) || (stripos($row["date"], $search) !== false) || (stripos($row["fname"], $search) !== false) || (stripos($row["lname"], $search) !== false))
    				    {
    				    	if ($row["name"] != NULL)
    	 					{
        						echo '<div class="col-md-4 col-sm-4"><div class="services animate-box">
								<span><div class="body"><img src="uploads/' . $row['photo'] . '" width="200px" height="200px"></div></i></span><p>' .
						 		$row["name"] . '</p><i>' . 
						 		$row["description"] . '<br>' .
						 		$row["category"] . '<br>' .
						 		$row["location"] . '<br>' .
						 		$row["date"] . '<br>' .
						 		$row["fname"] . ' ' . $row["lname"] .'<br></i></div></div>';
						 	
						 		$numResults = $numResults + 1;
						 	}
						}
    				}
    				
    				echo "</div><h2><small>" . $numResults . " Results Found</small></h2></div>";
				} 
				else 
				{
    				echo "0 results";
				}
				//die("<script>location.href='ThankyouReport.php'</script>");
			}
		}
		?>
				</div>
			</div>
		</div>

		<!-- END What we do -->
		

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