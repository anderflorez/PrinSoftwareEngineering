<?php
   include_once('connection.php');
   session_start();
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
			<h2>Welcome to SnapReport<br><small>Please log in below</small></h2><br><br>
			<div class="container">    
				<div class="row">
				<!-- Form -->
					<div id="formParent" class="col-md-6 col-md-offset-3 well well-lg">
					<?php

					   if(isset($_POST["login"])) {
						  // email and password sent from form 
						  
						  $email = mysqli_real_escape_string($db,$_POST['email']);
						  $password = mysqli_real_escape_string($db,$_POST['password']); 
						  $sql = "SELECT pass FROM users WHERE email = '$email'";
						  $result = mysqli_query($db,$sql);
						  $row = mysqli_fetch_assoc($result);
						  $pass = $row['pass'];
						  if (password_verify($password,$pass))
						  {
							  $sql = "SELECT userid FROM users WHERE email = '$email' and pass = '$pass'";
							  $result = mysqli_query($db,$sql);
							  $row = mysqli_fetch_assoc($result);
							  $userid = $row['userid'];
							  $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
							  $active = $row['active'];
							  
							  $count = mysqli_num_rows($result);
							  
							  // If result matched $email and $pass, table row must be 1 row
								
							  if($count == 1) {
								 
								 $_SESSION['login_user'] = $userid;
								 
								 header("location: profile.php");
							  }else {
								 echo "<div class='alert alert-danger'>
									  <strong>Email/password combination invalid!</strong>
										</div>";
							  }
						  }
					   }
					?>
						<form class="form-horizontal" action="login.php" method="post">
			
							<div class="form-group">
								<label class="col-sm-2 control-label" for="email">E-mail</label>
								<div class="col-sm-10">
									<input id="email" name="email" class="form-control" type="email" placeholder="E-mail" required autofocus>
								</div>
							</div>
		
							<div class="form-group">
								<label class="col-sm-2 control-label" for="password">Password</label>
								<div class="col-sm-10">
									<input id="password" name="password" class="form-control" 
										type="password" placeholder="Password" required autofocus>
								</div>
							</div>
		
							<input class="btn btn-default" type="submit" name="login" value="Log in">
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