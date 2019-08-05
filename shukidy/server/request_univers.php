<?php
session_start();
include("../_shared_/connectDB.php");


//-------------- GET NATURE INFOS --------------

if (isset($_POST['getInfos']) AND ($_POST['what'] == 'race' OR $_POST['what'] == 'classe')) {

	$univID = $_POST['univID'];
	$natureType = $_POST['what'];

	$req = $bdd->query("
		SELECT nat.id, name, description, icon
		FROM natures as nat
		JOIN rel_univ2natures as u2n 
		ON nat.id = u2n.natureID
		WHERE u2n.univID = '$univID' AND nat.type = '$natureType' 
		");

	$data = $req->fetchall();
	$jsonData = json_encode($data);

	echo $jsonData;

}


//-------------- GET POWER INFOS --------------

if (isset($_POST['getInfos']) AND ($_POST['what'] == 'capa' OR $_POST['what'] == 'disc')) {

	$univID = $_POST['univID'];
	$natureID = $_POST['natureID'];
	$powerType = $_POST['what'];


	$req = $bdd->query("
		SELECT p.id, name, description
		FROM powers as p
		JOIN rel_natures2powers as n2p 
		ON p.id = n2p.powerID
		WHERE n2p.natureID = '$natureID'
		");

	$data = $req->fetchall();
	$jsonData = json_encode($data);

	echo $jsonData;

}


//-------------- --------------

/*if (isset($_GET['get']) AND $_GET['get'] == 'natureInfos') {

	$natureID = $_GET['natureID'];
	$natureInfos = ['description' => '', 'powers' => ''];

	$req = $bdd->query("
		SELECT description
		FROM natures
		WHERE id = '$natureID'
		");

	$natureDescription = $req->fetch()['description'];
	$natureInfos['description']=$natureDescription;


	$req = $bdd->query("
		SELECT p.id, p.lvl, p.name, p.description
		FROM powers as p
		INNER JOIN rel_natures2powers as n2p
		ON n2p.powerID = p.id
		WHERE n2p.natureID = '$natureID'
		");

	$powers = $req->fetchall();

	$naturePowers = [];
	foreach ($powers as $key => $power) {
		$powerInfos = [];
		$powerInfos['id'] = $power['id'];
		$powerInfos['lvl'] = $power['lvl'];
		$powerInfos['name'] = $power['name'];
		$powerInfos['description'] = $power['description'];
		array_push($naturePowers, $powerInfos);
	}


	$natureInfos['powers']=$naturePowers;

	$natureInfos_JSON = json_encode($natureInfos);

	echo $natureInfos_JSON;

}*/

?>