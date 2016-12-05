
<?php
	include_once('connection.php');
   include_once('session.php');
?>

<HTML>
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
          <ul class="nav navbar-nav">
		  <li class="dropdown">
			  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">View Reports <span class="caret"></span></a>
			  <ul class="dropdown-menu" role="menu">
				<li><a href="#">By Date</a></li>
				<li><a href="#">By Category</a></li>
				<li><a href="#">By Votes</a></li>
			  </ul>
			</li>
            <li class="dropdown">
			  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">View Events<span class="caret"></span></a>
			  <ul class="dropdown-menu" role="menu">
				<li><a href="#">By Date</a></li>
				<li><a href="#">By Category</a></li>
				<li><a href="#">By Votes</a></li>
			  </ul>
			</li>
			<li class="dropdown">
			  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Reports<span class="caret"></span></a>
			  <ul class="dropdown-menu" role="menu">
				<li><a href="#">View Reports</li>
				<li><a href="#">Submit Report</a></li>
			  </ul>
			</li>
			<li class="dropdown">
			  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Events<span class="caret"></span></a>
			  <ul class="dropdown-menu" role="menu">
				<li><a href="#">View Events</li>
				<li><a href="#">Submit Event</a></li>
			  </ul>
			</li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
			<li><a href="profile.php">Profile</a></li>
            <li><a href="logout.php">Log Out</a></li>
          </ul>
        </div>
      </div>
    </div>
	
	<div class="container">
	<!-- Jumbotron section (containing table) -->
		  <div class="jumbotron">
			<h2>New Report<br><small>Please submit a new report below</small></h2><br><br>
			<div class="container">    
				<div class="row">
				<!-- Form -->
					<div id="formParent" class="col-md-6 col-md-offset-3 well well-lg">
					<form class="form-horizontal" action="submitreport.php" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label class="col-sm-2 control-label" for="inputName">Name</label>
						<div class="col-sm-10">
							<input id="inputName" name="inputName" class="form-control" type="text" placeholder="Name" required autofocus>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="inputCat">Category</label>
						<select class="col-sm-10" id="inputCat" name="inputCat" class="form-control">
							<option value="category1">category1</option>
							<option value="category2">category2</option>
							<option value="category3">category3</option>
						</select>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="inputLoc">Location</label>
						<select class="col-sm-10" id="inputLoc" name="inputLoc" class="form-control">
							<option value="location1">location1</option>
							<option value="location2">location2</option>
							<option value="location3">location3</option>
						</select>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="description">Description</label>
						<textarea class="form-control" id="description" name="description">
						</textarea>
					</div>
					<div>
						<label class="col-sm-2 control label" for="image">Image</label>
						<input type="file" name="image" id="image">
					</div>
					<input class="btn btn-default" type="submit" name="submit" value="Submit">
					<input type="reset" value="Reset Form" class="btn btn-default">
					</form>
					</div>
				</div>
			</div>

		</div>
		
		<?php
		if (isset($_POST["submit"])) {
			$name = "";
			$category = "";
			$location = "";
			$description = "";
			$imageFile="";
			
			$name = $_POST['inputName'];
			$category = $_POST['inputCat'];
			$location = $_POST['inputLoc'];
			$description = $_POST['description'];

			$imgFile = $_FILES['image']['name'];
			$tmp_dir = $_FILES['image']['tmp_name'];
			$imgSize = $_FILES['image']['size'];

			if(empty($name)){
			$errMSG = "Please enter report name.";
			}
			else if(empty($description)){
			$errMSG = "Please enter a brief description.";
			}
			else if(empty($imgFile)){
			$errMSG = "Please select an image.";
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
			if($imgSize < 5000000)    {
			 move_uploaded_file($tmp_dir,$upload_dir.$userpic);
			}
			else{
			 $errMSG = "Sorry, your file is too large.";
			}
			}
			else{
			$errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";  
			}
			}

			// if no error occured, continue ....
			if(!isset($errMSG))
			{
				$sql = "INSERT INTO reports (userid, category, name, location, date, description, photo)
					VALUES ('{$_SESSION['userid']}','{$category}','{$name}','{$location}',CURDATE(),'{$description}','{$userpic}')";
				$result = mysqli_query($db,$sql);
				if (!$result) {
					die("Database query failed" . mysqli_error($db));
				}
			}
		}
		?>
			
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
</HTML>

<?php
	//Close connection
	mysqli_close($db);
?>
