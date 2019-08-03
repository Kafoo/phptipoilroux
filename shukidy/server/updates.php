<?php
session_start();
include("../_shared_/connectDB.php");
include("../_shared_/functions.php");

/*----------- UPDATE PERSO -----------*/

if (isset($_POST['action']) AND $_POST['action'] == 'updatePerso') {
	$perso = json_decode($_POST['perso']);
	$avID = $_POST['avID'];

	//Peut être intéressant de faire une méthode UPDATE dans la class Perso
	if ($perso->invent1 == '') {$perso->invent1 = '-';}
	if ($perso->invent2 == '') {$perso->invent2 = '-';}
	if ($perso->invent3 == '') {$perso->invent3 = '-';}
	if ($perso->invent4 == '') {$perso->invent4 = '-';}
	if ($perso->invent5 == '') {$perso->invent5 = '-';}
	$bdd->query("
		UPDATE mas_persos
		SET 
		pv = '$perso->pv',
		invent1 = '$perso->invent1',
		invent2 = '$perso->invent2',
		invent3 = '$perso->invent3',
		invent4 = '$perso->invent4',
		invent5 = '$perso->invent5',
		c1Cond = '$perso->c1Cond',
		c2Cond = '$perso->c2Cond',
		c3Cond = '$perso->c3Cond',
		c4Cond = '$perso->c4Cond',
		c5Cond = '$perso->c5Cond',
		xp = xp+'$perso->addedXP'
		WHERE id = '$perso->id'
	");
	checkLvlPerso($avID, $perso->id);
	var_dump($avID);
}


/*----------- REQUEST NEXT -----------*/

if (isset($_GET['action']) AND $_GET['action'] == 'requestNext') {

	$success = 0;
	$msg = '';


	$avID = $_GET['avID'];
	$userID = $_GET['userID'];

	$req = $bdd->query("
		SELECT id
		FROM mas_aventures
		WHERE id = '$avID'
		AND writerID > 0
		");

	$res = $req->fetchall();

	if (count($res) > 0) {
		$msg = 'Désolé ! Il y a déjà un joueur qui aimerait écrire prochainement';
	}else{

		$bdd->query("
			UPDATE mas_aventures SET writerID = '$userID' WHERE id = '$avID'
			");

		$success = 1;
		$msg = 'ok';
	}



	$data = [
		'success' => $success,
		'msg' => $msg
	];

	echo json_encode($data);

}

/*----------- CANCEL NEXT -----------*/

if (isset($_GET['action']) AND $_GET['action'] == 'cancelNext') {

	$avID = $_GET['avID'];

	$bdd->query("
		UPDATE mas_aventures SET writerID = '0' WHERE id = '$avID'
		");
}




?>