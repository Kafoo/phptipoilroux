<!-- 




get joueur(id)
get persos(joueur)
get carac(carac, perso)



BDD MEMBRE
-> id, pseudo, password, mail, grade

BDD PERSOS
-> id, nom, carac

BDD DISCIPLINES
-> id, nom, description

BDD MESSAGES
-> id, auteur, date, contenu




Nom -> "persoNom"
Nature -> "persoNature"
Attitude -> "persoAttitude"
Concept -> "persoConcept"
Défaut -> "persoDefaut"
Physique -> "persoPhysique"

Clan -> "persoClan"
Carac -> "persoCarac"
Discipline -> "persoDisc"
Lore -> "persoLore" -->

<?php

function getPersos(){
	//echo une liste des noms de persos séparés par un tiret + lien vers fiche perso, propose d'en créer un s'il n'y en a pas, et echo "membre non connecté" le cas échéant.
	global $bdd, $membreID;
	if (!isset($_SESSION['connected'])) {
		echo "Membre non connecté";
	}
	else{
		$reqNomPerso = $bdd->query("SELECT nom FROM ss_persos WHERE membreID = '$membreID' ORDER BY id");
		$nombrePerso = $reqNomPerso->rowCount();
		if ($nombrePerso == 0) {
			echo '<a class="infoMembre" href="creaperso.php">Créer un perso</a>';
		}
		else{
			$i = 1;
			while ($row = $reqNomPerso->fetch()) {

				$reqPersoID = $bdd->query("SELECT id FROM ss_persos WHERE nom = '$row[0]'");

				echo '<a class="infoMembre" href="ficheperso.php?persoID='.$reqPersoID->fetch()[0].'">'.$row[0].'</a>';
				if ($i < $nombrePerso) {
					echo ' - ';
				}
				$i++;
			}
		}
	}
}

function getInfoMembre($membreID, $info){
	global $bdd;
	$reqInfoMembre = $bdd->query("SELECT $info FROM ss_membres WHERE id = '$membreID'");
	return $reqInfoMembre->fetch()[0];
}

function getInfoPerso($persoID, $info){
	global $bdd;
	$reqInfoPerso = $bdd->query("SELECT $info FROM ss_persos WHERE id = '$persoID'");
	return $reqInfoPerso->fetch()[0];
}

function getClanDesc($clan){
	global $bdd;
	$reqClanDesc = $bdd->query("SELECT description FROM ss_clanshtml WHERE nom = '$clan'");
	return $reqClanDesc->fetch()[0];
}

function getInfoDisc($nomDisc){
	global $bdd;
	$reqInfoDisc = $bdd->query("SELECT description FROM ss_disciplines WHERE nom = '$nomDisc'");
	return $reqInfoDisc->fetch()[0];
}

?>