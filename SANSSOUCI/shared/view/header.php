<?php
//-----------SI TENTATIVE DE CONNEXION :-----------
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
			$_SESSION['connected'] = 'connected';
			if (basename($_SERVER['PHP_SELF']) == "subscribe.php"){
				header("Location: home.php");
			} 
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
			<div id="branding">
				<div id="brandingText" style="cursor: pointer;" onclick="window.location='home.php';">SANS SOUCI</div>
			</div>
			<nav id="navDesktop">
				<div style="display: inline-block;"><a href="monde.php">MONDE</a>
				<a href="histoire.php">HISTOIRE</a></div>
				<div style="display: inline-block;"><a href="profil.php">PROFIL</a>
				<a href="autres.php">AUTRES</a></div>			
			</nav>


			<nav class="navMobileGrid" id="navMobile" style="cursor: pointer;">
				<div id="navMobile1" onclick="window.location='monde.php';">MONDE</div>
				<div id="navMobile2" onclick="window.location='histoire.php';">HISTOIRE</div>
				<div id="navMobile3" onclick="window.location='profil.php';">PROFIL</div>
				<div id="navMobile4" onclick="window.location='autres.php';">AUTRES</div>
			</nav>

			
			<?php
			//ERREUR DE CONNEXION
			if (isset($erreurConnect)) {
				echo '
				<div id="connectionDesktop">
				' . $erreurConnect . '<br/><a href="home.php">Réessayer</a>
				</div>
				';
			}
			//MEMBRE CONNECTE
			elseif (isset($_SESSION['connected'])) {
				echo '
				<div id="connectedDesktop">
				<a id="connectedPseudo" href="profil.php">' . $_SESSION['pseudo'] . '</a> (<a href="deconnect.php">Déconnexion</a>)<br/>
				Perso<br/>
				Quelques stats ?
				
				</div>
				';
			}
			//MEMBRE DECONNECTE
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

			
			<div id="connectionMobile" style="cursor: pointer;" onclick="window.location='http://youtube.com';">CONNEXION</div>
		</header>