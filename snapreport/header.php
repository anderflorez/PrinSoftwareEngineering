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
"<div class='appname'>$appname$userstr</div>" .
"<script src='javascript.js'></script>";
if ($loggedin)
echo "<br ><ul class='menu'>" .
"<li><a href='members.php?view=$user'>Home</a></li>" .
"<li><a href='members.php'>Members</a></li>" .
"<li><a href='friends.php'>Friends</a></li>" .
"<li><a href='messages.php'>Messages</a></li>" .
"<li><a href='profile.php'>Edit Profile</a></li>" .
"<li><a href='logout.php'>Log out</a></li></ul><br>";
else
echo ("<br><ul class='menu'>" .



"<span class='info'>&#8658;<li><a href='signup.php'>SignUp</a></li> ");

?>