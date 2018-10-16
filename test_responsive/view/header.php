<!------- HEADER MOBILE ------->
<header id="headerMobile" class="mobile">
	<img id="navLogo" src="img/mobile/menu.png">
	<img id="croixNav" src="img/mobile/croix.png" hidden>
	<img id="croixConnection" src="img/mobile/croix.png" hidden>
	<img id="connectionLogo" src="img/mobile/userlogo.png">

</header>

<!---- NAV MOBILE ---->
<nav id="navMobile" hidden>
	<ul>
		<li><a href="accueil.php">ACCUEIL</a></li>
		<li><a href="aventures.php">AVENTURES</a></li>
		<li><a href="social.php">SOCIAL</a></li>
		<li><a href="profil.php">PROFIL</a></li>
		<li><a href="help.php">HELP</a></li>
	</ul>
</nav>

<!---- CONNECTION MOBILE ---->
<nav id="connectionMobile" hidden>
	<form method="POST" action="">
		<input type="text" name="pseudoConnect" placeholder="Pseudo">
		<input type="password" name="passwordConnect" placeholder="Mot de passe">
		<input type="submit" name="submitConnect" value="Se connecter">
		<div id="nouveau">Nouveau ?</div>
	</form>
</nav>

<!------- HEADER DESKTOP ------->
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