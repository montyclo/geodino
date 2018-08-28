<?php

define("LOGS_ENABLED", 1); 
define("LOG_PREFIX", "/opt/app-root/src/log/webapp");

function mylog($message) {

	if (!LOGS_ENABLED) {
		return;
	}

	$now = getdate();
	$year = sprintf("%02d", $now["year"]);
	$month = sprintf("%02d", $now["mon"]);
	$day = sprintf("%02d", $now["mday"]);

	$logFile = LOG_PREFIX;
	$logFile .= "_"; 
	$logFile .= $year;
	$logFile .= "-"; 
	$logFile .= $month;
	$logFile .= "-";
	$logFile .= $day;
	$logFile .= ".log";

	$hours = sprintf("%02d", $now["hours"]);
	$minutes = sprintf("%02d", $now["minutes"]);
	$seconds = sprintf("%02d", $now["seconds"]);
	error_log("[" . $day . "/" .  $month . "/" . $now["year"] . " " . $hours . ":" . $minutes . ":" . $seconds . "] " . $message . "\r\n", 3, str_replace("{DATE}", "$year$month$day", $logFile));
}

