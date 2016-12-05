<?php
	require_once("functions.php");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE-edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="./css/styles.css">
	<title>Snap Report</title>
</head>
<body>
	<div class="container">
		<div class="row">
			<section class="col-xs-12">
				<form class="form-horizontal" action="submitevent.php" method="post">
                  <div class="row">
                    <div class="col-xs-12 col-sm-8 col-md-6">
                      <div class="form-group">
                          <label class="col-sm-2 control-label" for="inputEventType">Event Type</label>
                          <div class="col-sm-10">
                            <select id="inputEventType" name="inputEventType" class="form-control" placeholder="Event Type">
                              <option>EventType1</option>
                              <option>EventType2</option>
                              <option>EventType3</option>
                              <option>Other</option>
                            </select>
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2 control-label" for="inputEventName">Event Name</label>
                          <div class="col-sm-10">
                              <input id="inputEventName" name="inputEventName" class="form-control" 
                                  type="text" placeholder="Event Name">
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2 control-label" for="inputLocation">Location</label>
                          <div class="col-sm-10">
                            <select id="inputLocation" name="inputLocation" class="form-control" placeholder="Location">
                              <option>Location1</option>
                              <option>Location2</option>
                              <option>Location3</option>
                            </select>
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2 control-label" for="inputDate">Date</label>
                          <div class="col-sm-10">
                              <input id="inputDate" name="inputDate" class="form-control" type="text" 
                                  placeholder="Date">
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2 control-label" for="inputDescription">Description</label>
                          <div class="col-sm-10">
                              <textarea id="inputDescription"
                                        name="inputDescription"
                                        class="form-control"
                                        placeholder="Description"></textarea>
                          </div>
                      </div>
                    </div>
                    
                    <div class="col-md-6 col-sm-4 col-xs-12">
                      <div class="form-group text-center">
                        <div class="img-thumbnail">
                          <i class="fa fa-question-circle-o" aria-hidden="true" style="font-size: 150px; padding: 0.25em;"></i>
                        </div>
                      </div>
                      
                      <div class="form-group">
                          <label class="col-sm-2 control-label" for="inputPicture">Picture</label>
                          <div class="col-sm-10">
                              <input id="inputPicture" name="inputPicture" class="form-control" 
                                  type="file" placeholder="Browse pictures...">
                          </div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-xs-offset-0 col-sm-10">
                                <input class="btn btn-default col-sm-10 col-xs-12" type="submit" name="signup" value="Submit Event">
                            </div>
                        </div>
                      </div>
                  </div>
				</form>
			</section>			
		</div>		
	</div>

	<?php
  /*
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
    */
	?>

	<script type="text/javascript" src="./js/jquery.js"></script>
	<script type="text/javascript" src="./js/bootstrap.min.js"></script>
    <script type="text/javascript" src="./js/bootstrap-datepicker.min.js"></script>
	<script type="text/javascript" src="./js/script.js"></script>
  
    <script type="application/javascript">
      $(function() {
        $('#inputDate').datepicker({
          format: 'yyyy-mm-dd'
        });
      });
    </script>
</body>
</html>

<?php
	//Close connection
	mysqli_close($db);
?>