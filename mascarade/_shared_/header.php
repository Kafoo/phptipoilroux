<!------- HEADER DESKTOP ------->
<header id="headerDesktop" class="desktop">
		
	<img src="img/global/header_title.png" id="branding" style="cursor: pointer;" onclick="window.location='accueil.php';">
	
	<!---- CONNECTION DESKTOP ---->
	<div id="connectionDesktop">

		<!-- Disconnected User -->
		<?php if (!isset($_SESSION['connected'])) {
			?>
			<div id="disconnectedDesktop">
				<form method="POST" action="">
					<input type="text" name="pseudoConnect" placeholder="Pseudo">
					<input type="password" name="passwordConnect" placeholder="Mot de passe">
					<input type="submit" name="connectionSubmit" value="Se connecter">
					<div id="nouveau"><a href="subscribe.php">Nouveau ?</a></div>
				</form>
			</div>
		<?php } ?>

		<!-- Connected User -->
		<?php if (isset($_SESSION['connected'])) {
			?>
			<div id="connectedDesktop">
				<a id="connectedPseudo" href="profil.php"><?=$_SESSION['pseudo']?></a> (<a href="SERVER_UPDATES.php?action=disconnect">Déconnexion</a>)<br/>
				Grade : <?=$_SESSION['grade']?><br/>
				Perso actif : <?=$_SESSION['actifPerso']?><br>
			</div>
		<?php } ?>

	</div>

</header>

<!----- NAV DESKTOP ----->
<nav id="navDesktop" class="desktop">
	<div class="centering">
		<ul>
			<li><a class="nav1" href="accueil.php">ACCUEIL</a></li>|
			<li><a class="nav2" href="aventures.php">AVENTURES</a></li>|
			<li><a class="nav3" href="social.php">SOCIAL</a></li>|
			<li><a class="nav4" href="profil.php">PROFIL</a></li>|
			<li><a class="nav5" href="help.php">HELP</a></li>
		</ul>
	</div>
</nav>


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
		<li><a class="nav1" href="accueil.php">ACCUEIL</a></li>
		<li><a class="nav2" href="aventures.php">AVENTURES</a></li>
		<li><a class="nav3" href="social.php">SOCIAL</a></li>
		<li><a class="nav4" href="profil.php">PROFIL</a></li>
		<li><a class="nav5" href="help.php">HELP</a></li>
	</ul>
</nav>

<!---- CONNECTION MOBILE ---->
<div id="connectionMobile" hidden>

	<!-- Disconnected User -->
	<?php if (!isset($_SESSION['connected'])) {
		?>
		<div id="disconnectedMobile">
			<form method="POST" action="">
				<input type="text" name="pseudoConnect" placeholder="Pseudo">
				<input type="password" name="passwordConnect" placeholder="Mot de passe">
				<input type="submit" name="connectionSubmit" value="Se connecter">
				<div id="nouveau"><a href="subscribe.php">Nouveau ?</a></div>
			</form>
		</div>
	<?php } ?>

	<!-- Connected User -->
	<?php if (isset($_SESSION['connected'])) {
		?>
		<div id="connectedMobile"> 
			<a id="connectedPseudo" href="profil.php"><?=$_SESSION['pseudo']?></a> (<a href="SERVER_UPDATES.php?action=disconnect">Déconnexion</a>)<br/>
			Grade : <?=$_SESSION['grade']?><br/>
			Perso actif : <?=$_SESSION['actifPerso']?>
		</div>
	<?php } ?>

</div>

<!------ ERROR MESSAGE ----->
<?php 
if (isset($error)) {
	?>
	<div id="error">
		<b>Wooooups !</b>
		<br><br>
		<?= $error ?>
		</div>
<?php } ?>

<!------ JAVVASCRIPT STOCK ----->
<div id="userID" hidden><?=$_SESSION['id']?></div>