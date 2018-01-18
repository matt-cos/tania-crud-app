<?php

// Escapes HTML for output
function escape($html) {
	return htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
}

// converts HH:MM:SS to seconds
function time_to_seconds($time) {
    $timeArr = explode(':', $time);
    $seconds = ($timeArr[0] * 3600) + ($timeArr[1] * 60) + ($timeArr[2]);
 
    return $seconds;
}