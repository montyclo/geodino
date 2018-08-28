<?php

include('include/db.php');
include('include/logs.php');


mylog("HTTP session from " . $_SERVER['HTTP_X_FORWARDED_FOR'] . " server " . $_SERVER['REMOTE_ADDR']);
mylog("Trying database connection: " 
		. MYSQL_HOST . ", " 
		. MYSQL_USER . ", " 
		. MYSQL_PASS . ", " 
		. MYSQL_DB . ", " 
		. MYSQL_PORT . " ...");

$mysqli = mysqli_connect( 
		MYSQL_HOST, 
		MYSQL_USER, 
		MYSQL_PASS, 
		MYSQL_DB, 
		MYSQL_PORT );

// Check connection
if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	mylog("Failed to connect to MySQL: " . mysqli_connect_error());
}
else {
	mysqli_close( $mysqli );
	echo "Database connection OK!";
	mylog("Database connection OK!");
}

?>