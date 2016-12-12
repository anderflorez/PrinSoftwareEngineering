<?php
	include_once('connection.php');
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="snapreport" content="snapreport">
    <meta name="Jamie Higgins">
	
	<title>SnapReport</title>
	
	<!-- Bootswatch core CSS -->
    <link href="css/bootstrap5.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/justified-nav.css" rel="stylesheet">
	
	<link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
	
</head>
<body onload="initialize();">
	<div class="container">
		<!-- Jumbotron section (containing form) -->
		  <div class="jumbotron">
             
			<div class="container">    
				<div class="row">
				<!-- Form -->
                    
					<div id="formParent" class="col-md-6 col-md-offset-3 well well-lg">
                         <h2><big> Please create a new account below </big></h2><br><br>
               <center><img class = logo2 src="images/Logo2.png" alt="Mountain View"></center>
						<form class="form-horizontal" action="signup.php" method="post">
							<div class="form-group">
								<label class="col-sm-2 control-label" for="inputName">First Name</label>
								<div class="col-sm-10">
									<input id="inputFirstName" name="inputFirstName" class="form-control" type="text" placeholder="First Name" required autofocus>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="inputLastname">Last Name</label>
								<div class="col-sm-10">
									<input id="inputLastname" name="inputLastname" class="form-control" 
										type="text" placeholder="Last Name" required autofocus>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="inputEmail">E-mail</label>
								<div class="col-sm-10">
									<input id="inputEmail" name="inputEmail" class="form-control" type="email" placeholder="E-mail" required autofocus>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="repeatEmail">Re-enter E-mail</label>
								<div class="col-sm-10">
									<input id="repeatEmail" name="repeatEmail" class="form-control" type="email" 
										placeholder="Repeat your E-mail" required autofocus>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="inputPassword">Password</label>
								<div class="col-sm-10">
									<input id="inputPassword" name="inputPassword" class="form-control" 
										type="password" placeholder="Password" required autofocus>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="repeatPassword">Re-enter Password</label>
								<div class="col-sm-10">
									<input id="repeatPassword" name="repeatPassword" class="form-control" 
										type="password" placeholder="Repeat your password" required autofocus>
								</div>
							</div>
							<input class="btn btn-default" type="submit" name="signup" value="Sign up">
							<input type="reset" value="Reset Form" class="btn btn-default">
						</form>
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
								echo "<br><div class='alert alert-danger'>
									  <strong>Emails didn't match!</strong>
										</div>"; die;
							}
							if ($_POST["inputPassword"] === $_POST["repeatPassword"]) {
								$password = $_POST["inputPassword"];
							}
							else {
								echo "<br><div class='alert alert-danger'>
									  <strong>Passwords did't match!</strong>
										</div>"; die;
							}
							//check email is available
							$checkemail = $db->query("SELECT email FROM users WHERE email='$email'");
							if ($checkemail->num_rows === 0) {
								$token = password_hash($password, PASSWORD_DEFAULT);
								$query = "INSERT INTO users (email, pass, fname, lname) 
									VALUES ('{$email}', '{$token}',  '{$user_firstname}', '{$user_lastname}')";
								$result = mysqli_query($db, $query);
								if (!$result) {
									die("Database query failed" . mysqli_error($db));
								}
								 header("location: login.php");
							}
							else {
								echo "<br><div class='alert alert-danger'>
								<strong>Email is already associated with an account!</strong>
								</div>";}
						}
						?>
					</div>
				</div>
			</div>
		</div>
			<hr>
			<div class="register-panel text-center font-semibold"> <a href="login.php">Login<span class="menu-icon"><i class="fa fa-angle-double-right fa-fw"></i></span></a> </div>
		<!-- Footer -->
		<div id="footer">
		<div class="container">
			<p class="text-center"><br>&copy; Collaborating Developers 2016</p>
		</div>
		</div>

		</div> <!-- /container -->

	<!-- JavaScript placed at bottom for faster page loadtimes. -->
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	
	<!-- Latest compiled and minified JavaScript -->
	<script src="js/bootstrap.min.js"></script>

</body>
</html>

<?php
	//Close connection
	mysqli_close($db);
?>