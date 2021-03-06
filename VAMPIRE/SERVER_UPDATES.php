<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
	<title>Server updates</title>
</head>
<body>

<?php 

include("shared/connectDB.php");


//SUPPRIME PERSO (action, membreID, persoID)
if (isset($_GET['action']) AND $_GET['action']=='supprimePerso') {
	$persoID = $_GET['persoID'];
	$membreID = $_GET['membreID'];
	//Si le perso supprimé était l'actif, on prend le premier perso du compte pour actif
	$reqCheckActif = $bdd->query("SELECT * FROM ss_persos WHERE id ='$persoID' AND actif='1' ")->rowCount();
	if ($reqCheckActif == 1) {
		$premier = $bdd->query("SELECT id FROM ss_persos WHERE membreID='$membreID' ORDER BY id ")->fetch()[0];
		$bdd->query("UPDATE ss_persos SET actif='1' WHERE id='$premier' ");
	}
	$bdd->query("DELETE FROM ss_persos WHERE id ='$persoID' ");
	header("Location: profil.php");
}


//ACTIVE PERSO (action, membreID, persoID)
if (isset($_GET['action']) AND $_GET['action']=='activePerso') {
	$persoID = $_GET['persoID'];
	$membreID = $_GET['membreID'];
	$bdd->query("UPDATE ss_persos SET actif='0' WHERE membreID='$membreID' AND actif='1' ");
	$bdd->query("UPDATE ss_persos SET actif='1' WHERE id='$persoID' ");
	header("Location: profil.php");
}


//SUPPRIME MESSAGE (messageID)
if (isset($_GET['action']) AND $_GET['action']=='supprimeMessage') {
	$messageID = $_GET['messageID'];
	$location = $_SESSION['currentStoryURL'];
	$bdd->query("DELETE FROM ss_messages_aventure WHERE id='$messageID' ");
	header("Location: $location");
}

//UPDATE PERSO LORE (persoID)
if (isset($_GET['action']) AND $_GET['action']=='updatePersoLore') {
	$persoID = $_GET['persoID'];
	$content = htmlspecialchars($_POST['contentEditLore'], ENT_QUOTES);
	$bdd->query("UPDATE ss_persos SET lore='$content' WHERE id='$persoID'");
	header("Location: ficheperso.php?persoID=$persoID");
}

//UPDATE PERSO Physique (persoID)
if (isset($_GET['action']) AND $_GET['action']=='updatePersoPhysique') {
	$persoID = $_GET['persoID'];
	$content = htmlspecialchars($_POST['contentEditPhysique'], ENT_QUOTES);
	$bdd->query("UPDATE ss_persos SET physique='$content' WHERE id='$persoID'");
	header("Location: ficheperso.php?persoID=$persoID");
}


?>

</body>
</html>