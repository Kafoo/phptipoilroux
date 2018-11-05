<?php
if (isset($_POST['submit'])) {
	
	if (isset($_POST['message']) AND !empty($_POST['message'])) {
		
		$membreID = $_SESSION['id'];

		$dat = sprintf('%02d', getdate()['mday']) . '/' . 
		sprintf('%02d', getdate()['mon']) . '/' . 
		getdate()['year'] . '--' . 
		sprintf('%02d', (getdate()['hours']+2)) . ':' . 
		sprintf('%02d', getdate()['minutes']);

		$userID = $_SESSION['id'];
		$avID = $_GET['avID'];
		$contenu = htmlspecialchars($_POST['avReply'], ENT_QUOTES);
		$bdd->query("INSERT INTO ss_messages_aventure (dat, auteurID, contenu, perso, aventureID) VALUES ('$dat', '$auteurID', '$contenu', '$perso', '$aventureID')");
		/*Incrémente de 1 le nombre de message postés pour ce compte*/
		$bdd->query("UPDATE ss_membres SET nombremsg=nombremsg+1 WHERE id=$auteurID");

	}else{
		$error = "Tu dois écrire quelque chose dans ta réponse !";
	}
}


?>