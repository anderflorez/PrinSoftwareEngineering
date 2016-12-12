<?php
$dbhost = "localhost";
$dbname = "daires2014";
$dbuser = "daires2014";
$dbpass = "Linkin732";

$db = new mysqli($dbhost,$dbuser,$dbpass,$dbname);

if($db->connect_error) {
	die("Connection failed: " . $db->connect_error);
}
?>