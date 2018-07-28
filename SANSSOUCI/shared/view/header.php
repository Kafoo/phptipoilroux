<?php
if (isset($_POST['submitConnect'])) {

	$pseudoConnect = htmlspecialchars($_POST['pseudoConnect']);
	$passwordConnect = sha1($_POST['passwordConnect']);

	if (!empty($_POST['pseudoConnect']) AND !empty($_POST['passwordConnect'])) {

		$reqUser = $bdd->prepare("SELECT * FROM ss_membres WHERE pseudo=? AND password=?");
		$reqUser->execute(array($pseudoConnect, $passwordConnect));
		$userExist = $reqUser->rowCount();
		if ($userExist == 1) {
			$userInfo = $reqUser->fetch();
			$_SESSION['id'] = $userInfo['id'];
			$_SESSION['pseudo'] = $userInfo['pseudo'];
			$_SESSION['password'] = $userInfo['password'];
			$_SESSION['connected'] = 'bouh';
		}
		else{
			$erreurConnect = "Pseudo ou Mot de passe incorrect !";
		}
	}
	elseif (!empty($_POST['passwordConnect'])){
		$erreurConnect = "Pseudo ?";
	}
	elseif (!empty($pseudoConnect)){
		$erreurConnect = "Mot de passe ?";
	}
	else{
		$erreurConnect = "Rempli quelque chose wesh";
	}

}

?>

		<header class="headerGrid">
			<div id="branding" style="cursor: pointer;" onclick="window.location='http://youtube.com';">
				SANS SOUCI
			</div>
			<nav id="navDesktop">
				<div style="display: inline-block;"><a href="monde.php">MONDE</a>
				<a href="histoire.php">HISTOIRE</a></div>
				<div style="display: inline-block;"><a href="personnage.php">PERSONNAGE</a>
				<a href="autres.php">AUTRES</a></div>			
			</nav>
			<nav class="navMobileGrid" id="navMobile" style="cursor: pointer;">
				<div id="navMobile1" onclick="window.location='monde.php';">MONDE</div>
				<div id="navMobile2" onclick="window.location='histoire.php';">HISTOIRE</div>
				<div id="navMobile3" onclick="window.location='personnage.php';">PERSONNAGE</div>
				<div id="navMobile4" onclick="window.location='autres.php';">AUTRES</div>
			</nav>

			
			<?php
			if (isset($erreurConnect)) {
				echo $erreurConnect . '<a href="home.php">Réessayer</a>';
			}

			elseif (isset($_SESSION['connected'])) {
				echo $_SESSION['pseudo'] . ' est connecté ! <a href="deconnect.php">Déconnexion</a>';
			}

			else{
				echo '
				<div id="connectionDesktop">
					<form method="POST" action="">
						<input type="text" name="pseudoConnect" placeholder="Pseudo">
						<input type="password" name="passwordConnect" placeholder="Mot de passe">
						<input type="submit" name="submitConnect" value="Se connecter">
					</form>
					<div id="subscribe"><a href="subscribe.php">Nouveau ?</a></div>
				</div>
				';
			}

			?>
				<div id="connectedDesktop" hidden>
				
				</div>
			<div id="connectionMobile" style="cursor: pointer;" onclick="window.location='http://youtube.com';">CONNEXION</div>
			<div id="subscribeMobile" style="cursor: pointer;" onclick="window.location='http://youtube.com';">INSCRIPTION</div>
		</header>