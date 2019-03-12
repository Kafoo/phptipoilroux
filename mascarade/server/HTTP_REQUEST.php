<?php
session_start();
include("../_shared_/connectDB.php");
include("mailer.php");


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



	send_mail(['ant.guillard@gmail.com'], 'test alloGM', 'body test', 'body test');
}

/*----------- ALLO GM -----------*/

if (isset($_POST['action']) AND $_POST['action'] == 'alloGM') {
	$content = nl2br(htmlspecialchars(($_POST['content']), ENT_QUOTES));
	$userID = $_POST['userID'];
	$avID = $_POST['avID'];
	$GM = $_POST['GM'];



	//Message GM
	if (isset($_POST['GM']) AND $_POST['GM'] == 1) {
		$bdd->query("INSERT INTO mas_allogm
			(avID, userID, GM, content, seenByGM)
			VALUES ('$avID','$userID', '$GM', '$content', '1')
			");

		//Send message to player
		?>
		<script type="text/javascript">
			var http = new XMLHttpRequest;
			http.open('GET','server/mailer.php?type=alloGM&toGM=0&avID=<?=$avID?>&userID=<?=$userID?>',true);
			http.send();
		</script>
		<?php

	}
	//Message player
	else {
		$bdd->query("INSERT INTO mas_allogm
			(avID, userID, GM, content, seenByPlayer)
			VALUES ('$avID','$userID', '$GM', '$content', '1')
			");

	}

	$req = $bdd->query("
		SELECT id
		FROM mas_alloGM
		ORDER BY id DESC
		");
	$msgID = $req->fetch()[0];

	echo '<div class="alloGM-msg msg-user" id="'.$msgID.'">'.$content.'</div>';
}

/*REFRESH*/
if (isset($_GET['action']) AND $_GET['action'] == 'alloRefresh') {

	$lastMsgID = $_GET['lastMsgID'];
	$avID = $_GET['avID'];
	$userID = $_GET['userID'];
	$GM = $_GET['GM'];

	if ($GM == 1) {
		$req = $bdd->query("
			SELECT *
			FROM mas_allogm
			WHERE id > '$lastMsgID'
			AND userID = '$userID'
			AND avID = '$avID'
			AND GM = 0
			");
		$res = $req->fetchall();

		foreach ($res as $msg) { ?>
			<div class="alloGM-msg msg-other" id="<?=$msg['id']?>"><?=$msg['content']?></div>		
		<?php
		} 
	}

	if ($GM == 0) {
		$req = $bdd->query("
			SELECT *
			FROM mas_allogm
			WHERE id > '$lastMsgID'
			AND avID = '$avID'
			AND GM = 1
			");
		$res = $req->fetchall();

		foreach ($res as $msg) { ?>
			<div class="alloGM-msg msg-other" id="<?=$msg['id']?>"><?=$msg['content']?></div>		
		<?php
		} 
	}


}
?>