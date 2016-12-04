<?php
	require_once("functions.php");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE-edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/css/styles.css">
	<title>Snap Report</title>
</head>
<body>
	<div class="container">
		<div class="row">
			<section class="col-xs-12">
				<form class="form-horizontal" action="signup.php" method="post">
					<div class="form-group">
						<label class="col-sm-2 control-label" for="inputName">First Name</label>
						<div class="col-sm-10">
							<input id="inputFirstName" name="inputFirstName" class="form-control" type="text" placeholder="First Name">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="inputLastname">Last Name</label>
						<div class="col-sm-10">
							<input id="inputLastname" name="inputLastname" class="form-control" 
								type="text" placeholder="Last Name">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="inputEmail">E-mail</label>
						<div class="col-sm-10">
							<input id="inputEmail" name="inputEmail" class="form-control" type="email" placeholder="E-mail">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="repeatEmail">Re-enter E-mail</label>
						<div class="col-sm-10">
							<input id="repeatEmail" name="repeatEmail" class="form-control" type="email" 
								placeholder="Repeat your E-mail">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="inputPassword">Password</label>
						<div class="col-sm-10">
							<input id="inputPassword" name="inputPassword" class="form-control" 
								type="password" placeholder="Password">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="repeatPassword">Re-enter Password</label>
						<div class="col-sm-10">
							<input id="repeatPassword" name="repeatPassword" class="form-control" 
								type="password" placeholder="Repeat your password">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<input class="btn btn-default" type="submit" name="signup" value="Sign up">
							<a href="../SnapReport/login.php">Log in</a>
						</div>

					</div>
				</form>
			</section>			
		</div>		
	</div>

	<?php
	if (isset($_POST["signup"])) {
		$email = "";
		$password = "";
		$user_firstname = $_POST["inputFirstName"];
		$user_lastname = $_POST["inputLastname"];
		//Validation
		if ($_POST["inputEmail"] === $_POST["repeatEmail"]) {
			$email = $_POST["inputEmail"];
		}
		else {
			echo "The email address doesn't match!";
			exit();
		}
		if ($_POST["inputPassword"] === $_POST["repeatPassword"]) {
			$password = $_POST["inputPassword"];
		}
		else {
			echo "The password doesn't match!";
			exit();
		}
		//check email is available
		$checkemail = $db->query("SELECT email FROM users WHERE email='$email'");
		if ($checkemail->num_rows == 0) {
			$token = password_hash($password, PASSWORD_DEFAULT);
			$query = "INSERT INTO users (email, pass, fname, lname) 
				VALUES ('{$email}', '{$token}',  '{$user_firstname}', '{$user_lastname}')";
			$result = mysqli_query($db, $query);
			if (!$result) {
				die("Database query failed" . mysqli_error($db));
			}
		}
	}
	?>

	<script type="text/javascript" src="../js/jquery-3.1.1.js"></script>
	<script type="text/javascript" src="../js/bootstrap.js"></script>
	<script type="text/javascript" src="../js/script.js"></script>
</body>
</html>

<?php
	//Close connection
	mysqli_close($db);
?>