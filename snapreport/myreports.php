<?php
  include_once('connection.php');
  include_once('session.php');
?>

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
    <link rel="stylesheet" type="text/css" href="./css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css">

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
      <div class="row">
        <h1 class="col-xs-12">My Submitted Reports</h1>
      </div>
      <div class="row">
        <div class="col-xs-12 col-sm-3">
          <form class="form-horizontal text-center" method="get" action="myreports.php">
            <fieldset>
              <legend>Search By</legend>
              <div class="form-group">
                <label for="ReportID" class="col-xs-2 control-label">Report ID</label>
                <div class="col-xs-10">
                  <input type="text" class="form-control" id="ReportID" name="ReportID" placeholder="Report ID">
                </div>
              </div>
              <div class="form-group">
                <label for="ReportCategory" class="col-xs-2 control-label">Category</label>
                <div class="col-xs-10">
                  <select class="form-control" id="ReportCategory" name="ReportCategory" placeholder="Category">
                    <option>Option1</option>
                    <option>Option2</option>
                    <option>Option3</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="ReportDate" class="col-xs-2 control-label">Date</label>
                <div class="col-xs-10">
                  <input type="text" class="form-control" id="ReportDate" name="ReportDate" placeholder="Date">
                </div>
              </div>
              <div class="form-group">
                <label for="ReportStatus" class="col-xs-2 control-label">Status</label>
                <div class="col-xs-10">
                  <select class="form-control" id="ReportStatus" name="ReportStatus" placeholder="Status">
                    <option>Status1</option>
                    <option>Status2</option>
                    <option>Status3</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <div class="col-xs-12">
                  <button class="btn btn-primary" id="ReportSearch" name="ReportSearch" type="submit">Search</button>
                </div>
              </div>
            </fieldset>
          </form>
        </div>
        <div class="col-xs-12 col-sm-9">
          
          <!-- TODO: Iterate through submitted reports -->
          <div class="panel panel-default">
            <div class="panel-body">
              <div class="row">
                <div class="col-xs-12 col-sm-6">
                  <p>Internet Issue - Nov, 4 2016</p>
                </div>
                <div class="col-xs-12 col-sm-6 text-right">
                  <p>In Progress</p>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-12 col-sm-3 text-center">
                  <div class="row">
                    <div class="img-thumbnail">
                      <i class="fa fa-question-circle-o" aria-hidden="true" style="font-size: 50px; padding: 0.25em;"></i>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xs-12">
                      <p>ID #R865</p>
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-9">
                  <p class="text-justify">
                    Lorem ipsum dolor sit amet, ligula ornare etiam urna eu, turpis arcu. 
                    Velit ligula eu praesent orci ut ornare. Odio sociosqu, adipiscing sociosqu est. 
                    Et sit amet, ultrices sodales etiam eget in, amet quis vel in odio lacus massa, lacinia rutrum, 
                    libero suscipit et pulvinar pharetra. Lacus lectus proin.
                  </p>
                </div>
              </div>
            </div>
          </div>
          
          <div class="panel panel-default">
            <div class="panel-body">
              <div class="row">
                <div class="col-xs-12 col-sm-6">
                  <p>Hackathon - Nov, 2 2016</p>
                </div>
                <div class="col-xs-12 col-sm-6 text-right">
                  <p>In Progress</p>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-12 col-sm-3 text-center">
                  <div class="row">
                    <div class="img-thumbnail">
                      <i class="fa fa-question-circle-o" aria-hidden="true" style="font-size: 50px; padding: 0.25em;"></i>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xs-12">
                      <p>ID #R865</p>
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-9">
                  <p class="text-justify">
                    Lorem ipsum dolor sit amet, ligula ornare etiam urna eu, turpis arcu. 
                    Velit ligula eu praesent orci ut ornare. Odio sociosqu, adipiscing sociosqu est. 
                    Et sit amet, ultrices sodales etiam eget in, amet quis vel in odio lacus massa, lacinia rutrum, 
                    libero suscipit et pulvinar pharetra. Lacus lectus proin.
                  </p>
                </div>
              </div>
            </div>
          </div>
          
          <div class="panel panel-default">
            <div class="panel-body">
              <div class="row">
                <div class="col-xs-12 col-sm-6">
                  <p>Parking - Nov, 1 2016</p>
                </div>
                <div class="col-xs-12 col-sm-6 text-right">
                  <p>In Progress</p>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-12 col-sm-3 text-center">
                  <div class="row">
                    <div class="img-thumbnail">
                      <i class="fa fa-question-circle-o" aria-hidden="true" style="font-size: 50px; padding: 0.25em;"></i>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xs-12">
                      <p>ID #R865</p>
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-9">
                  <p class="text-justify">
                    Lorem ipsum dolor sit amet, ligula ornare etiam urna eu, turpis arcu. 
                    Velit ligula eu praesent orci ut ornare. Odio sociosqu, adipiscing sociosqu est. 
                    Et sit amet, ultrices sodales etiam eget in, amet quis vel in odio lacus massa, lacinia rutrum, 
                    libero suscipit et pulvinar pharetra. Lacus lectus proin.
                  </p>
                </div>
              </div>
            </div>
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
    <!-- /container -->

	<!-- JavaScript placed at bottom for faster page loadtimes. -->
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	
	<!-- Latest compiled and minified JavaScript -->
	<script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="./js/bootstrap-datepicker.min.js"></script>
    
    <script type="text/javascript">
      $(function() {
        $('#ReportDate').datepicker({
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