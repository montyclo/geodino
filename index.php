<?php

include('include/db.php');

//echo MYSQL_HOST . ", " . MYSQL_USER . ", " . MYSQL_PASS . ", " . MYSQL_DB . ", " . MYSQL_PORT . "<br>";

$mysqli = mysqli_connect( MYSQL_HOST, MYSQL_USER, MYSQL_PASS, MYSQL_DB, MYSQL_PORT );
mysqli_close( $mysqli );


echo "Database connection OK!";

?>