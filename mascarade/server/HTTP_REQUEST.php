<?php
session_start();
include("../_shared_/connectDB.php");


/*----------- GET PERSOS -----------*/
//Affiche tous les persos du user, espacés par un saut de ligne
if (isset($_GET['action']) and $_GET['action'] == 'getPersos') {
	$userID = $_SESSION['id'];
	$req = $bdd->query("
		SELECT nom, id 
		FROM ss_persos 
		WHERE userID='$userID'");
	$res = $req->fetchall();
	$jsonres = json_encode($res);

	echo $jsonres;
}

?>