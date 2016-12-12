<?php
	include_once('connection.php');
	include_once('session.php');

	if (isset($_SESSION)) {
		$login_user = $_SESSION['login_user'];
		$userid = $_SESSION['userid'];
		$email = $_SESSION['email'];
		$fname = $_SESSION['fname'];
		$pass = $_SESSION['pass'];
		$type = $_SESSION['type'];
	}
?>

<?php 
		if(isset($_POST['submitpic'])) {
			if(getimagesize($_FILES['changepic']['tmp_name']) == FALSE) {
				echo "Please select an image";
				print_r($_FILES['changepic']);
			}
			else {
				$image = addslashes($_FILES['changepic']['tmp_name']);
				$image = file_get_contents($image);
				$image = base64_encode($image);
				$sql = "UPDATE users SET pic='$image' WHERE userid='$userid'";
				$result = $db->query($sql);
				die("<script>location.href='editprofile.php'</script>");
				if (!$result) {
					die("Database query failed" . mysqli_error($db));
				}
			}
		}

		if (isset($_POST['submitemail']) && filter_var($_POST['changeemail'], FILTER_VALIDATE_EMAIL)) {
			$newemail = $_POST['changeemail'];
			$sql = "UPDATE users SET email='$newemail' WHERE userid='$userid'";
			$result = $db->query($sql);
			if (!$result) {
				die("Database query failed" . mysqli_error($db));
			}
		}

		if (isset($_POST['submitpass'])) {
			$currentpass = mysqli_real_escape_string($db, $_POST['currentpass']);
			$newpass = mysqli_real_escape_string($db, $_POST['newpass']);
			$retypepass = mysqli_real_escape_string($db, $_POST['retypepass']);
			if ($newpass === $retypepass) {
				$sql = "SELECT pass FROM users WHERE userid = '$userid'";
				$result = $db->query($sql);
				if ($result->num_rows == 0) {
					die("Database query failed" . mysqli_error($db));
				}
				else {
					$password = $result->fetch_assoc()['pass'];
					if (password_verify($currentpass, $password)) {
						$newpass = password_hash($newpass, PASSWORD_DEFAULT);
						$sql = "UPDATE users SET pass='$newpass' WHERE userid='$userid'";
						$resutl = $db->query($sql);
						if ($result->num_rows == 0) {
							die("Database query failed" . mysqli_error($db));
						}
					}
				}
				header("location: login.php");
			}
		}
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

	<!-- <link rel="stylesheet" type="text/css" href="css2/style.css"> -->
	<link rel="stylesheet" type="text/css" href="css2/editprofile_style.css">

	<!-- Modernizr JS -->
	<script src="js2/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->
<div class="log_out"> <a href="profile.php"><p style="text-align:right"><big>Home</big><span class="menu-icon"><i class="fa fa-angle-double-right fa-fw"></i></span></a> </div>
	</head>
	<body>
<center><img class =logo2 src="images/Logo2.png" alt="Mountain View"></center>
			<div class="jumbotron">
			<h2>Edit Profile<br><small>Please edit your profile information below</small></h2><br><br>
			<div class="container">    
				<div class="row">
				<!-- Form -->
					<div id="formParent" class="col-md-6 col-md-offset-3 well well-lg">

					<div class="form-group">
						<?php 
							$sql = "SELECT pic FROM users WHERE userid='$userid'";
							$result = $db->query($sql);
							if ($result->num_rows == 0) {
								die("Database query failed " . mysqli_error($db));
							}
							else {
								$row = mysqli_fetch_array($result);
								echo '<img id="userimg" src="data:image;base64,' . $row[0] . ' ">';
							}
						?>
					</div>
					<form class="form-horizontal" action="editprofile.php" method="post" enctype="multipart/form-data">




					<div class="form-group">
						<button id="btn_pic" class="btn btn-default ">Change Picture</button>
						<div id="feature_pic" class="features">
							<input type="file" name="changepic" id="changepic">
							<input type="submit" name="submitpic" id="submitpic" class="btn btn-default">
						</div>
					</div>

					<div class="form-group">
						<button id="btn_email" class="btn btn-default">Change E-mail</button>
						<div id="feature_email" class="features">
							<input type="email" name="changeemail" id="changeemail" 
								class="form-control" placeholder="E-mail">
							<input type="submit" name="submitemail" id="submitemail" class="btn btn-default">
						</div>	
					</div>


					<div class="form-group">
						<button id="btn_pass" class="btn btn-default">Change Password</button>
						<div id="feature_pass" class="features">
							<input type="password" name="currentpass" id="currentpass" 
								class="form-control" placeholder="Current Password">
							<input type="password" name="newpass" id="newpass" 
								class="form-control" placeholder="New Password">
							<input type="password" name="retypepass" id="retypepass" 
								class="form-control" placeholder="Re-type Password">
							<input type="submit" name="submitpass" id="submitpass" class="btn btn-default">
						</div>
					</div>

					<div class="form-group">
					<?php
						if ($type === "M") {
							echo "<a href='manageusers.php?back=http://localhost/test/snapreport/editprofile.php' class='btn btn-default'>Manage Users</a>";
						}
					?>						
					</div>









					<!-- <div class="form-group">
						<label class="col-sm-2 control-label" for="inputName">Event Name</label>
						<div class="col-sm-10">
							<input id="inputName" name="inputName" class="form-control" type="text" placeholder="Event Name" required autofocus>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="inputCat">Category</label>
						<div class="col-sm-10">
							<select id="inputCat" name="inputCat" class="form-control">
								<option value="Animals">Animals</option>
								<option value="Broken Equipment">Broken Equipment</option>
								<option value="Landscaping">Landscaping</option>
								<option value="Technical">Technical</option>
								<option value="Other">other</option>
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
						<label class="col-sm-2 control-label" for="description">Description</label>
						<div class="col-sm-10">
							<textarea class="form-control" id="description" name="description" placeholder="Please enter a brief description of the event, exact location, etc." required autofocus></textarea>
						</div>
					</div> -->
					</form>
					</div>















				</div>
			</div>
		</div>
 <div class="register-panel text-center font-semibold"> <big><a href="profile.php">Home <span class="menu-icon"><i class="fa fa-angle-double-right fa-fw"></i></span></a></big> </div>
            <hr>
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

	<script type="text/javascript" src="js/editprofile_script.js"></script>

	</body>
</html>

<?php
	//Close connection
	mysqli_close($db);
?>