<?php 

session_start();

if (!isset($_SESSION['username'])):
	header('Location: login.php');
endif;

$pageName = "My Dashboard";

require "../config.php";
require "../common.php";

try {
	$connection = new PDO($dsn, $username, $password, $options);

	$username = $_SESSION['username'];

	$sql = "SELECT * FROM runs WHERE username = :username";

	$statement = $connection->prepare($sql);
	$statement->bindParam(':username', $username, PDO::PARAM_STR);
	$statement->execute();

	$result = $statement->fetchAll(PDO::FETCH_ASSOC);

	$jsonResults = json_encode($result);


}

catch(PDOException $error) {
	echo $sql . "<br>" . $error->getMessage();
}

?>

<?php include "templates/header.php"; ?>

<div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
	
	<?php include "templates/layout-header.php"; ?>
	
	<?php include "templates/sidebar.php"; ?>

	<main class="mdl-layout__content mdl-color--grey-100">
		<div class="mdl-grid demo-content">
			<div class="mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
				
				<?php echo $jsonResults; ?>

			</div>

			<?php include "templates/demo-content.php"; ?>
			
			<?php include "templates/cards.php"; ?>

		</div>
	</main>
</div>

<?php include "templates/svg.php"; ?>

<!-- can use wunderground API for historical weather -->
<!-- https://www.wunderground.com/weather/api/d/docs?d=data/history -->

<?php include "templates/footer.php"; ?>