<?php 

session_start();

require "../config.php";
require "../common.php";

// when form is submitted, if both fields are filled out:
if (isset($_POST['username']) && isset($_POST['password'])) {

	try {
		$connection = new PDO($dsn, $username, $password, $options);

		// assign client input values as variables
		// $clientUsername = $_POST['username'];
		// $clientPassword = $_POST['password'];

		// check variables against the database
		$sql = "SELECT password FROM users WHERE username = :username";
		// $sql = "SELECT * FROM users WHERE username = '$clientUsername' AND password = '$clientPassword'";

		// prepare and execute the sql statement
		$statement = $connection->prepare($sql);
		$statement->bindParam(':username', $_POST['username']);
		$statement->execute();

		// see if this entry exists
		// $result = $statement->fetchColumn();
		$result = $statement->fetch(\PDO::FETCH_OBJ);
		if ($result == 1) {
			// check to see if the passwords match
			// normally we would check to see if the hashes matched
			// $userInputPasswordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);
			// $databasePasswordHash = password_hash($result->password, PASSWORD_DEFAULT);
			$databasePasswordHash = $result->password;
			// $databasePasswordHash = '$2y$10$tQmqB8tdeQgt3SiW.GpiTOw';
			$gobble = $_POST['password'];
			
			echo "user input username: " . $_POST['username'];
			echo "<br>";

			echo "user input password: " . $_POST['password'];
			echo "<br>";	
			// echo "user input password, hashed: " . $userInputPasswordHash;
			// echo "<br>";
			// echo "hardcoded password: " . $databasePasswordHash;
			// echo "<br>";
			echo "password in database for this user: " . $result->password; // this is the stored password
			echo "<br>";

			if (password_verify( $_POST['password'], $databasePasswordHash )) {
				echo "they match";
			} else {
				echo "they DON'T match";
			}

			// http://php.net/manual/en/function.password-verify.php

			echo "<br>";
			// echo "password in database for this user, hashed: " . $databasePasswordHash; // this is the stored password
			// echo "<br>";

			// takes plain text password from database and compares it to hashed password from user input. more of a proof of concept really.
			if (password_verify( $_POST['password'], $databasePasswordHash )) {

				// successfully logged in
				$_SESSION['username'] = $_POST['username'];
				header('Location: index.php');

			} else {

				echo 'Invalid password.';

			}

			// if($result->password === $_POST['password']) {
				
			// }
		} else {
			$errormsg = "invalid credentials";
			echo $errormsg;
		}
	}
	catch(PDOException $error) {
		// TODO: remove getMessage for production site
		echo $sql . "<br>" . $error->getMessage();
	}
}

?>
<?php include "templates/header.php"; ?>

<h3>LOGIN</h3>

	<form method="post">
		<label for="username">Username</label>
		<input type="text" name="username" id="username" value="userName">
		<label for="password">Password</label>
		<input type="text" name="password" id="password">
		<input type="submit" name="submit" value="Submit">
	</form>

<br>
<a href="signup.php">Don't have an account? Sign up here</a>
<br>
<a href="index.php">Back to home</a>

<?php include "templates/footer.php"; ?>

<!-- http://codingcyber.org/simple-login-script-php-and-mysql-64/ -->