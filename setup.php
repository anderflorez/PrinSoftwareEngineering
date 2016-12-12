<?php
$dbhost = "localhost";
$dbname = "daires2014";
$dbuser = "daires2014";
$dbpass = "Linkin732";

$conn = new mysqli($dbhost,$dbuser,$dbpass,$dbname);

if($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE TABLE users (
userid INT NOT NULL AUTO_INCREMENT,
email VARCHAR(50) NOT NULL UNIQUE,
pass VARCHAR(80) NOT NULL,
type CHAR(1) NOT NULL DEFAULT 'R',
fname VARCHAR(50) NOT NULL,
lname VARCHAR(50) NOT NULL,
photo VARCHAR(50),
PRIMARY KEY (userid)
)";
if ($conn->query($sql) === TRUE) {
	echo "Table users created successfully<br>";
} else {
	echo "Error creating table: " . $conn->error . "<br>";
}

$sql = "CREATE TABLE events (
eid INT UNSIGNED NOT NULL AUTO_INCREMENT,
userid INT NOT NULL,
category VARCHAR(50) NOT NULL,
name VARCHAR(50) NOT NULL,
location VARCHAR(50) NOT NULL,
date DATE NOT NULL,
description VARCHAR(4096) NOT NULL,
photo VARCHAR(50) NOT NULL,
votes INT UNSIGNED NOT NULL DEFAULT 0,
PRIMARY KEY (eid),
FOREIGN KEY (userid) REFERENCES members(userid)
)";
if ($conn->query($sql) === TRUE) {
	echo "Table events created successfully<br>";
} else {
	echo "Error creating table: " . $conn->error . "<br>";
}

$sql = "CREATE TABLE reports (
rid INT NOT NULL AUTO_INCREMENT,
userid INT NOT NULL,
category VARCHAR(50) NOT NULL,
name VARCHAR(50) NOT NULL,
location VARCHAR(50) NOT NULL,
date DATE NOT NULL,
description VARCHAR(4096) NOT NULL,
photo VARCHAR(50) NOT NULL,
status VARCHAR(50) NOT NULL DEFAULT 'submitted',
votes INT UNSIGNED NOT NULL DEFAULT 0,
PRIMARY KEY (rid),
FOREIGN KEY (userid) REFERENCES members(userid)
)";
if ($conn->query($sql) === TRUE) {
	echo "Table reports created successfully<br>";
} else {
	echo "Error creating table: " . $conn->error . "<br>";
}

$sql = "CREATE TABLE ecomments (
eid INT UNSIGNED NOT NULL,
userid INT NOT NULL,
time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
comment VARCHAR(4096) NOT NULL,
PRIMARY KEY (eid, userid, time),
FOREIGN KEY (eid) REFERENCES events(eid),
FOREIGN KEY (userid) REFERENCES members(userid)
)";
if ($conn->query($sql) === TRUE) {
	echo "Table ecomments created successfully<br>";
} else {
	echo "Error creating table: " . $conn->error . "<br>";
}

$sql = "CREATE TABLE rcomments (
rid INT UNSIGNED NOT NULL,
userid INT NOT NULL,
time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
comment VARCHAR(4096) NOT NULL,
PRIMARY KEY (rid, userid, time),
FOREIGN KEY (rid) REFERENCES reports(rid),
FOREIGN KEY (userid) REFERENCES members(userid)
)";
if ($conn->query($sql) === TRUE) {
	echo "Table rcomments created successfully<br>";
} else {
	echo "Error creating table: " . $conn->error . "<br>";
}

$conn->close();
?>