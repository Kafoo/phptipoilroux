<?php
include("../_shared_/connectDB.php");

$req = $bdd->query('SELECT *
	FROM mas_notes
	WHERE avID = 25
	AND persoID = 412');
$notes = $req->fetch();
?>

<?=$notes['contenu']?>
