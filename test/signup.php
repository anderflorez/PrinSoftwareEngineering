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

	<!-- Navbar -->
	<div class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a href="#" class="navbar-brand">SnapReport</a>
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="signup.php">Sign Up</a></li>
			<li><a href="login.php">Log In</a></li>
          </ul>
        </div>
      </div>
    </div>
	
	<div class="container">

		<!-- Jumbotron section (containing form) -->
		  <div class="jumbotron">
			<h2>Welcome to SnapReport<br><small>Please create a new account below</small></h2><br><br>
			<div class="container">    
				<div class="row">
				<!-- Form -->
					<div id="formParent" class="col-md-6 col-md-offset-3 well well-lg">
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
								echo "<div class='alert alert-danger'>
									  <strong>Emails didn't match!</strong>
										</div>";
							}
							if ($_POST["inputPassword"] === $_POST["repeatPassword"]) {
								$password = $_POST["inputPassword"];
							}
							else {
								echo "<div class='alert alert-danger'>
									  <strong>Passwords did't match!</strong>
										</div>";
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
								 header("location: welcome.php");
							}
							else {
								echo "<div class='alert alert-danger'>
								<strong>Email is already associated with an account!</strong>
								</div>";}
						}
						?>
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
						
					</div>
				</div>
			</div>
		</div>
			
		<!-- Footer -->
		<div id="footer">
		<div class="container">
			<p class="text-center"><br>&copy; Jamie Higgins 2014</p>
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