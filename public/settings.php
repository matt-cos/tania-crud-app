<?php

session_start();

if (!isset($_SESSION['username'])):
	header('Location: login.php');
endif;
?>

<?php include "templates/header.php"; ?>

<h3>SETTINGS</h3>

	<ul>
		<li><a href="#"><strong>Update</strong></a> - edit your account.</li>
		<li><a href="#"><strong>Update</strong></a> - edit a run.</li>
		<li><a href="logout.php"><strong>Logout</strong></a></li>
		<li><a href="#"><strong>Delete Account</strong></a></li>
	</ul>

<a href="index.php">Back to home</a>

<?php include "templates/footer.php"; ?>