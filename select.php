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
			<div class="container">
				<div class="row text-center">
				
					<div class="">
						<div class="services animate-box">
							<span><i href="createpost.php" class="icon-tools"></i></span>
							<a href="myreports.php">My Reports</a>
							<p>View your previously submitted reports</p>
						</div>
					
					
						<div class="services animate-box">
							<span><i class="icon-tools"></i></span>
						<a href="myevents.php">My Events</a>
							<p>View your previously submitted events</p>
						</div>
					</div>
				</div>
			</div>
		</hr>

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