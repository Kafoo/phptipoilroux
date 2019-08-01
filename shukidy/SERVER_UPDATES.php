<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
	<title>Server updates</title>
</head>
<body>

<?php 

include("_shared_/connectDB.php");
	
//DISCONNECT
if ($_GET['action']=='disconnect') {
	$_SESSION = array();
	setcookie('auth', "", time()-3600);
	session_destroy();
	header("Location: accueil.php");
}


//SUPPRIME PERSO (action, membreID, persoID)
if (isset($_GET['action']) AND $_GET['action']=='supprimePerso') {
	$persoID = $_GET['persoID'];
	$membreID = $_GET['membreID'];
	//Si le perso supprimé était l'actif, on prend le premier perso du compte pour actif
	$reqCheckActif = $bdd->query("SELECT * FROM mas_persos WHERE id ='$persoID' AND actif='1' ")->rowCount();
	if ($reqCheckActif == 1) {
		$premier = $bdd->query("SELECT id FROM mas_persos WHERE membreID='$membreID' ORDER BY id ")->fetch()[0];
		$bdd->query("UPDATE mas_persos SET actif='1' WHERE id='$premier' ");
	}
	$bdd->query("DELETE FROM mas_persos WHERE id ='$persoID' ");
	header("Location: profil.php");
}


//UPDATE PERSO LORE (persoID)
if (isset($_GET['action']) AND $_GET['action']=='updatePersoLore') {
	$persoID = $_GET['persoID'];
	$content = htmlspecialchars($_POST['contentEditLore'], ENT_QUOTES);
	$bdd->query("UPDATE mas_persos SET lore='$content' WHERE id='$persoID'");
	header("Location: profil.php?persoID=$persoID");
}

//UPDATE PERSO Physique (persoID)
if (isset($_GET['action']) AND $_GET['action']=='updatePersoPhysique') {
	$persoID = $_GET['persoID'];
	$content = htmlspecialchars($_POST['contentEditPhysique'], ENT_QUOTES);
	$bdd->query("UPDATE mas_persos SET physique='$content' WHERE id='$persoID'");
	header("Location: profil.php?persoID=$persoID");
}


?>