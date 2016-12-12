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
        <hr>
			<div class="jumbotron">
			<h2>New Event<br><small>Please submit a new event below</small></h2><br><br>
			<div class="container">    
				<div class="row">
				<!-- Form -->
					<div id="formParent" class="col-md-6 col-md-offset-3 well well-lg">
					<form class="form-horizontal" action="createevent.php" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label class="col-sm-2 control-label" for="inputName">Event Name</label>
						<div class="col-sm-10">
							<input id="inputName" name="inputName" class="form-control" type="text" placeholder="Event Name" required autofocus>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="inputCat">Category</label>
						<div class="col-sm-10">
							<select id="inputCat" name="inputCat" class="form-control">
								<option value="Music">Music</option>
								<option value="Sports">Sports</option>
								<option value="Academic">Academic</option>
								<option value="Other">Other</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="inputLoc">Location</label>
						<div class="col-sm-10">
							<select id="inputLoc" name="inputLoc" class="form-control">
								<option value="Boca Raton">Boca Raton</option>
								<option value="Dania Beach">Dania Beach</option>
								<option value="Davie">Davie</option>
								<option value="Fort Lauderdale">Fort Lauderdale</option>
								<option value="Harbor Beach">Harbor Beach</option>
								<option value="Jupiter">Jupiter</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="inputDate">Date</label>
						<div class="col-sm-10">
							<input class="form-control" type="date" id="inputDate" name="inputDate" value=<?php echo date("Y-m-d"); ?>>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="description">Description</label>
						<div class="col-sm-10">
							<textarea class="form-control" id="description" name="description" placeholder="Please enter a brief description of the event, exact location, time, etc." required autofocus></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="sr-only control-label" for="image">Image</label>
						<img id="image" name="image" src="http://limopal.com.sg/images/photo_placeholder.png" width="50%">
						<div class="col-sm-10">
							<input type="file" id="upload" name="upload" accept="image/*">
						</div>
					</div>
					<input class="btn btn-primary btn-sm" type="submit" name="submit" value="Submit">
					<input type="reset" value="Reset Form" class="btn btn-default btn-sm" onclick=image.src="http://limopal.com.sg/images/photo_placeholder.png">
					</form>
					</div>
		<?php
		if (isset($_POST["submit"])) {
			$name = "";
			$category = "";
			$location = "";
			$description = "";
			$date = "";
			$imgFile = NULL;
			
			$name = mysqli_real_escape_string($db,$_POST['inputName']);
			$category = mysqli_real_escape_string($db,$_POST['inputCat']);
			$location = mysqli_real_escape_string($db,$_POST['inputLoc']);
			$description = mysqli_real_escape_string($db,$_POST['description']);
			$date = $_POST['inputDate'];

			$imgFile = $_FILES['upload']['name'];
			$tmp_dir = $_FILES['upload']['tmp_name'];
			$imgSize = $_FILES['upload']['size'];

			if(empty($name)){
				$errMSG = "Please enter a name";
			}
			else if(empty($description)){
				$errMSG = "Please enter a description";
			}
			else if(empty($imgFile)){
			echo "<br><div class='alert alert-danger'>
				<strong>Please choose an image!</strong>
				</div>"; die;
			}
			else
			{
			$upload_dir = 'uploads/'; // upload directory

			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension

			// valid image extensions
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions

			// rename uploading image
			$userpic = rand(1000,1000000).".".$imgExt;

			// allow valid image file formats
			if(in_array($imgExt, $valid_extensions)){   
			// Check file size '5MB'
			if($imgSize < 10000000)    {
			 move_uploaded_file($tmp_dir,$upload_dir.$userpic);
			}
			else{
			 echo "<br><div class='alert alert-danger'>
				<strong>Image must be less than 10MB!</strong>
				</div>"; die;
			}
			}
			else{
			echo "<br><div class='alert alert-danger'>
				<strong>Image must be .gif, .png, .jpeg, or .jpg!</strong>
				</div>"; die;
			}
			}
			// if no error occured, continue ....
			if(!isset($errMSG))
			{
				$sql = "INSERT INTO events (userid, category, name, location, date, description, photo)
					VALUES ('{$_SESSION['userid']}','{$category}','{$name}','{$location}','{$date}','{$description}','{$userpic}')";
				$result = mysqli_query($db,$sql);
				if (!$result) {
					die("Database query failed" . mysqli_error($db));
				}
				die("<script>location.href='ThankyouEvent.php'</script>");
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