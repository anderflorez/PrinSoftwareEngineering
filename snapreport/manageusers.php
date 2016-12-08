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

	$resultid = 0;
	$searchresults = array();
	if (isset($_POST['search'])) {
		$searchq = preg_replace("#[^0-9a-z]#i", " ", $_POST['search']);
		$sql = "SELECT userid, email, type, fname, lname FROM users WHERE fname LIKE '%$searchq%' OR lname LIKE '%$searchq%'";
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

				echo "<pre>";
				print_r($searchresults);
				echo "</pre>";
			}
		}
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
					<h2>Manage Users</h2>
				</div>
				<div id="links" class="btn-group right">
					<a href="editprofile.php" class="btn btn-default">Back</a>
					<a href="logout.php" type="button" class="btn btn-default">Log Out</a>
				</div>
			</div>
		</div>
	</header>

	<!-- Manage Users -->

	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<form action="manageusers.php" method="POST" enctype="multipart/form-data">
					<input type="text" name="search" id="search" placeholder="Search User">
					<input type="submit" name="submit" id="submit" class="btn btn-default">
					<table class="table 
						<?php 
							if (isset($_GET['id']) || !isset($searchresults)) { 
								echo "hidden";
							}
							else {
								echo "visible";
							}
						?>">
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
							print_r($resultid);
							for ($i = 0; $i < $resultid; $i++) {
								echo '
									<tr>
										<td><a href="manageusers.php?id=' . $searchresults[$i+1]["userid"] . '">' . $searchresults[$i+1]["fname"] . '</a></td>
										<td><a href="manageusers.php?id=' . $searchresults[$i+1]["userid"] . '">' . $searchresults[$i+1]["lname"] . '</td>
										<td><a href="manageusers.php?id=' . $searchresults[$i+1]["userid"] . '">' . $searchresults[$i+1]["email"] . '</td>
										<td><a href="manageusers.php?id=' . $searchresults[$i+1]["userid"] . '">' . $searchresults[$i+1]["type"] . '</td>
									</tr>';
							}
						?>
						</tbody>
					</table>
				</form>
			</div>
			<?php
				if (isset($_GET['id'])) {
					echo "get is set <br>";
					print_r($_GET['id']);
				}
			?>
		</div>
	</div>



	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>