<?php
if (isset($_POST['submit'])){
	if (!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['password']) AND !empty($_POST['passwordConfirm']) ) {
		$pseudo = htmlspecialchars($_POST['pseudo']);
		$mail = htmlspecialchars($_POST['mail']);
		$password = sha1($_POST['password']);
		$passwordConfirm = sha1($_POST['passwordConfirm']);

		$pseudolength = strlen($pseudo);
		if ($pseudolength <= 255){

			$reqPseudo = $bdd->prepare("SELECT * FROM mas_membres WHERE pseudo = ?");
			$reqPseudo->execute(array($pseudo));
			$pseudoExist = $reqPseudo->rowCount();
			if ($pseudoExist == 0) {

				if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {

					if ($password == $passwordConfirm) {

						$bdd->query("INSERT INTO mas_membres (pseudo, password, mail) VALUES ('$pseudo','$password','$mail')");
						header("Location: subscribe.php?subscribed");
					}
					else{
						$error = "Les mots de passe sont différents !";
					}
				}
				else{
					$error = "Ton e-mail n'est pas valide !";
				}
			}
			else{
				$error = "Pseudo déjà pris !";
			}
		}
		else{
			$error = "Pseudo trop long !";
		}
	}
	else{
		$error = "Tous les champs doivent être complétés !";
	}
}
?>