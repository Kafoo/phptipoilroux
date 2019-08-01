<?php
if (isset($_POST['submit'])) {
	
	if (isset($_POST['message']) AND !empty($_POST['message'])) {
		
		$dat = getRealDate();
		$content = htmlspecialchars(str_replace(array('<div>','</div>','<p>','</p>'), '', $_POST['message']), ENT_QUOTES);
		$userID = $_SESSION['id'];
		$persoID = $_POST['persoID'];
		$avID = $_GET['avID'];

		$req = $bdd->query("
			SELECT dat, type, postID, persoID
			FROM mas_av_entries
			WHERE avID='$avID' 
			ORDER BY id DESC
			LIMIT 1
			");
		$lastPost = $req->fetch();

		//Si le dernier post est le "start", on le supprime.
		if ($lastPost['type'] == 'start'){
			$bdd->query("
				DELETE FROM mas_av_entries
				WHERE avID = '$avID'
				AND type = 'start'
				");
		}

		//On check si le dernier post date d'il y a moins de 6h
		$exDat_current = explode('--', $dat);
		$exDat_old = explode('--', $lastPost['dat']);
		$day_current = new DateTime(str_replace('/', '-', $exDat_current[0]));
		$day_old = new DateTime(str_replace('/', '-', $exDat_old[0]));
		$day_interval = $day_current->diff($day_old);
		$mail_frequency = 6;
		$hour_current = explode(':', $exDat_current[1])[0];
		$hour_old = explode(':', $exDat_old[1])[0];
	
		$mail = False;
		if ($day_interval->days > 0) {
			$mail = True;
		}elseif ($hour_current > $hour_old + $mail_frequency) {
			$mail = True;
		}


		//On envoie un mail à tous les joueurs de l'aventure sauf l'auteur
		if ($mail == True) {
			$req = $bdd->query("
				SELECT mail, nom_aventure, mas_persos.userID
				FROM mas_relation_perso2aventure
				INNER JOIN mas_persos ON mas_relation_perso2aventure.persoID = mas_persos.id
				INNER JOIN mas_users ON mas_persos.userID = mas_users.id
				INNER JOIN mas_aventures ON mas_relation_perso2aventure.avID = mas_aventures.id
				WHERE mas_relation_perso2aventure.avID = '$avID'
				");
			$usersMails = $req->fetchall();
			$addresses = [];
			foreach ($usersMails as $address) {
				if ($address['userID'] !== $userID) {
					array_push($addresses, $address['mail']);
				}
			}
	 		$avName = $usersMails[0]['nom_aventure'];
			$subject = "\"".$avName."\" : Nouveau post !";
			$body = "Ouh yeaaaaaaah, nouveau post dans l'aventure, comment qu'on est trop heureux (ouais promis bientôt je fais des mails mieux).";
			$altBody = "Ouh yeaaaaaaah, nouveau post dans l'aventure, comment qu'on est trop heureux (ouais promis bientôt je fais des mails mieux).";

			send_mail ($addresses, $subject, $body, $altBody);
		}

		//On défini le postID (incrémentation ou non)

		if ($persoID == $lastPost['persoID'] 
		AND ($lastPost['type'] == 'rp' OR $lastPost['type'] == 'drPlayer')) {
			$postID = $lastPost['postID'];
		} else {
			$postID = $lastPost['postID']+1;
		}

		//Rentrée en BDD
		$bdd->query("INSERT INTO mas_av_entries (avID, postID, type, dat, persoID)
			VALUES ('$avID', '$postID', 'rp', '$dat', '$persoID')");
		$bdd->query("INSERT INTO mas_av_rp (entryID, persoID, content) 
			SELECT id, '$persoID', '$content' FROM mas_av_entries WHERE avID = '$avID' ORDER BY id DESC LIMIT 1
			");
		/*Incrémente de 1 le nombre de message postés pour ce compte*/
		$bdd->query("UPDATE mas_users SET nombremsg=nombremsg+1 WHERE id='$userID' ");
		/*Incrémente de 4 l'xp du perso*/
		$bdd->query("UPDATE mas_persos SET xp=xp+4 WHERE id='$persoID' ");
		checkLvlPerso($avID, $persoID);


	}else{
		$error = "Tu dois écrire quelque chose dans ton message !";
	}

}

if (isset($_POST['editSubmit'])) {

	if (isset($_POST['editedMsg']) AND !empty($_POST['editedMsg'])){

		$content = htmlspecialchars(str_replace(array('<div>','</div>','<p>','</p>'), '', $_POST['editedMsg']), ENT_QUOTES);
		$msgID = $_POST['msgID'];
		$bdd->query("
			UPDATE mas_av_rp
			SET content = '$content'
			WHERE entryID = '$msgID' ");

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
				$userID = $_SESSION['id'];
				$persoID = $_POST['persoID'];
				$title = htmlspecialchars($_POST['diceReply-title'], ENT_QUOTES);
				$caracID = $_POST['diceReply-carac'];
				$diff = $_POST ['diceReply-diff'];
				$result = $_POST ['diceReply-result'];
				$persoObject = json_decode($_POST['persoObjectJson']);
				$cID = 'c'.$caracID;
				$cIDCond = 'c'.$caracID.'Cond';
				$caracVal = $persoObject->$cID;
				$caracCond = $persoObject->$cIDCond;

				//On défini le postID (incrémentation ou non)
				$req = $bdd->query("
					SELECT postID, persoID, type
					FROM mas_av_entries
					WHERE avID='$avID'
					ORDER BY id DESC
					LIMIT 1
					");
				$res = $req->fetchall()[0];
				if ($persoID == $res['persoID'] 
				AND ($res['type'] == 'rp' OR $res['type'] == 'drPlayer')) {
					$postID = $res['postID'];
				} else {
					$postID = $res['postID']+1;
				}

				//Rentrée en BDD
				$bdd->query("INSERT INTO mas_av_entries (avID, postID, type, dat, persoID) 
					VALUES ('$avID', '$postID', 'drPlayer', '$dat', '$persoID')");
				$bdd->query("INSERT INTO mas_av_dicerolls (entryID, persoID, title, caracID, caracVal, caracCond, difficulty, result, GM) 
					SELECT id, '$persoID', '$title', '$caracID', '$caracVal', '$caracCond', '$diff', '$result', '0' FROM mas_av_entries WHERE avID = '$avID' ORDER BY id DESC LIMIT 1
					");

				/*On voit si le jet est réussi ou non*/

				if ($result + $caracVal + $caracCond >= $diff) {
					$win = True;
				}else{
					$win = False;
				}


				/*Incrémente l'xp du perso si réussi*/
				if ($diff == 8 AND $win == True) {
					$bdd->query("UPDATE mas_persos SET xp=xp+4 WHERE id='$persoID' ");
				}
				if ($diff == 10 AND $win == True) {
					$bdd->query("UPDATE mas_persos SET xp=xp+6 WHERE id='$persoID' ");
				}
				if ($diff == 12 AND $win == True) {
					$bdd->query("UPDATE mas_persos SET xp=xp+8 WHERE id='$persoID' ");
				}
				checkLvlPerso($avID, $persoID);

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