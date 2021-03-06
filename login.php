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

	
	<div class="container">

		<!-- Jumbotron section (containing form) -->
		  <div class="jumbotron">
			
			<div class="container">    
              
				<div class="row">
                    
				<!-- Form -->
					<div id="formParent" class="col-md-6 col-md-offset-3 well well-lg">
						<form class="form-horizontal" action="login.php" method="post">
                              <h2><br><big>Please log in below</big></h2><br><br>
              <center><img class = logo2 src="images/Logo2.png" alt="Mountain View"></center>
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
					<?php
					   if(isset($_POST["login"])) {
						  // email and password sent from form 
						  $email = mysqli_real_escape_string($db,$_POST['email']);
						  $password = mysqli_real_escape_string($db,$_POST['password']); 
						  $sql = "SELECT pass FROM users WHERE email = '$email'";
						  $result = mysqli_query($db,$sql);
						  $count = mysqli_num_rows($result);
						  $row = mysqli_fetch_assoc($result);
						  $pass = $row['pass'];
						  if ($count == 0){
							  echo "<br><div class='alert alert-danger'>
									  <strong>Email not registered!</strong>
										</div>";
						  }
						  else if (password_verify($password,$pass))
						  {
							  $sql = "SELECT userid,type FROM users WHERE email = '$email' and pass = '$pass'";
							  $result = mysqli_query($db,$sql);
							  $row = mysqli_fetch_assoc($result);
							  $userid = $row['userid'];
							  $type = $row['type'];
							  $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
							  $active = $row['active'];
							  
							  $count = mysqli_num_rows($result);
							  
							  // If result matched $email and $pass, table row must be 1 row
								
							  if($count == 1) {
								 
								 $_SESSION['login_user'] = $userid;
								 
								 if($type=="A")
								 {header("location: adminprofile.php");}
								 else{
								 header("location: profile.php");}
							  }
						  }
						  else{
							  echo "<br><div class='alert alert-danger'>
									  <strong>Password incorrect!</strong>
										</div>";
						  }
					   }
					?>
					</div>
				</div>
			</div>
		</div>
        <hr>
			<div class="register-panel text-center font-semibold"> <a href="signup.php">CREATE AN ACCOUNT<span class="menu-icon"><i class="fa fa-angle-double-right fa-fw"></i></span></a> </div>
          
		<!-- Footer -->
		<div id="footer">
		<div class="container">
            
			<p class="text-center"><br>&copy; Collaborating Developers 2016 </p>
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