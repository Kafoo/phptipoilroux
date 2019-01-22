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
	$notesContent = $_POST['notesContent'];
	$userID = $_POST['userID'];
	$avID = $_POST['avID'];
	$bdd->query("
		UPDATE mas_notes
		SET contenu = '$notesContent' 
		WHERE userID = '$userID' AND avID = '$avID' ");
	echo $notesContent;
}

?>