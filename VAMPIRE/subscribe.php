<?php
include("shared/refresh.php");
include("shared/connectDB.php");

if (isset($_POST['submit'])){
	if (!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['password']) AND !empty($_POST['passwordConfirm']) ) {
		$pseudo = htmlspecialchars($_POST['pseudo']);
		$mail = htmlspecialchars($_POST['mail']);
		$password = sha1($_POST['password']);
		$passwordConfirm = sha1($_POST['passwordConfirm']);

		$pseudolength = strlen($pseudo);
		if ($pseudolength <= 255){

			$reqPseudo = $bdd->prepare("SELECT * FROM ss_membres WHERE pseudo = ?");
			$reqPseudo->execute(array($pseudo));
			$pseudoExist = $reqPseudo->rowCount();
			if ($pseudoExist == 0) {

				if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {

					if ($password == $passwordConfirm) {

						$bdd->query("INSERT INTO ss_membres (pseudo, password, mail) VALUES ('$pseudo','$password','$mail')");
						//Connexion auto après l'inscription, et redirection vers le profil
						$reqUser = $bdd->prepare("SELECT * FROM ss_membres WHERE pseudo=? AND password=?");
						$reqUser->execute(array($pseudo, $password));
						$userExist = $reqUser->rowCount();
						$userInfo = $reqUser->fetch();
						$_SESSION['id'] = $userInfo['id'];
						$_SESSION['pseudo'] = $userInfo['pseudo'];
						$_SESSION['password'] = $userInfo['password'];
						$_SESSION['connected'] = 'connected';
						header("Location: profil.php");
					}
					else{
						$erreur = "Les mots de passe sont différents !";
					}
				}
				else{
					$erreur = "Ton e-mail n'est pas valide !";
				}
			}
			else{
				$erreur = "Pseudo déjà pris !";
			}
		}
		else{
			$erreur = "Pseudo trop long !";
		}
	}
	else{
		$erreur = "Tous les champs doivent être complétés !";
	}
}
?>


<!DOCTYPE html>
<html>
<head>
	<?php include("shared/headconfig.php"); ?>
	<link rel="stylesheet" type="text/css" href="css/subscribe.css">
	<title>VAMPIRE - Inscription</title>
</head>
<body>

	<div class="mainGrid">

	<!--HEADER-->
		<?php include("shared/view/header.php"); ?>

	<!--SECTION-->
		<section class="sectionGrid">
			<div id="subscribeBlock">
				<h1>INSCRIPTION</h1>
				<form method="POST" action="">
					<table>
						<tr>
							<td>
								<label for="pseudo">Pseudo :</label>
							</td>
							<td>
								<input type="text" name="pseudo" placeholder="Pseudo">
							</td>
						</tr>
						<tr>
							<td>
								<label for="mail">Mail :</label>
							</td>
							<td>
								<input type="text" name="mail" placeholder="Ton mail">
							</td>
							<td>
								<img src="img/help.png" onmouseover="showHelp()" onmouseout="hideHelp()">
								<div id="help" hidden>Pour information, je te demande ton mail pour pouvoir vendre tout ce que je sais de toi à des services complètements secrets avides de pouvoir et d'argent. Cordialement. <i>(Non en vrai c'est juste pour être notifié des nouveaux messages si tu le souhaites =P)</i></div>
							</td>
						</tr>
						<tr>
							<td>
								<label for="password">Mot de passe :</label>
							</td>
							<td>
								<input type="password" name="password" placeholder="Mot de passe">
							</td>
						</tr>
						<tr>
							<td>
								<label for="passwordConfirm">Confirmation :</label>
							</td>
							<td>
								<input type="password" name="passwordConfirm" placeholder="Mot de passe">
							</td>
						</tr>
					</table>
					<br/>
					<input type="submit" name="submit" value="Je m'inscris !">
				</form>
				<br/>
				<span>
					<?php if (isset($erreur)){echo $erreur;}?>
				</span>
			</div>


		</section>

	<!--FOOTER-->
		<?php include("shared/view/footer.php"); ?>

	</div>


<script type="text/javascript" src="js/subscribe.js"></script>
</body>
</html> 