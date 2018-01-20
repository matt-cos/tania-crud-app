<?php

session_start();

if (!isset($_SESSION['username'])):
	header('Location: login.php');
endif;

require "../config.php";
require "../common.php";

?>

<?php include "templates/header.php"; ?>

<div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
	
	<?php include "templates/layout-header.php"; ?>
	
	<?php include "templates/sidebar.php"; ?>

	<main class="mdl-layout__content mdl-color--grey-100">
		<div class="mdl-grid demo-content">
			<div class="mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
				
				<h3>SETTINGS</h3>

				<ul>
					<li><a href="#"><strong>Update</strong></a> - edit your account.</li>
					<li><a href="#"><strong>Update</strong></a> - edit a run.</li>
					<li><a href="logout.php"><strong>Logout</strong></a></li>
					<li><a href="#"><strong>Delete Account</strong></a></li>
				</ul>

			</div>

			<?php include "templates/demo-content.php"; ?>
			
			<?php include "templates/cards.php"; ?>

		</div>
	</main>
</div>

<?php include "templates/svg.php"; ?>

<?php include "templates/footer.php"; ?>