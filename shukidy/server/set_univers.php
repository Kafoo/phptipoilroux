<?php
session_start();
include("../_shared_/connectDB.php");



// --------------- UPDATE CARACS ---------------

if (isset($_POST['action']) AND $_POST['action'] == 'changeCaracs') {


	$univID = $_POST['univID'];
	$c1_name = $_POST['c1_name'];
	var_dump($c1_name);
	$c1_icon = $_POST['c1_icon'];
	var_dump($c1_icon);
	$c1_color = $_POST['c1_color'];
	var_dump($c1_color);
	$c2_name = $_POST['c2_name'];
	var_dump($c2_name);
	$c2_icon = $_POST['c2_icon'];
	var_dump($c2_icon);
	$c2_color = $_POST['c2_color'];
	var_dump($c2_color);
	$c3_name = $_POST['c3_name'];
	var_dump($c3_name);
	$c3_icon = $_POST['c3_icon'];
	var_dump($c3_icon);
	$c3_color = $_POST['c3_color'];
	var_dump($c3_color);
	$c4_name = $_POST['c4_name'];
	var_dump($c4_name);
	$c4_icon = $_POST['c4_icon'];
	var_dump($c4_icon);
	$c4_color = $_POST['c4_color'];
	var_dump($c4_color);
	$c5_name = $_POST['c5_name'];
	var_dump($c5_name);
	$c5_icon = $_POST['c5_icon'];
	var_dump($c5_icon);
	$c5_color = $_POST['c5_color'];
var_dump($c5_color);


	 	$bdd->query("UPDATE mas_univers 
	 		SET 
	 		c1_name='$c1_name', c2_name='$c2_name', c3_name='$c3_name', c4_name='$c4_name', c5_name='$c5_name',
	 		c1_icon='$c1_icon', c2_icon='$c2_icon', c3_icon='$c3_icon', c4_icon='$c4_icon', c5_icon='$c5_icon',
	 		c1_color='$c1_color', c2_color='$c2_color', c3_color='$c3_color', c4_color='$c4_color', c5_color='$c5_color' 
	 		WHERE id='$univID' ");

}


// --------------- CREATE NATURE ---------------

if (isset($_POST['action']) AND $_POST['action'] == 'addNature') {

	$univID = $_POST['univID'];
	$name = nl2br(htmlspecialchars(($_POST['name']), ENT_QUOTES));
	$description = nl2br(htmlspecialchars(($_POST['description']), ENT_QUOTES));
	$type = $_POST['type'];

	//On ajoute la nature à la bdd
	$bdd->query("INSERT INTO natures
		(name, description, type)
		VALUES ('$name', '$description', '$type')
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

	$univID = $_POST['univID'];
	$natureID = $_POST['natureID'];

	//On vérifie qu'aucun personnage n'a cette nature
	$req = $bdd->query("
		SELECT id
		FROM mas_persos
		WHERE classeID = '$natureID' OR raceID = '$natureID'
		");
	$res = $req->fetchall();
	var_dump($res);

	if (count($res) == 0) {
		//On supprime la nature
		$bdd->query("
			DELETE FROM natures
			WHERE id = '$natureID'
			");

		//On supprime sa relation avec l'univers
		$bdd->query("
			DELETE FROM rel_univ2natures
			WHERE natureID = '$natureID'
			");

		//On supprime les pouvoirs qui lui sont liés ??
		//Peut être pas...
	}
}


// --------------- CREATE POWER ---------------

if (isset($_POST['action']) AND $_POST['action'] == 'addPower') {

	$univID = $_POST['univID'];
	$natureID = $_POST['natureID'];
	$name = nl2br(htmlspecialchars(($_POST['name']), ENT_QUOTES));
	$description = nl2br(htmlspecialchars(($_POST['description']), ENT_QUOTES));
	$type = $_POST['type'];
	$lvl = 1;
	if ($type == 'capa') {
		$active = 0;
	} elseif($type == 'disc'){
		$active = 1;
	}

	//On ajoute la pouvoir à la bdd
	$bdd->query("INSERT INTO powers
		(lvl, name, description, active)
		VALUES ('$lvl', '$name', '$description', '$active')
		");

	//On lie le pouvoir à la nature
	$powerID = $bdd->query("SELECT id FROM powers ORDER BY id DESC")->fetch()[0];
	$bdd->query("INSERT INTO rel_natures2powers
		(natureID, powerID)
		VALUES ('$natureID', '$powerID')
		");

}

// --------------- DELETE POWER ---------------


if (isset($_POST['action']) AND $_POST['action'] == 'deletePower') {

	$univID = $_POST['univID'];
	$powerID = $_POST['powerID'];

	//On vérifie qu'aucun personnage n'a ce pouvoir
	$req = $bdd->query("
		SELECT id
		FROM rel_persos2powers
		WHERE powerID = '$powerID'
		");
	$res = $req->fetchall();
	var_dump($res);

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
	}
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
			$bdd->query("UPDATE natures SET name='$name', description='$description' WHERE id='$id'");
		}
		if ($_POST['what'] == 'capa' OR $_POST['what'] == 'disc') {
			$bdd->query("UPDATE powers SET name='$name', description='$description' WHERE id='$id'");
		}
	}




}
?>