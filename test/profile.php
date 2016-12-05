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
				<li><a href="submitreport.php">Submit Report</a></li>
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
</HTML>

<?php
	//Close connection
	mysqli_close($db);
?>