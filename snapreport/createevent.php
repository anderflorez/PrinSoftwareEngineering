<?php
	require_once("connection.php");
    require_once("functions.php");
    require_once("session.php");
    
    // Array for error helper text
    $err_str = array( 'event_type' => '',
                      'event_name' => '',
                      'event_location' => '',
                      'event_description' => '',
                      'event_photo' => '',
                      'form_result' => '');

	if (isset($_POST["reportevent"])) {
        $validForm = true;
		$event_type = $_POST["inputEventType"]; // TODO: Data validation, this field
                                                // might be populated by database
		$event_name = sanitizeString($_POST["inputEventName"]);
		$event_location = $_POST["inputLocation"];  // TODO: Data validation, this field
                                                    // might be populated by database
        $event_description = sanitizeString($_POST["inputDescription"]);
        
        if (!isset($_FILES['inputPicture']['tmp_name']) || $_FILES['inputPicture']['tmp_name'] == "") {
          $err_str['event_photo'] = 'No photo selected. Please select a JPEG, PNG or GIF file.';
          $validForm = false;
        }
      
        if (isset($_SERVER['CONTENT_LENGTH']) && (int)$_SERVER['CONTENT_LENGTH'] > convertToBytes('2M')) {
          $err_str['event_photo'] = 'Photo is too large. It must be 2 MB or less. Please select another image and try again.';
          $validForm = false;
        }
        
        if (isset($_FILES['inputPicture']['tmp_name']) && $_FILES['inputPicture']['tmp_name'] != "") {
          $isValidPicture = validate_picture_file($_FILES['inputPicture']['tmp_name']);
          
          if (!$isValidPicture) {
            $err_str['event_photo'] = 'Invalid file. Please select a PNG, JPEG, or GIF file and try again.';
            $validForm = false;
          }
        }

        if ($validForm) {
          $imgExt = strtolower(pathinfo($_FILES['inputPicture']['tmp_name'],PATHINFO_EXTENSION));
          
          // Reduce the possibility of a filename collision
          $imgName = '';
          do {
            $imgName = rand(1000,1000000).".".$imgExt;
          } while (file_exists("uploads/$imgName"));
          
          $result = $db->query("INSERT INTO events (userid, category, name, location, date, description, photo)"
                               ." VALUES ({$_SESSION['userid']}, '$event_type', '$event_name', '$event_location',"
                               ." CURDATE(), '$event_description', 'uploads/$imgName')");

          if ($db->affected_rows > 0) {
            move_uploaded_file($_FILES['inputPicture']['tmp_name'], "uploads/$imgName");
            $result = $db->query('SELECT LAST_INSERT_ID()');
            $reportID = (string)$result->fetch_row()[0];
            header("Location: ThankyouEvent.php?report_success&report_id=$reportID");
          } else {
            $err_str['form_result'] = 'Failed to submit event. Please contact the site adminstrator for assistance.';
          }
        }
	}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>SnapReport &mdash; </title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Template by FREEHTML5.CO" />
	<meta name="keywords" content="free html5, free template, free bootstrap, html5, css3, mobile first, responsive" />
	<meta name="author" content="FREEHTML5.CO" />

  <!-- 
	//////////////////////////////////////////////////////

	FREE HTML5 TEMPLATE 
	DESIGNED & DEVELOPED by FREEHTML5.CO
		
	Website: 		http://freehtml5.co/
	Email: 			info@freehtml5.co
	Twitter: 		http://twitter.com/fh5co
	Facebook: 		https://www.facebook.com/fh5co

	//////////////////////////////////////////////////////
	 -->

  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="shortcut icon" href="favicon.ico">

	<!-- <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'> -->
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="css2/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css2/icomoon.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css2/bootstrap.css">
	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css2/magnific-popup.css">
	<!-- Superfish -->
	<link rel="stylesheet" href="css2/superfish.css">
  
    <link rel="stylesheet" href="css2/font-awesome.min.css">
  
    <link rel="stylesheet" href="css/justified-nav.css">
	<link rel="stylesheet" href="css2/style.css">


	<!-- Modernizr JS -->
	<script src="js2/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<div class="container">
		<div class="row">
          <p class="text-center col-xs-12">
            <a href="profile.php"><img src="images/Logo2.png" alt="SnapReport logo"></a>
          </p>
          <h1 class="text-center">
            Report an Event
          </h1>
			<section id="formParent" class="col-md-6 col-md-offset-3 form-parent well well-lg">
				<form class="form-horizontal" action="createevent.php" enctype="multipart/form-data" method="post">
                  <div class="row">
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="inputEventType">Event Type</label>
                        <div class="col-sm-10">
                          <select id="inputEventType" name="inputEventType" class="form-control" placeholder="Event Type">
                            <option value="EventType1">EventType1</option>
                            <option value="EventType2">EventType2</option>
                            <option value="EventType3">EventType3</option>
                            <option value="Other">Other</option>
                          </select>
                          <?php if ($err_str['event_type'] != '') echo generateBootstrapAlert($err_str['event_type']); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="inputEventName">Event Name</label>
                        <div class="col-sm-10">
                            <input id="inputEventName" name="inputEventName" class="form-control" 
                                type="text" value="<?php if (isset($_POST['inputEventName'])) echo $_POST['inputEventName']; ?>" placeholder="e.g. My Cool Event">
                            <?php if ($err_str['event_name'] != '') echo generateBootstrapAlert($err_str['event_name']); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="inputLocation">Location</label>
                        <div class="col-sm-10">
                          <select id="inputLocation" name="inputLocation" class="form-control" placeholder="Location">
                            <option value="Location1">Location1</option>
                            <option value="Location2">Location2</option>
                            <option value="Location3">Location3</option>
                          </select>
                          <?php if ($err_str['event_location'] != '') echo generateBootstrapAlert($err_str['event_location']); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="inputDescription">Description</label>
                        <div class="col-sm-10">
                            <textarea id="inputDescription"
                                      name="inputDescription"
                                      class="form-control"
                                      placeholder="e.g. My long description text"><?php if (isset($_POST['inputDescription'])) echo $_POST['inputDescription']; ?></textarea>
                            <?php if ($err_str['event_description'] != '') echo generateBootstrapAlert($err_str['event_description']); ?>
                        </div>
                    </div>
                      <div class="form-group text-center">
                        <div id="imagePV" class="img-thumbnail">
                          <i class="glyphicon glyphicon-camera" aria-hidden="true" style="font-size: 150px; padding: 0.25em;"></i>
                        </div>
                      </div>
                      
                      <div class="form-group">
                          <label class="col-sm-2 control-label" for="inputPicture">Picture</label>
                          <div class="col-sm-10">
                              <input id="inputPicture" name="inputPicture" class="form-control" 
                                  type="file">
                              <p class="help-block">Must be a PNG, JPEG, or GIF file of 2 MB or less.</p>
                            <?php if ($err_str['event_photo'] != '') echo generateBootstrapAlert($err_str['event_photo']); ?>
                          </div>
                      </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-xs-offset-0 col-sm-10">
                                <input class="btn btn-default col-sm-10 col-xs-12" type="submit" name="reportevent" value="Report Event">
                                <?php if ($err_str['form_result'] != '') echo generateBootstrapAlert($err_str['form_result']); ?>
                            </div>
                        </div>
                      </div>
                  </div>
				</form>
			</section>			
		</div>		
	</div>
    <script src="js2/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js2/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js2/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js2/jquery.waypoints.min.js"></script>
	<!-- Stellar -->
	<script src="js2/jquery.stellar.min.js"></script>
	<!-- Superfish -->
	<script src="js2/hoverIntent.js"></script>
	<script src="js2/superfish.js"></script>
	<!-- Magnific Popup -->
	<script src="js2/jquery.magnific-popup.min.js"></script>
	<script src="js2/magnific-popup-options.js"></script>

	<!-- Main JS -->
	<script src="js2/main.js"></script>
  
    <script type="application/javascript">
      $(function() {
        <?php
          if (isset($_POST['inputEventType']))
            echo 'document.getElementById("inputEventType").value = "'.$_POST['inputEventType'].'";';
          if (isset($_POST['inputLocation']))
            echo 'document.getElementById("inputLocation").value = "'.$_POST['inputLocation'].'";';
        ?>
        
        $('#inputPicture').change(function(event) {
          if ($(this).hasExtension([".png",".jpg",".gif"])) {
            var newImg = new Image();
            newImg.src = URL.createObjectURL(event.target.files[0]);
            
            $(newImg).css({
              width: "100%"
            });
            
            imagePV.innerHTML = "";
            imagePV.appendChild(newImg);
          }
          else
          {
            var placeHolder = document.createElement("i");
            
            $(placeHolder).addClass("fa fa-question-circle-o").addProp;
            $(placeHolder).attr("aria-hidden", "true");
            $(placeHolder).css({
              fontSize: "150px",
              padding: "0.25em"
            });
            
            imagePV.innerHTML = "";
            imagePV.appendChild(placeHolder);
          }
        });
      });
    </script>
</body>
</html>

<?php
	//Close connection
	mysqli_close($db);
?>