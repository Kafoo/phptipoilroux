<?php
session_start();
include("../_shared_/connectDB.php");



// --------------- UPDATE CARACS ---------------

if (isset($_POST['action']) AND $_POST['action'] == 'changeCaracs') {


	$univID = htmlspecialchars($_POST['univID']);
	$data = $_POST['data'];
	$query = '';

	$i = 0;
	foreach ($data as $key => $carac) {
		$name = htmlspecialchars($carac['name'], ENT_QUOTES);
		$icon = htmlspecialchars($carac['icon'], ENT_QUOTES);
		$color = htmlspecialchars($carac['color'], ENT_QUOTES);
		$caracID = htmlspecialchars($carac['id'], ENT_QUOTES);
		$caracNum = htmlspecialchars($carac['num'], ENT_QUOTES);
		$query .= "UPDATE carac SET num='".$caracNum."',name='".$name."', icon = '".$icon."', color = '".$color."' WHERE id=".$caracID.";";
	}

echo $query;

$bdd->query($query);

}


// --------------- CREATE NATURE ---------------

if (isset($_POST['action']) AND $_POST['action'] == 'addNature') {

	$univID = $_POST['univID'];
	$name = nl2br(htmlspecialchars(($_POST['name']), ENT_QUOTES));
	$description = nl2br(htmlspecialchars(($_POST['description']), ENT_QUOTES));
	$what = $_POST['what'];
	$icon = $_POST['icon'];

	//On ajoute la nature à la bdd
	$bdd->query("INSERT INTO natures
		(name, description, type, icon)
		VALUES ('$name', '$description', '$what', '$icon')
		");

	//On lie la nature à l'univers
	$natureID = $bdd->query("SELECT id FROM natures ORDER BY id DESC")->fetch()[0];
	$bdd->query("INSERT INTO rel_univ2natures
		(univID, natureID)
		VALUES ('$univID', '$natureID')
		");

}

// --------------- DELETE NATURE ---------------


if (isset($_POST['action']) AND $_POST['action'] == 'deleteNature') {

	$success = 0;
	$msg ='';
	$univID = $_POST['univID'];
	$natureID = $_POST['natureID'];

	//On vérifie qu'aucun personnage n'a cette nature
	$req = $bdd->query("
		SELECT id
		FROM mas_persos
		WHERE classeID = '$natureID' OR raceID = '$natureID'
		");
	$res = $req->fetchall();

	if (count($res) == 0) {
		//On supprime la nature
		$bdd->query("
			DELETE FROM natures
			WHERE id = '$natureID'
			");

		//On cherche les pouvoirs lui sont lié
		$req = $bdd->query("
			SELECT p.id
			FROM powers as p
			JOIN rel_natures2powers as n2p
			ON n2p.powerid = p.id
			WHERE n2p.natureID = '$natureID'
			");
		$powers = $req->fetchall();

		$powerIDArray = [];

		foreach ($powers as $power) {
			array_push($powerIDArray, $power['id']);
		}

		$powerIDJoined = join(",", $powerIDArray);


		//On les supprime
		$bdd->query("
			DELETE FROM powers
			WHERE id IN ($powerIDJoined)
			");

		//On supprime leurs relations avec cette nature
		$bdd->query("
			DELETE FROM rel_natures2powers
			WHERE powerID IN ($powerIDJoined)
			");

		//On supprime la relation de la nature avec l'univers
		$bdd->query("
			DELETE FROM rel_univ2natures
			WHERE natureID = '$natureID'
			");

		$success = 1;

	//Si un perso a déjà cette nature
	}else{
		$msg = 'Un personnage de cet univers a déjà cette nature !';
	} 

	$response = [
		'msg' => $msg,
		'success' => $success
	];

	echo json_encode($response);

}



// --------------- CREATE POWER ---------------

if (isset($_POST['action']) AND $_POST['action'] == 'addPower') {

	$univID = $_POST['univID'];
	$natureID = $_POST['natureID'];
	$name = nl2br(htmlspecialchars(($_POST['name']), ENT_QUOTES));
	$description = nl2br(htmlspecialchars(($_POST['description']), ENT_QUOTES));
	$what = $_POST['what'];
	$lvl = 1;
	if ($what == 'capa') {
		$active = 0;
	} elseif($what == 'disc'){
		$active = 1;
	}

var_dump($univID);
var_dump($natureID);
var_dump($name);
var_dump($description);
var_dump($what);
var_dump($lvl);

	//On ajoute la pouvoir à la bdd
	$bdd->query("INSERT INTO powers
		(lvl, name, description, active)
		VALUES ('$lvl', '$name', '$description', '$active')
		");

	//On lie le pouvoir à la nature
	$powerID = $bdd->query("SELECT id FROM powers WHERE name='$name'")->fetch()[0];
	$bdd->query("INSERT INTO rel_natures2powers
		(natureID, powerID)
		VALUES ('$natureID', '$powerID')
		");

}

// --------------- DELETE POWER ---------------


if (isset($_POST['action']) AND $_POST['action'] == 'deletePower') {

	$success = 0;
	$msg ='';
	$univID = $_POST['univID'];
	$powerID = $_POST['powerID'];

	//On vérifie qu'aucun personnage n'a ce pouvoir
	$req = $bdd->query("
		SELECT id
		FROM rel_persos2powers
		WHERE powerID = '$powerID'
		");
	$res = $req->fetchall();

	if (count($res) == 0) {
		//On supprime le pouvoir
		$bdd->query("
			DELETE FROM powers
			WHERE id = '$powerID'
			");

		//On supprime sa relation avec les natures
		$bdd->query("
			DELETE FROM rel_natures2powers
			WHERE powerID = '$powerID'
			");

		$success = 1;
	}else{
		$msg = 'Un personnage de cet univers a déjà ce pouvoir ! Tu ne peux pas le supprimer, désolé.';
	}

	$response = [
		'msg' => $msg,
		'success' => $success
	];
	echo json_encode($response);



}


// ---------------  EDIT ---------------


if (isset($_POST['action']) AND $_POST['action'] == 'edit') {



	if ($_POST['what'] == 'regles') {
		$univID = $_POST['univID'];
		$regles = nl2br(htmlspecialchars(($_POST['regles']), ENT_QUOTES));

		$bdd->query("UPDATE mas_univers SET regles='$regles' WHERE id='$univID'");

		echo $regles;
	}

	elseif ($_POST['what'] == 'univ') {
		$univID = $_POST['univID'];
		$description = nl2br(htmlspecialchars(($_POST['description']), ENT_QUOTES));

		$bdd->query("UPDATE mas_univers SET description='$description' WHERE id='$univID'");

		echo $description;

	} else{	
		$id = $_POST['id'];
		$name = nl2br(htmlspecialchars(($_POST['name']), ENT_QUOTES));
		$description = nl2br(htmlspecialchars(($_POST['description']), ENT_QUOTES));

		if ($_POST['what'] == 'race' OR $_POST['what'] == 'classe') {
			$icon = $_POST['icon'];
			$bdd->query("UPDATE natures SET name='$name', description='$description', icon='$icon' WHERE id='$id'");
		}
		if ($_POST['what'] == 'capa' OR $_POST['what'] == 'disc') {
			$bdd->query("UPDATE powers SET name='$name', description='$description' WHERE id='$id'");
		}
	}




}
?>