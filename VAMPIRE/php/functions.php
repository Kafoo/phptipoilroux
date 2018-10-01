<?php


function getRealDate(){
	return
	sprintf('%02d', getdate()['mday']) . '/' . 
	sprintf('%02d', getdate()['mon']) . '/' . 
	getdate()['year'] . ' ' . 
	sprintf('%02d', (getdate()['hours']+2)) . ':' . 
	sprintf('%02d', getdate()['minutes']);
}



function showPersosList(){
	//echo une liste des noms de persos séparés par des saut de ligne, avec la possibilité de les supprimer ou de les activer. Propose d'en créer un s'il n'y en a pas, et echo "membre non connecté" le cas échéant.
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
				$persoID = $reqPersoID->fetch()[0];

				echo '
				<a class="infoMembre" href="ficheperso.php?persoID='.$persoID.'">'.$row[0].'</a><br>
				(<a class="confirm" href="SERVER_UPDATES.php?action=supprimePerso&membreID='.$membreID.'&persoID='.$persoID.'">Supprimer</a> - 
				<a href="SERVER_UPDATES.php?action=activePerso&membreID='.$membreID.'&persoID='.$persoID.'">Activer</a>)
				';
				if ($i < $nombrePerso) {
					echo '<br><br>';
				}
				$i++;
			}
		}
	}
}


function getActifPerso(){
	global $bdd, $membreID;
	if (!isset($_SESSION['connected'])) {
		echo "Membre non connecté";
	}
	else{
		$reqNomPerso = $bdd->query("SELECT nom FROM ss_persos WHERE membreID = '$membreID' AND actif = '1' ");
		$nombrePerso = $reqNomPerso->rowCount();
		if ($nombrePerso == 0) {
			echo '<a class="infoMembre" href="creaperso.php">Créer un perso</a>';
		}
		else{
			$i = 1;
			while ($row = $reqNomPerso->fetch()) {

				$reqPersoID = $bdd->query("SELECT id FROM ss_persos WHERE nom = '$row[0]'");

				echo '<a class="infoMembre" href="ficheperso.php?persoID='.$reqPersoID->fetch()[0].'">'.$row[0].'</a>';
				$i++;
			}
		}
	}
}

function getActivePerso(){
	global $bdd, $membreID;
	if (!isset($_SESSION['connected'])) {
		return "Non-connecté";
	}
	else{
		$reqNomPerso = $bdd->query("SELECT nom FROM ss_persos WHERE membreID = '$membreID' AND actif = '1' ");
		$nomPerso = $reqNomPerso->fetch()[0];
		$nombrePerso = $reqNomPerso->rowCount();
		if ($nombrePerso == 0) {
			return '<a class="infoMembre" href="creaperso.php">Aucun perso</a>';
		}
		else{
			return $nomPerso;
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
	return nl2br($reqInfoPerso->fetch()[0]);
}

function getInfoMessage($messageID, $info){
	global $bdd;
	$reqInfoMessage = $bdd->query("SELECT $info FROM ss_messages_aventure WHERE id = '$messageID'");
	return nl2br($reqInfoMessage->fetch()[0]);
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