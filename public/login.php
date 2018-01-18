<?php 

session_start();

require "../config.php";
require "../common.php";

// when form is submitted, if both fields are filled out:
if (isset($_POST['username']) && isset($_POST['password'])) {

	try {
		$connection = new PDO($dsn, $username, $password, $options);

		// check variables against the database
		$sql = "SELECT password FROM users WHERE username = :username";

		// prepare and execute the sql statement
		$statement = $connection->prepare($sql);
		$statement->bindParam(':username', $_POST['username']);
		$statement->execute();

		// see if this entry exists
		$result = $statement->fetch(\PDO::FETCH_OBJ);
		if ($result == 1) {

			$databasePasswordHash = $result->password;
			$userInputPassword = $_POST['password'];

			// takes hashed password from database and compares it to plain text password input by user
			if (password_verify( $userInputPassword, $databasePasswordHash )) {
				// successfully logged in
				$_SESSION['username'] = $_POST['username'];
				header('Location: index.php');

			} else {

				echo 'Invalid password.';

			}

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