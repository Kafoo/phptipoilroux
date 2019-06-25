<?php
if (isset($_POST['submit'])) {
	
	if (isset($_POST['message']) AND !empty($_POST['message'])) {
		
		$dat = getRealDate();
		$contenu = htmlspecialchars(str_replace(array('<div>','</div>','<p>','</p>'), '', $_POST['message']), ENT_QUOTES);
		$userID = $_SESSION['id'];
		$avID = $_GET['avID'];

		//On check si le dernier post date d'il y a moins de 12h
		$req = $bdd->query("
			SELECT dat
			FROM mas_messages_aventure
			WHERE avID='$avID'
			ORDER BY id DESC
			");
		$lastPostDat = $req->fetch()[0];

		$exDat_current = explode('--', $dat);
		$exDat_old = explode('--', $lastPostDat);
		$day_current = new DateTime(str_replace('/', '-', $exDat_current[0]));
		$day_old = new DateTime(str_replace('/', '-', $exDat_old[0]));
		$day_interval = $day_current->diff($day_old);
		$mail_frequency = 12;
		$hour_current = explode(':', $exDat_current[1])[0];
		$hour_old = explode(':', $exDat_old[1])[0];

		$mail = False;
		if ($day_interval->days > 0) {
			$mail = True;
			echo "OtherDay";
		}elseif ($hour_current > $hour_old + $mail_frequency) {
			$mail = True;
			echo "+12h";
		}else{
			echo "NO";
		}


		//On envoie un mail à tous les joueurs de l'aventure si besoin
		if ($mail == True) {
			$req = $bdd->query("
				SELECT mail, nom_aventure
				FROM mas_relation_perso2aventure
				INNER JOIN mas_persos ON mas_relation_perso2aventure.persoID = mas_persos.id
				INNER JOIN mas_membres ON mas_persos.userID = mas_membres.id
				INNER JOIN mas_aventures ON mas_relation_perso2aventure.avID = mas_aventures.id
				WHERE mas_relation_perso2aventure.avID = '$avID'
				");
			$usersMails = $req->fetchall();
			$addresses = [];
			foreach ($usersMails as $adress) {
				array_push($addresses, $adress['mail']);
			}
			$addresses = 'ant.guillard@gmail.com';
	 		$avName = $usersMails[0]['nom_aventure'];
			$subject = "\"".$avName."\" : Nouveau post !";
			$body = "Ouh yeaaaaaaah, nouveau post dans l'aventure, comment qu'on est trop heureux (ouais promis bientôt je fais des mails mieux).";
			$altBody = "Ouh yeaaaaaaah, nouveau post dans l'aventure, comment qu'on est trop heureux (ouais promis bientôt je fais des mails mieux).";

			send_mail ($addresses, $subject, $body, $altBody);
		}


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

		//Rentrée en BDD
		$bdd->query("INSERT INTO mas_messages_aventure (dat, auteurID, contenu, persoID, avID, postID) VALUES ('$dat', '$userID', '$contenu', '$persoID', '$avID', '$postID')");
		/*Incrémente de 1 le nombre de message postés pour ce compte*/
		$bdd->query("UPDATE mas_membres SET nombremsg=nombremsg+1 WHERE id='$userID' ");
		/*Incrémente de 4 l'xp du perso*/
		$bdd->query("UPDATE mas_persos SET xp=xp+4 WHERE id='$persoID' ");
		checkLvlPerso($persoID);


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

if (isset($_POST['diceReply-submit']) AND !empty($_POST['diceReply-submit'])) {
	if (isset($_POST['diceReply-title']) AND !empty($_POST['diceReply-title'])) {
		if (isset($_POST['diceReply-carac']) AND !empty($_POST['diceReply-carac'])) {
			if (isset($_POST['diceReply-diff']) AND !empty($_POST['diceReply-diff'])) {
				
				$dat = getRealDate();

				$avID = $_GET['avID'];
				$type = 'diceRoll_player';
				$auteurID = $_SESSION['id'];
				$userID = $_SESSION['id'];
				$contenu = htmlspecialchars($_POST['diceReply-title'], ENT_QUOTES);

				//On récupère le perso lié au message
				$req = $bdd->query("
					SELECT mas_persos.id
					FROM mas_persos
					JOIN mas_relation_perso2aventure 
					ON mas_persos.id=mas_relation_perso2aventure.persoID
					WHERE mas_relation_perso2aventure.avID='$avID'
					AND mas_persos.userID='$auteurID'
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


				$bdd->query("INSERT INTO mas_messages_aventure (type, dat, auteurID, contenu, persoID, avID, postID) VALUES ('$type', '$dat', '$userID', '$contenu', '$persoID', '$avID', '$postID')");

				$req = $bdd->query('SELECT id FROM mas_messages_aventure LIMIT 1 ORDER BY DESC');

				$req = $bdd->query('SELECT id FROM mas_messages_aventure ORDER BY id DESC LIMIT 1');
				$msgID = $req->fetch()[0];
				$caracID = $_POST['diceReply-carac'];

				$diff = $_POST ['diceReply-diff'];
				$result = $_POST ['diceReply-result'];



				$bdd->query("INSERT INTO mas_diceroll (persoID, msgID, caracID, difficulty, result) VALUES ('$persoID', '$msgID', '$caracID', '$diff', '$result')");

			}else{
				$error = "Tu dois choisir une difficulté pour ton lancé";
			}
		}else{
			$error = "Tu dois choisir une caractéristique pour ton lancé";
		}
	}else{
		$error = "Tu dois donner un titre à ton lancé !";
	}

}

?>