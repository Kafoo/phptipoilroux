<?php
session_start();
include("../_shared_/connectDB.php");


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
	$notesContent = nl2br(htmlspecialchars(($_POST['notesContent'])));
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
	$content = nl2br(htmlspecialchars(($_POST['content'])));
	$userID = $_POST['userID'];
	$avID = $_POST['avID'];
	$GM = $_POST['GM'];



	//Message GM
	if (isset($_POST['GM']) AND $_POST['GM'] == 1) {

		$bdd->query("INSERT INTO mas_allogm
			(avID, userID, GM, content, seenByGM)
			VALUES ('$avID','$userID', '$GM', '$content', '1')
			");

		echo '<div class="msg-GM">'.$content.'</div>';
	}
	//Message user
	else {
		echo '<div class="msg-user">'.$content.'</div>';
	}
}

?>