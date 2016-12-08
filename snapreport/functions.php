<?php
// This is unnecessary, just include "connection.php" before this file
/* $dbhost = 'localhost'; // Unlikely to require changing
$dbname = 'daires2014'; // Modify these...
$dbuser = 'daires2014'; // ...variables according
$dbpass = 'Linkin732'; // ...to your installation
$appname = "SnapReport"; // ...and preference
$connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($connection->connect_error) die($connection->connect_error); */

/* function createTable($name, $query)
{
queryMysql("CREATE TABLE IF NOT EXISTS $name($query)");
echo "Table '$name' created or already exists.<br>";
}
/* function queryMysql($query)
{
global $connection;
$result = $connection->query($query);
if (!$result) die($connection->error);
return $result;
} */
function destroySession()
{
$_SESSION=array();
if (session_id() != "" || isset($_COOKIE[session_name()]))
setcookie(session_name(), '', time()-2592000, '/');
session_destroy();
}
function sanitizeString($var)
{
global $db;
$var = strip_tags($var);
$var = htmlentities($var);
$var = stripslashes($var);
return $db->real_escape_string($var);
}
function showProfile($user)
{
if (file_exists("$user.jpg"))
echo "<img src='$user.jpg' style='float:left;'>";
$result = queryMysql("SELECT * FROM profiles WHERE user='$user'");
if ($result->num_rows)
{
$row = $result->fetch_array(MYSQLI_ASSOC);
echo stripslashes($row['text']) . "<br style='clear:left;'><br>";
}
}

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

/* function delete_file($path) {
  $fullPath = realpath($path);

  if (is_writable($fullPath)) {
    return unlink($fullPath);
  } else {
    return false;
  }
} */

// Helper function for generating human-readable form errors
function generateBootstrapAlert($text) {
  return "<div class=\"alert alert-danger\" role=\"alert\">$text</div>";
}
?>