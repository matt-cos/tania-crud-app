<?php 
session_start();
?>

<?php include "templates/header.php" ?>

<h3>HOMEPAGE</h3>

<?php if ($_SESSION['username']) { ?>
	<p>Welcome back <?php echo $_SESSION['username']; ?>! What would you like to do?</p>
	<ul>
		<li><a href="read.php"><strong>Read</strong></a> - checkout your friends' runs.</li>
		<li><a href="#"><strong>Create</strong></a> - add a run.</li>
		<li><a href="logout.php"><strong>Logout</strong></a></li>
	</ul>
<?php } else { ?>
	<ul>
		<li><a href="signup.php"><strong>Sign Up</strong></a> - join your friends on this run tracking platform. This shouldn't show up if you are already logged in.</li>
		<li><a href="read.php"><strong>Read</strong></a> - checkout your friends' runs</li>
		<li><a href="login.php"><strong>Log in</strong></a> - to use the app. This shouldn't show up if you are already logged in.</li>
	</ul>
<?php } ?>
<!-- https://www.taniarascia.com/create-a-simple-database-app-connecting-to-mysql-with-php/ -->

<?php include "templates/footer.php" ?>