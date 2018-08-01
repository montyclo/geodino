<?php

//getenv('OPENSHIFT_MYSQL_DB_HOST');

//define ( 'MYSQL_USER', "userE42");
//define ( 'MYSQL_PASS', "KSYn2UmfGeSs8f0t");
//define ( 'MYSQL_HOST', getenv( 'MYSQL_SERVICE_HOST' );
//define ( 'MYSQL_PORT', $_ENV['MYSQL_SERVICE_PORT']);
//define ( 'MYSQL_HOST', $_ENV['MYSQL_SERVICE_HOST']);

define ( 'MYSQL_USER',	getenv( 'MYSQL_USER' ) );
define ( 'MYSQL_PASS',	getenv( 'MYSQL_PASSWORD' ) );
define ( 'MYSQL_HOST',	getenv( 'MYSQL_SERVICE_HOST' ) );
define ( 'MYSQL_PORT',	getenv( 'MYSQL_SERVICE_PORT' ) );
define ( 'MYSQL_DB', 	getenv( 'MYSQL_DATABASE' );


?>