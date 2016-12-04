<?php
session_start();
echo "";
require_once 'functions.php';
$userstr = ' ';
if (isset($_SESSION['user']))
{
$user = $_SESSION['user'];
$loggedin = TRUE;
$userstr = " ($user)";
}
else $loggedin = FALSE;
echo "<title>$appname$userstr</title><link rel='stylesheet' " .
"href='styles.css' type='text/css'>" .
"</head><body><center><canvas id='logo' width='624' " .
"height='96'>$appname</canvas></center>" .
"<script src='javascript.js'></script>";
if ($loggedin)
echo "<br ><ul class='menu'>" .





"<li><a href='logout.php'> </a></li></ul><br>";
else
echo ("<br><ul class='menu'>" );

?>