<?php 
session_start();
?>

<?php include "templates/header.php" ?>

<h3>HOMEPAGE</h3>

<?php if ($_SESSION['username']) { ?>
	<p>Welcome back <?php echo $_SESSION['username']; ?>! What would you like to do?</p>
	<ul>
		<li><a href="read.php"><strong>Read</strong></a> - checkout your friends' runs.</li>
		<li><a href="addrun.php"><strong>Create</strong></a> - add a run.</li>
		<li><a href="dashboard.php"><strong>Read</strong></a> - check out your run history.</li>
		<li><a href="settings.php"><strong>Settings</strong></a> - edit your settings.</li>
		<li><a href="logout.php"><strong>Logout</strong></a></li>
	</ul>
<?php } else { ?>
	<ul>
		<li><a href="signup.php"><strong>Sign Up</strong></a> - join your friends on this run tracking platform.</li>
		<li><a href="read.php"><strong>Read</strong></a> - checkout your friends' runs</li>
		<li><a href="login.php"><strong>Log in</strong></a> - to use the app.</li>
	</ul>
<?php } ?>
<!-- https://www.taniarascia.com/create-a-simple-database-app-connecting-to-mysql-with-php/ -->
<!-- https://joshtronic.com/2015/05/24/basic-page-routing-in-php/ -->

<?php include "templates/footer.php" ?>