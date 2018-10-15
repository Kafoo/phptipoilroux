<!------- HEADER MOBILE ------->
<header id="headerMobile" class="mobile">
	<img id="navLogo" src="img/mobile/menu.png">	
	<img id="userLogo" src="img/mobile/userlogo.png">


	<!---- NAV MOBILE ---->
	<nav id="navMobile" hidden>
		<div id="navMobileHead">
			<img id="croix" src="img/mobile/croix.png">
		</div>

		<ul>
			<li><a href="accueil.php">ACCUEIL</a></li>
			<li><a href="aventures.php">AVENTURES</a></li>
			<li><a href="social.php">SOCIAL</a></li>
			<li><a href="profil.php">PROFIL</a></li>
			<li><a href="help.php">HELP</a></li>
		</ul>
	</nav>


</header>

<!------- HEADER ------->
<header id="headerDesktop" class="desktop">
		
	<img src="img/global/header_title.png" id="branding" style="cursor: pointer;" onclick="window.location='accueil.php';">
	
	<div id="connectionDesktop">
		<form method="POST" action="">
			<input type="text" name="pseudoConnect" placeholder="Pseudo">
			<input type="password" name="passwordConnect" placeholder="Mot de passe">
			<input type="submit" name="submitConnect" value="Se connecter">
			<div id="nouveau">Nouveau ?</div>
		</form>
	</div>

</header>

<!----- NAV DESKTOP ----->
<nav id="navDesktop" class="desktop">
	<div class="centering">
		<ul>
			<li><a href="accueil.php">ACCUEIL</a></li>|
			<li><a href="aventures.php">AVENTURES</a></li>|
			<li><a href="social.php">SOCIAL</a></li>|
			<li><a href="profil.php">PROFIL</a></li>|
			<li><a href="help.php">HELP</a></li>
		</ul>
	</div>
</nav>