<?php
$dbhost = "localhost";
$dbname = "snapreport";
$dbuser = "root";
$dbpass = "8359248";

$db = new mysqli($dbhost,$dbuser,$dbpass,$dbname);

if($db->connect_error) {
	die("Connection failed: " . $db->connect_error);
}
?>