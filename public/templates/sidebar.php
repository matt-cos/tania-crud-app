<div class="demo-drawer mdl-layout__drawer mdl-color--blue-grey-900 mdl-color-text--blue-grey-50">
	<header class="demo-drawer-header">
		<img src="images/user.jpg" class="demo-avatar">
		<div class="demo-avatar-dropdown">
			<!-- <span>hello@example.com</span> -->
			<span><?php echo $_SESSION['username']; ?></span>
			<div class="mdl-layout-spacer"></div>
			<button id="accbtn" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
				<i class="material-icons" role="presentation">arrow_drop_down</i>
				<span class="visuallyhidden">Accounts</span>
			</button>
			<ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="accbtn">
				<li class="mdl-menu__item">hello@example.com</li>
				<li class="mdl-menu__item">info@example.com</li>
				<li class="mdl-menu__item"><i class="material-icons">add</i>Add another account...</li>
			</ul>
		</div>
	</header>
	<nav class="demo-navigation mdl-navigation mdl-color--blue-grey-800">
		<a class="mdl-navigation__link" href="dashboard.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">home</i>Home</a>
		<a class="mdl-navigation__link" href="addrun.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">flag</i>Add a Run</a>
		<a class="mdl-navigation__link" href="read.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">people</i>My Friends' Runs</a>
		<a class="mdl-navigation__link" href="logout.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">shopping_cart</i>Log Out</a>
		<div class="mdl-layout-spacer"></div>
		<a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">help_outline</i><span class="visuallyhidden">Help</span></a>
	</nav>
</div>