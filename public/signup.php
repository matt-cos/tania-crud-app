<?php 

session_start();

if (isset($_POST['submit'])) {
	require "../config.php";
	require "../common.php";

	try {
		$connection = new PDO($dsn, $username, $password, $options);

		$hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

		$user_email = $_POST['email'];

		if (filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
			echo "Email address '" . $_POST['email'] . "' is considered valid.\n";

			$new_user = array(
				"firstname" => $_POST['firstname'],
				"lastname"  => $_POST['lastname'],
				"username"  => $_POST['username'],
				// "password"  => $_POST['password'],
				"password"  => $hashed_password,
				// "email"     => $_POST['email'],
				"email"     => $user_email,
				"age"       => $_POST['age'],
				"location"  => $_POST['location'],
			);

			$sql = sprintf(
					"INSERT INTO %s (%s) values (%s)",
					"users",
					implode(", ", array_keys($new_user)),
					":" . implode(", :", array_keys($new_user))
			);

			$statement = $connection->prepare($sql);
			$statement->execute($new_user);

		} else {
			echo "Email address '" . $_POST['email'] . "' is considered invalid.\n";
		}
		
	}

	catch(PDOException $error) {
		// TODO: remove getMessage for production site
		echo $sql . "<br>" . $error->getMessage();
	}
}


?>

<?php include "templates/header.php"; ?>


<?php if (isset($_POST['submit']) && $statement) { ?>
	<blockquote><?php echo $_POST['firstname']; ?> successfully added.</blockquote>
<?php } ?>

<?php if ($_SESSION['username']) { ?>
	<blockquote><?php echo $_SESSION['username']; ?> is logged in.</blockquote>
<?php } ?>

<h2>Add a user</h2>

<form method="post">
	<label for="firstname">First Name</label>
	<input type="text" name="firstname" id="firstname">
	<label for="lastname">Last Name</label>
	<input type="text" name="lastname" id="lastname">

	<label for="username">Username</label>
	<input type="text" name="username" id="username">
	<label for="password">Password</label>
	<input type="text" name="password" id="password">

	<label for="email">Email Address</label>
	<input type="text" name="email" id="email">
	<label for="age">Age</label>
	<input type="text" name="age" id="age">
	<label for="location">Location</label>
	<input type="text" name="location" id="location">
	<input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Back to home</a>

<?php include "templates/footer.php"; ?>




























