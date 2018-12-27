<?php
if (isset($_POST['submit'])) {
	
	if (isset($_POST['message']) AND !empty($_POST['message'])) {
		
		$dat = sprintf('%02d', getdate()['mday']) . '/' . 
		sprintf('%02d', getdate()['mon']) . '/' . 
		getdate()['year'] . '--' . 
		sprintf('%02d', (getdate()['hours']+2)) . ':' . 
		sprintf('%02d', getdate()['minutes']);

		$contenu = htmlspecialchars(str_replace(array('<div>','</div>','<p>','</p>'), '', $_POST['message']), ENT_QUOTES);
		$userID = $_SESSION['id'];
		$avID = $_GET['avID'];

		//On récupère le perso lié au message
		$req = $bdd->query("
			SELECT mas_persos.id
			FROM mas_persos
			JOIN mas_relation_perso2aventure 
			ON mas_persos.id=mas_relation_perso2aventure.persoID
			WHERE mas_relation_perso2aventure.avID='$avID'
			AND mas_persos.userID='$userID'
			");
		$persoID = $req->fetch()['id'];

		//On défini le postID (incrémentation ou non)
		$req = $bdd->query("
			SELECT postID, persoID
			FROM mas_messages_aventure
			ORDER BY id DESC
			LIMIT 1
			");
		$res = $req->fetchall()[0];
		if ($persoID == $res['persoID']) {
			$postID = $res['postID'];
		} else {
			$postID = $res['postID']+1; 
		}


		$bdd->query("INSERT INTO mas_messages_aventure (dat, auteurID, contenu, persoID, avID, postID) VALUES ('$dat', '$userID', '$contenu', '$persoID', '$avID', '$postID')");
		/*Incrémente de 1 le nombre de message postés pour ce compte*/
		$bdd->query("UPDATE mas_membres SET nombremsg=nombremsg+1 WHERE id='$userID' ");

	}else{
		$error = "Tu dois écrire quelque chose dans ton message !";
	}

}

if (isset($_POST['editSubmit'])) {

	if (isset($_POST['editedMsg']) AND !empty($_POST['editedMsg'])){

		$contenu = htmlspecialchars(str_replace(array('<div>','</div>','<p>','</p>'), '', $_POST['editedMsg']), ENT_QUOTES);
		$msgID = $_POST['msgID'];
		$bdd->query("
			UPDATE mas_messages_aventure
			SET contenu = '$contenu'
			WHERE id = '$msgID' ");

	}else{
		$error = "Tu dois écrire quelque chose dans ton message !";
	}
}

?>