<?php

include('include/db.php');

//echo MYSQL_HOST . ", " . MYSQL_USER . ", " . MYSQL_PASS . ", " . MYSQL_DB . ", " . MYSQL_PORT . "<br>";

$mysqli = mysqli_connect( MYSQL_HOST, MYSQL_USER, MYSQL_PASS, MYSQL_DB, MYSQL_PORT );

// Check connection
if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
else {
	mysqli_close( $mysqli );
	echo "Database connection OK!";
}

?>