<?php
if (isset($_POST['submit'])){

	if (!empty($_POST['persoNom']) AND 
		!empty($_POST['persoNature']) AND 
		!empty($_POST['persoAttitude']) AND 
		!empty($_POST['persoConcept']) AND 
		!empty($_POST['persoDefaut']) AND 
		!empty($_POST['persoPhysique']) AND 
		!empty($_POST['persoClan']) AND 
		!empty($_POST['persoForce']) AND 
		!empty($_POST['persoDexterite']) AND 
		!empty($_POST['persoIntelligence']) AND 
		!empty($_POST['persoCharisme']) AND 
		!empty($_POST['persoPerception']) AND 
		!empty($_POST['persoDisc']) AND 
		!empty($_POST['persoLore']) ) {

		$persoNom = htmlspecialchars($_POST['persoNom'], ENT_QUOTES);
		$persoNature = htmlspecialchars($_POST['persoNature'], ENT_QUOTES);
		$persoAttitude = htmlspecialchars($_POST['persoAttitude'], ENT_QUOTES);
		$persoConcept = htmlspecialchars($_POST['persoConcept'], ENT_QUOTES);
		$persoDefaut = htmlspecialchars($_POST['persoDefaut'], ENT_QUOTES);
		$persoPhysique = htmlspecialchars($_POST['persoPhysique'], ENT_QUOTES);
		$persoClan = strtolower(htmlspecialchars($_POST['persoClan'], ENT_QUOTES));
		$persoForce = htmlspecialchars($_POST['persoForce'], ENT_QUOTES);
		$persoDexterite = htmlspecialchars($_POST['persoDexterite'], ENT_QUOTES);
		$persoIntelligence = htmlspecialchars($_POST['persoIntelligence'], ENT_QUOTES);
		$persoCharisme = htmlspecialchars($_POST['persoCharisme'], ENT_QUOTES);
		$persoPerception = htmlspecialchars($_POST['persoPerception'], ENT_QUOTES);
		$persoDisc = strtolower(htmlspecialchars($_POST['persoDisc'], ENT_QUOTES));
		$persoLore = htmlspecialchars($_POST['persoLore'], ENT_QUOTES);

		$reqNomPerso = $bdd->prepare("SELECT * FROM ss_persos WHERE nom = ?");
		$reqNomPerso->execute(array($persoNom));
		$nomPersoExist = $reqNomPerso->rowCount();

		if ($nomPersoExist == 0) {

			if ($persoForce + $persoDexterite + $persoIntelligence + $persoCharisme + $persoPerception == 25) {

				$membreID = $_SESSION['id'];
				//Rend tout les autres persos inactifs
				$bdd->query("UPDATE ss_persos SET actif = '0' WHERE membreID='$membreID'");

				//Insert le perso dans la BDD
				$bdd -> query ("INSERT INTO ss_persos (membreID, nom, nature, attitude, concept, defaut, physique, clan, forc, dexterite, intelligence, charisme, perception, lore, premDisc) VALUES ('$membreID','$persoNom','$persoNature','$persoAttitude','$persoConcept','$persoDefaut','$persoPhysique','$persoClan','$persoForce','$persoDexterite','$persoIntelligence','$persoCharisme','$persoPerception','$persoLore','$persoDisc')" );

				header("Location: profil.php");
			}
			else{
				$error = "La somme de tes caractéristiques doit être 25 !";
			}
		}
		else{
			$error = "Ce nom de personnage est déjà pris !";
		}
	}
	else{
		$error = "Tous les champs doivent être complétés ! (n'oublie pas de séléctionner un clan et une discipline)";
	}
}

?>