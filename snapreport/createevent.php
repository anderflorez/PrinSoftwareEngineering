<?php
	require_once("connection.php");
    require_once("session.php");

    function validate_picture_file($path) {
      // Array of predefined constants (See http://php.net/manual/en/function.exif-imagetype.php)
      $acceptableTypes = array(IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_GIF);
      $detectedType = exif_imagetype($path);  // WARNING: This will only work if the
                                              // EXIF extension is enabled.
      return in_array($detectedType, $acceptableTypes);
    }

    // http://stackoverflow.com/a/11807179
    // Slightly modified to be compatible with PHP's ini directives.
    // http://php.net/manual/en/ini.core.php#ini.post-max-size
    function convertToBytes($from){
        $number=substr($from,0,-1);
        switch(strtoupper(substr($from,-1))){
            case "K":
                return $number*1024;
            case "M":
                return $number*pow(1024,2);
            case "G":
                return $number*pow(1024,3);
            default:
                return $from;
        }
    }

    function delete_file($path) {
      $fullPath = realpath($path);

      if (is_writable($fullPath)) {
        return unlink($fullPath);
      } else {
        return false;
      }
    }

	if (isset($_POST["reportevent"])) {
		$event_type = $_POST["inputEventType"]; // TODO: Data validation, this field
                                                // might be populated by database
		$event_name = sanitizeString($_POST["inputEventName"]);
		$event_location = $_POST["inputLocation"];  // TODO: Data validation, this field
                                                    // might be populated by database
        $event_date = sanitizeString($_POST["inputDate"]);
      
        if (!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $event_date))
        {
          echo "Error: Date is not in correct format.";
          exit();
        }
      
        $event_description = sanitizeString($_POST["inputDescription"]);
      
        if (isset($_SERVER['CONTENT_LENGTH']) && (int)$_SERVER['CONTENT_LENGTH'] > convertToBytes('2M')) {
          echo "Error: Image is too large. Please select another image and try again.";
          exit();
        }
      
        if (!isset($_FILES['inputPicture']['tmp_name']) || $_FILES['inputPicture']['tmp_name'] == "") {
          echo "Error: No file selected. Please select a JPEG, PNG or GIF file and try again.";
          exit();
        }
        
        $isValidPicture = validate_picture_file($_FILES['inputPicture']['tmp_name']);
      
        if (!$isValidPicture) {
          echo "Error: Invalid file. Please select a JPEG, PNG or GIF file and try again.";
          exit();
        }
         
        $image = addslashes($_FILES['inputPicture']['tmp_name']);
        $image = file_get_contents($image);
        $image = base64_encode($image);

        $result = $db->query("INSERT INTO events (userid, category, name, location, date, description, photo)"
                             ." VALUES ({$_SESSION['userid']}, '$event_type', '$event_name', '$event_location',"
                             ." '$event_date', '$event_description', '$image')");

        if ($db->affected_rows > 0) {
          $result = $db->query('SELECT LAST_INSERT_ID()');
          $reportID = $result->fetch_row()[0];
          echo "Thanks! Your report ID is #$reportID.";
        } else {
          echo 'Failed to submit event. '.$db->error;
          exit();
        }
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE-edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="./css2/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="./css2/bootstrap-datepicker.min.css">
    <link rel="stylesheet" type="text/css" href="./css2/font-awesome.min.css">
	<title>Snap Report - Report an Event</title>
</head>
<body>
	<div class="container">
		<div class="row">
			<section class="col-xs-12">
				<form class="form-horizontal" action="submitevent.php" enctype="multipart/form-data" method="post">
                  <div class="row">
                    <h1 class="col-xs-12 col-sm-8 col-md-6 text-center">Report an Event</h1>
                  </div>
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
                        <div id="imagePV" class="img-thumbnail">
                          <i class="fa fa-question-circle-o" aria-hidden="true" style="font-size: 150px; padding: 0.25em;"></i>
                        </div>
                      </div>
                      
                      <div class="form-group">
                          <label class="col-sm-2 control-label" for="inputPicture">Picture</label>
                          <div class="col-sm-10">
                              <input id="inputPicture" name="inputPicture" class="form-control" 
                                  type="file">
                          </div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-xs-offset-0 col-sm-10">
                                <input class="btn btn-default col-sm-10 col-xs-12" type="submit" name="reportevent" value="Report Event">
                            </div>
                        </div>
                      </div>
                  </div>
				</form>
			</section>			
		</div>		
	</div>

	<script type="text/javascript" src="./js2/jquery.min.js"></script>
	<script type="text/javascript" src="./js/bootstrap.min.js"></script>
    <script type="text/javascript" src="./js2/bootstrap-datepicker.min.js"></script>
	<script type="text/javascript" src="./js2/main.js"></script>
  
    <script type="application/javascript">
      $(function() {
        $('#inputDate').datepicker({
          format: 'yyyy-mm-dd'
        });
        
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