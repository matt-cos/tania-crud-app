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
	// http://www.hashbangcode.com/blog/converting-and-decimal-time-php
}

// converts HH:MM:SS to seconds
function seconds_to_time($time) {

	$hours = str_pad(floor($time / 3600), 2, "0", STR_PAD_LEFT);

	$secondsLeftoverFromHours = $time % 3600;

	$mins = str_pad(floor($secondsLeftoverFromHours / 60), 2, "0", STR_PAD_LEFT);

	$seconds = str_pad($secondsLeftoverFromHours % 60, 2, "0", STR_PAD_LEFT);

	return $hours . ":" . $mins . ":" . $seconds;
	// http://www.hashbangcode.com/blog/converting-and-decimal-time-php
}