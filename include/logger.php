<?php

define("LOGS_ENABLED", 1); 
define("LOG_FILE", "/opt/app-root/src/log/webapp.log");

function mylog($message) {

	if (!LOGS_ENABLED) {
		return;
	}

	$now = getdate();
	$year = sprintf("%02d", $now["year"]);
	$month = sprintf("%02d", $now["mon"]);
	$day = sprintf("%02d", $now["mday"]);
	$hours = sprintf("%02d", $now["hours"]);
	$minutes = sprintf("%02d", $now["minutes"]);
	$seconds = sprintf("%02d", $now["seconds"]);
	error_log("[" . $day . "/" .  $month . "/" . $now["year"] . " " . $hours . ":" . $minutes . ":" . $seconds . "] " . $message . "\r\n", 3, str_replace("{DATE}", "$year$month$day", LOG_FILE));
}

