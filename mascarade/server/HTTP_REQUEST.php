<?php
session_start();
include("../_shared_/connectDB.php");
include("mailer.php");
include("../_shared_/functions.php");


/*----------- SUPP MSG -----------*/

if (isset($_GET['action']) AND $_GET['action'] == 'suppMsg') {
	$userID = $_SESSION['id'];
	$msgID = $_GET['msgID'];
	$bdd->query("
		DELETE FROM mas_messages_aventure
		WHERE id = '$msgID' ");
	// -1 au compteur des messages
	$bdd->query("UPDATE mas_membres SET nombremsg=nombremsg-1 WHERE id='$userID' ");
}


/*----------- ROLL THE DIE -----------*/

if (isset($_GET['action']) AND $_GET['action'] == 'rollTheDie') {
	$result = $_GET['result'];
	$rollID = $_GET['rollID'];
	$bdd->query("
		UPDATE mas_diceroll
		SET result='$result'
		WHERE id='$rollID' ");
}


/*----------- EDIT NOTES -----------*/

if (isset($_POST['action']) AND $_POST['action'] == 'editNotes') {
	$notesContent = nl2br(htmlspecialchars(($_POST['notesContent']), ENT_QUOTES));
	$userID = $_POST['userID'];
	$avID = $_POST['avID'];
	$req = $bdd->prepare("
		UPDATE mas_notes
		SET contenu = ? 
		WHERE userID = '$userID' AND avID = '$avID' ");
	$req->execute([$notesContent]);
	echo $notesContent;
}

/*----------- ALLO GM -----------*/

if (isset($_POST['action']) AND $_POST['action'] == 'alloGM') {

	$content = nl2br(htmlspecialchars(($_POST['content']), ENT_QUOTES));
	$fromID = $_POST['userID'];
	$toID = $_POST['otherID'];
	$avID = $_POST['avID'];

	//On vérifie s'il n'y a pas d'autre unseen pour le mailer
	$req = $bdd->query("
		SELECT * 
		FROM mas_allogm
		WHERE avID = '$avID'
		AND toID = '$toID'
		");
	$res = $req->fetchall();

	foreach ($res as $key) {
		if ($key['seen'] == 0) {
			$mailer = True;
		}
	}

	//INSERT MSG
	$bdd->query("INSERT INTO mas_allogm
		(avID, fromID, toID, content)
		VALUES ('$avID','$fromID', '$toID', '$content')
		");

	//SEND MAIL
	if ($mailer==True) { ?>
		<script type="text/javascript">
			var http = new XMLHttpRequest;
			http.open('GET','server/mailer.php?type=alloGM&avID=<?=$avID?>&userID=<?=$toID?>',true);
			http.send();
		</script>
	<?php
	}
	?>
		
	<?php

	echo 'success';
}

/*REFRESH*/
if (isset($_GET['action']) AND $_GET['action'] == 'alloRefresh') {

	$lastMsgID = $_GET['lastMsgID'];
	$avID = $_GET['avID'];
	$userID = $_GET['userID'];
	$otherID = $_GET['otherID'];

	$req = $bdd->query("
		SELECT *
		FROM mas_allogm
		WHERE id > '$lastMsgID'
		AND avID = '$avID'
		AND fromID IN('$userID', '$otherID')
		AND toID IN('$userID', '$otherID')
		");
	$res = $req->fetchall();

	foreach ($res as $msg) {
		//if from user
		if ($msg['fromID'] == $userID) { ?>
			<div class="alloGM-msg msg-user" id="<?=$msg['id']?>"><?=$msg['content']?></div>
		<?php
		}
		//if to user
		if ($msg['toID'] == $userID) { ?>
			<div class="alloGM-msg msg-other" id="<?=$msg['id']?>"><?=$msg['content']?></div>		
		<?php
		}
	} 

	//SET MSG TO SEEN
	$bdd->query("
		UPDATE mas_allogm
		SET seen = '1' 
		WHERE avID = '$avID'
		AND fromID = '$otherID'
		AND toID = '$userID'
		");
}

/*NOTIFICATIONS UNSEEN*/

if (isset($_GET['action']) AND $_GET['action'] == 'notifUnseen') {


	//On fetch les unseen de alloGM
	$avID = $_GET['avID'];
	$userID = $_GET['userID'];

	$req = $bdd->query("
		SELECT fromID
		FROM mas_alloGM
		WHERE avID = '$avID'
		AND toID = '$userID'
		AND seen = 0;
		");
	$alloGMUnseen = $req->fetchall();
	$alloGMUnseens = [];
	//On fait la liste des joueurs dont msg unseen pour le GM

	foreach ($alloGMUnseen as $unseen) {
		array_push($alloGMUnseens, $unseen);
	}

	echo json_encode($alloGMUnseens);

}
?>