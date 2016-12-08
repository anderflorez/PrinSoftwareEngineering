<?php
	include_once('connection.php');
	session_start();

	if (isset($_SESSION)) {
		$login_user = $_SESSION['login_user'];
		$userid = $_SESSION['userid'];
		$email = $_SESSION['email'];
		$fname = $_SESSION['fname'];
		$pass = $_SESSION['pass'];
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css2/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css2/style.css">
	<link rel="stylesheet" type="text/css" href="css2/editprofile_style.css">
	<title>SnapReport</title>
</head>
<body>
	<header>
		<div class="container">
			<div class="row">
				<div id="title" class="col-lg-offset-4 col-lg-4 col-md-offset-3 col-md-4 col-sm-offset-4 
							col-sm-4 col-xs-offset-0 col-xs-12">
					<h2>Edit Your Profile</h2>
				</div>
				<div id="links" class="btn-group right">
					<a href="#" class="btn btn-default">Back</a>
					<a href="logout.php" class="btn btn-default">Log Out</a>
				</div>
			</div>
		</div>
	</header>

	<!-- Edit Profile -->

	<?php
		$usertype = "manager";
	?>

	<div id="editprofile" class="container">
		<div class="row">
			<div id="userpic" class="col-sm-offset-1 col-sm-3 col-xs-offset-3 col-xs-6">
				<div class="services animate-box">
					<img src="images/Icon-user.png">
				</div>				
			</div>
			<div class="col-sm-offset-1 col-sm-7 col-xs-offset-1 col-xs-7">
				<form action="editprofile.php" method="post" enctype="multipart/form-data">
					<button id="btn_pic" class="btn btn-default ">Change Picture</button>
					<div id="feature_pic" class="features">
						<input type="file" name="changepic" id="changepic">
						<input type="submit" name="submitpic" class="btn btn-default">
					</div>
					<button id="btn_email" class="btn btn-default">Change E-mail</button>
					<div id="feature_email" class="features">
						<input type="email" name="changeemail" id="changeemail" placeholder="E-mail">
						<input type="submit" name="submitemail" class="btn btn-default">
					</div>
					<button id="btn_pass" class="btn btn-default">Change Password</button>
					<div id="feature_pass" class="features">
						<input type="password" name="currentpass" id="currentpass" placeholder="Current Password">
						<input type="password" name="newpass" id="newpass" placeholder="New Password">
						<input type="password" name="retypepass" id="retypepass" placeholder="Re-type Password">
						<input type="submit" name="submitpass" class="btn btn-default">
					</div>
					
					<?php
						if ($usertype === "manager") {
							echo "<a href='manageusers.php?back=http://localhost/test/snapreport/editprofile.php' class='btn btn-default'>Manage Users</a>";
						}
					?>
				</form>
			</div>
		</div>
	</div>

	<?php 
		if (isset($_POST['submitemail']) && filter_var($_POST['changeemail'], FILTER_VALIDATE_EMAIL)) {
			$newemail = $_POST['changeemail'];
			$sql = "UPDATE users SET email='$newemail' WHERE userid='$userid'";
			$result = $db->query($sql);
			if ($result->num_rows == 0) {
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
						echo "changing password!";
						$newpass = password_hash($newpass, PASSWORD_DEFAULT);
						$sql = "UPDATE users SET pass='$newpass' WHERE userid='$userid'";
						$resutl = $db->query($sql);
						if ($result->num_rows == 0) {
							die("Database query failed" . mysqli_error($db));
						}
						else {
							header("location: login.php");
						}
					}
				}
			}
		}
	?>

	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/editprofile_script.js"></script>
</body>
</html>