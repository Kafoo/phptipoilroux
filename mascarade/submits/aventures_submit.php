<?php
if (isset($_POST['submit'])) {
	
	if (isset($_POST['message']) AND !empty($_POST['message'])) {
		
		$dat = sprintf('%02d', getdate()['mday']) . '/' . 
		sprintf('%02d', getdate()['mon']) . '/' . 
		getdate()['year'] . '--' . 
		sprintf('%02d', (getdate()['hours']+2)) . ':' . 
		sprintf('%02d', getdate()['minutes']);

		$contenu = htmlspecialchars(str_replace(array('<p>','</p>'), '', $_POST['message']), ENT_QUOTES);
		$userID = $_SESSION['id'];
		$avID = $_GET['avID'];

		$req = $bdd->query("
			SELECT mas_persos.id
			FROM mas_persos
			JOIN mas_relation_perso2aventure 
			ON mas_persos.id=mas_relation_perso2aventure.persoID
			WHERE mas_relation_perso2aventure.avID='$avID'
			AND mas_persos.userID='$userID'
			");
		$persoID = $req->fetch()['id'];

		$bdd->query("INSERT INTO mas_messages_aventure (dat, auteurID, contenu, persoID, avID) VALUES ('$dat', '$userID', '$contenu', '$persoID', '$avID')");
		/*Incrémente de 1 le nombre de message postés pour ce compte*/
		$bdd->query("UPDATE mas_membres SET nombremsg=nombremsg+1 WHERE id=$userID");

	}else{
		$error = "Tu dois écrire quelque chose dans ta réponse !";
	}
}


?>