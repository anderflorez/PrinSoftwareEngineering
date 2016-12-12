<?php
	include_once('connection.php');
	include_once('session.php');

	if (isset($_SESSION)) {
		$login_user = $_SESSION['login_user'];
		$userid = $_SESSION['userid'];
		$email = $_SESSION['email'];
		$fname = $_SESSION['fname'];
		$type = $_SESSION['type'];
	}

	if($type !== "M") {
		header("location: editprofile.php");
	}

	$resultid = $searchresults = $searchq = $sql = $results = $output = $resultid = $uid = '';
	
	$resultid = 0;
	$searchresults = array();
	if (isset($_POST['submit'])) {
		$searchq = preg_replace("#[^0-9a-z]#i", " ", $_POST['search']);
		$sql = "SELECT userid, email, type, fname, lname 
				FROM users 
				WHERE fname 
				LIKE '%$searchq%' OR 
				lname LIKE '%$searchq%'";
		$results = $db->query($sql);
		if (mysqli_error($db)) {
			die("Database query failed" . mysqli_error($db));
		}
		else {
			$output = "";
			if ($results->num_rows == 0) {
				$output = "The search did not produced any results.";
			}
			else {
				
				while ($row = mysqli_fetch_assoc($results)) {
					$resultid++;
					$searchresults[$resultid] = array();
					$searchresults[$resultid]['id'] = $resultid;
					$searchresults[$resultid]['userid'] = $row['userid'];
					$searchresults[$resultid]['fname'] = $row['fname'];
					$searchresults[$resultid]['lname'] = $row['lname'];
					$searchresults[$resultid]['email'] = $row['email'];
					$searchresults[$resultid]['type'] = $row['type'];
				}
			}
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

    <link rel="stylesheet" type="text/css" href="css2/editprofile_style.css">


	<!-- Modernizr JS -->
	<script src="js2/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->
	<div class="log_out">
		<a href="profile.php">
			<p style="text-align:right"><big>Home</big>
				<span class="menu-icon">
					<i class="fa fa-angle-double-right fa-fw"></i>
				</span>
			</a>
		</div>
	</head>
	<body>
<center><img class =logo2 src="images/Logo2.png" alt="Mountain View"></center>
			<div class="jumbotron">
			<h2>Manage Users<br><small>Edit profile information for other users</small></h2><br><br>
			<div class="container">    
				<div class="row">
				<!-- Form -->
					<div id="formParent" class="col-md-6 col-md-offset-3 well well-lg">
					<form class="form-horizontal" action="manageusers.php" 
						method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label class="col-sm-2 control-label" for="search">Search</label>
							<div class="col-sm-10">
								<input id="search" name="search" class="form-control" type="text" 
									placeholder="Search" autofocus>
							</div>
							<input type="submit" name="submit" id="submit" class="btn btn-primary btn-sm">
						</div>

					<?php 
						if (isset($_GET['id']) || empty($_POST['search'])) { 
								echo '<table class="table hidden">';
							}
							else {
								echo '<table class="table visible-lg visible-md visible-sm visible-xs">';
							}
					?>

						<thead>
							<tr>
								<th>First Name</th>
								<th>Last Name</th>
								<th>E-mail</th>
								<th>User Type</th>
							</tr>
						</thead>
						<tbody>
						
					<?php 
						for ($i = 0; $i < $resultid; $i++) {
								echo '
									<tr>
										<td><a href="manageusers.php?id=' . $searchresults[$i+1]["userid"] . '">' . $searchresults[$i+1]["fname"] . '</a></td>
										<td><a href="manageusers.php?id=' . $searchresults[$i+1]["userid"] . '">' . $searchresults[$i+1]["lname"] . '</td>
										<td><a href="manageusers.php?id=' . $searchresults[$i+1]["userid"] . '">' . $searchresults[$i+1]["email"] . '</td>
										<td><a href="manageusers.php?id=' . $searchresults[$i+1]["userid"] . '">' . $searchresults[$i+1]["type"] . '</td>
									</tr>';
							}

						if (isset($_GET['id'])) {
							$uid = $_GET['id'];
							echo '<div class="visible-lg visible-md visible-sm visible-xs">';
						}
						else {
							echo '<div class="hidden">';
						}
						$sql = "SELECT email, type, fname, lname 
								FROM users 
								WHERE userid = '$uid'";
						$results = $db->query($sql);
						if (mysqli_error($db)) {
							die("Database query failed" . mysqli_error($db));
						}
						$row = mysqli_fetch_assoc($results);
						$edit_fname = $row['fname'];
						$edit_lname = $row['lname'];
						$edit_email = $row['email'];
						$edit_type = $row['type'];
						if ($edit_type == "M") {
							$edit_type = "Manager";
						}
						else if ($edit_type == "A") {
							$edit_type = "Administrator";
						}
						else {
							$edit_type = "Regular User";
						}

					?>

						<div class="form-group">
							<h3>Edit User</h3>
							<div>Name: <?php echo $edit_fname; ?></div>
							<div>Last Name: <?php echo $edit_lname; ?></div>
							<div>E-mail: <?php echo $edit_email; ?></div>
							<div>Type: <?php echo $edit_type; ?></div>
							
						</div>
						<div class="form-group">
							<button id="btn_pass" class="btn btn-default">Change Password</button>
							<div id="feature_pass" class="features">
								<input type="text" name="uid" class="hidden" value="<?php echo "$uid"; ?>">
								<input type="password" name="newpass" id="newpass" 
									class="form-control" placeholder="New Password">
								<input type="password" name="retypepass" id="retypepass" 
									class="form-control" placeholder="Re-type Password">
								<input type="submit" name="submitpass" id="submitpass" class="btn btn-default">
							</div>
						</div>
						<div class="form-group">
							<input type="text" name="uid" class="hidden" value="<?php echo "$uid"; ?>">
							<button id="manager" name="manager" class="btn btn-default">Add to Managers</button>
						</div>
						<div class="form-group">
							<input type="text" name="uid" class="hidden" value="<?php echo "$uid"; ?>">
							<button id="admin" name="admin" class="btn btn-default">Add to Administrators</button>
						</div>
						<div class="form-group">
							<input type="text" name="uid" class="hidden" value="<?php echo "$uid"; ?>">
							<button id="regular" name="regular" class="btn btn-default">Add to Regular</button>
						</div>

					</div>

					</tbody>
					</table>

					</form>

					</div>

				</div>
			</div>
		</div>

		<?php 
			if (isset($_POST['submitpass'])) {
				$uid = $_POST['uid'];
				$newpass = mysqli_real_escape_string($db, $_POST['newpass']);
				$retypepass = mysqli_real_escape_string($db, $_POST['retypepass']);
				if ($newpass === $retypepass) {
					$newpass = password_hash($newpass, PASSWORD_DEFAULT);
					$sql = "UPDATE users SET pass='$newpass' WHERE userid='$uid'";
					$results = $db->query($sql);
					if (mysqli_error($db)) {
						die("Database query failed" . mysqli_error($db));
					}
				}
			}
			if (isset($_POST['manager'])) {
				$uid = $_POST['uid'];
				$sql = "UPDATE users SET type='M' WHERE userid='$uid'";
				$results = $db->query($sql);
				if (mysqli_error($db)) {
					die("Database query failed" . mysqli_error($db));
				}
			}
			if (isset($_POST['admin'])) {
				$uid = $_POST['uid'];
				$sql = "UPDATE users SET type='A' WHERE userid='$uid'";
				$results = $db->query($sql);
				if (mysqli_error($db)) {
					die("Database query failed" . mysqli_error($db));
				}
			}
			if (isset($_POST['regular'])) {
				$uid = $_POST['uid'];
				$sql = "UPDATE users SET type='R' WHERE userid='$uid'";
				$results = $db->query($sql);
				if (mysqli_error($db)) {
					die("Database query failed" . mysqli_error($db));
				}
			}
		?>
		

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