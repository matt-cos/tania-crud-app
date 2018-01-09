<?php 
session_start();
require "../config.php";
require "../common.php";
try {
	$connection = new PDO($dsn, $username, $password, $options);

	// when form is submitted, if both fields are filled out:
	if (isset($_POST['username']) && isset($_POST['password'])) {

		// assign client input values as variables
		$clientUsername = $_POST['username'];
		$clientPassword = $_POST['password'];

		// check variables against the database
		$sql = "SELECT * FROM users WHERE username = '$clientUsername' AND password = '$clientPassword'";

		// prepare and execute the sql statement
		$statement = $connection->prepare($sql);
		$statement->execute();

		// see if this entry exists
		$row_count = $statement->fetchColumn();
		if ($row_count == 1) {
			$_SESSION['username'] = $clientUsername;
		} else {
			$errormsg = "invalid credentials";
			echo $errormsg;
		}


		if (isset($_SESSION['username'])) {
			$username = $_SESSION['username'];
			echo "hi " . $username;
		}
	}
}

catch(PDOException $error) {
	echo $sql . "<br>" . $error->getMessage();
}
?>
<?php include "templates/header.php"; ?>

<h3>LOGIN</h3>

<?php if ($_SESSION['username']) { ?>
	<p>Looks like you're already logged in <?php echo $_SESSION['username']; ?>! What would you like to do?</p>
	<ul>
		<li><a href="read.php"><strong>Read</strong></a> - checkout your friends' runs.</li>
		<li><a href="#"><strong>Create</strong></a> - add a run.</li>
		<li><a href="logout.php"><strong>Logout</strong></a></li>
	</ul>
<?php } else { ?>
	<form method="post">
		<label for="username">Username</label>
		<input type="text" name="username" id="username">
		<label for="password">Password</label>
		<input type="text" name="password" id="password">
		<input type="submit" name="submit" value="Submit">
	</form>
<?php } ?>

<a href="index.php">Back to home</a>

<?php include "templates/footer.php"; ?>

<!-- http://codingcyber.org/simple-login-script-php-and-mysql-64/ -->