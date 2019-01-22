<?php
include("../_shared_/connectDB.php");

$userID = $_POST['userID'];
$avID = $_POST['avID'];

$req = $bdd->query("SELECT *
	FROM mas_notes 
	WHERE avID = '$avID' 
	AND userID = '$userID' ");
$notes = $req->fetch();
?>

<?=$notes['contenu']?>

