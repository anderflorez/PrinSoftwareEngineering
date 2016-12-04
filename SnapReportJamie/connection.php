<?
$dbhost = "localhost";
$dbname = "higginsj2012";
$dbuser = "higginsj2012";
$dbpass = "blink182";

$db = new mysqli($dbhost,$dbuser,$dbpass,$dbname);

if($db->connect_error) {
	die("Connection failed: " . $db->connect_error);
}
?>