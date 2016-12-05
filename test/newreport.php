<?php
	include_once('connection.php');
	include_once('session.php');
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
				<form class="form-horizontal" action="newreport.php" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label class="col-sm-2 control-label" for="inputName">Name</label>
						<div class="col-sm-10">
							<input id="inputName" name="inputName" class="form-control" type="text" placeholder="Name">
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
						<textarea class="form-control" id="description" name="description" type="text">
						</textarea>
					</div>
					<div>
						<label class="col-sm-2 control label" for="image">Image</label>
						<input type="file" name="image" id="image">
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<input class="btn btn-default" type="submit" name="submit" value="Submit">
						</div>

					</div>
				</form>
			</section>			
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

	<script type="text/javascript" src="../js/jquery-3.1.1.js"></script>
	<script type="text/javascript" src="../js/bootstrap.js"></script>
	<script type="text/javascript" src="../js/script.js"></script>
</body>
</html>

<?php
	//Close connection
	mysqli_close($db);
?>
