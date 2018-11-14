<?php
session_start();
include("../_shared_/connectDB.php");


/*----------- GET PERSOS -----------*/
//Affiche tous les persos du user, espacés par un saut de ligne
if (isset($_GET['action']) and $_GET['action'] == 'getPersos') {
	$userID = $_SESSION['id'];
	$req = $bdd->query("
		SELECT nom, id 
		FROM mas_persos 
		WHERE userID='$userID'");
	$res = $req->fetchall();
	$jsonres = json_encode($res);

	echo $jsonres;
}

/*----------- SUPP MSG -----------*/

if (isset($_GET['action']) AND $_GET['action'] == 'suppMsg') {
	$msgID = $_GET['msgID'];
	$bdd->query("
		DELETE FROM mas_messages_aventure
		WHERE id = '$msgID' ");
	// -1 au compteur des messages
	$bdd->query("
		UPDATE mas_membres 
		SET nombremsg=nombremsg-1 
		WHERE id='$userID' ");
}

/*----------- EDIT MSG -----------*/



/*----------- ROLL THE DIE -----------*/

if (isset($_GET['action']) AND $_GET['action'] == 'rollTheDie') {
	$result = $_GET['result'];
	$rollID = $_GET['rollID'];
	$bdd->query("
		UPDATE mas_diceroll
		SET result='$result'
		WHERE id='$rollID' ");
}

?>