<?php
include("_shared_/start.php");
?>

<!DOCTYPE html>
<html>
<head>
	<?php include("_shared_/headconfig.php"); ?>
	<link rel="stylesheet" type="text/css" href="style/creauniv.css">
	<title>Shukidy - Edition d'univers</title>
</head>
<body>

<?php include('_shared_/header.php') ?>


<!---------- CONTENU ---------->
<section>



<?php


//-------------------------------------------


$univID = $_GET['univID'];


//On récupère les infos de l'univers lié à l'aventure
$req = $bdd->query("
	SELECT univ.name, 
	univ.c1_name, univ.c2_name, univ.c3_name, univ.c4_name, univ.c5_name 
	FROM mas_univers as univ
	WHERE univ.id = '$univID'
	");
$univers = $req->fetch();

/*
$univID = $univers['id'];	
//On récupère les différentes natures de l'univers
$req = $bdd->query("
	SELECT nat.id, nat.name, nat.type
	FROM natures as nat
	LEFT JOIN rel_univ2natures as u2n
	ON nat.id = u2n.natureID
	WHERE u2n.univID = '$univID'
	");
$natures = $req->fetchall();
*/


?>

<div class="univID-stock" hidden><?=$univID?></div>

<h1>"<?= strtoupper($univers['name'])?>" - EDITION</h1>



<div class="titre">CARACTERISTIQUES</div>

<div class="ventreBox">
	<div class="caracBox">
		Caractéristique 1 : <input type="text" class="input_carac1" value="<?=$univers['c1_name']?>" maxlength="20"><br>
		Caractéristique 2 : <input type="text" class="input_carac2" value="<?=$univers['c2_name']?>" maxlength="20"><br>
		Caractéristique 3 : <input type="text" class="input_carac3" value="<?=$univers['c3_name']?>" maxlength="20"><br>
		Caractéristique 4 : <input type="text" class="input_carac4" value="<?=$univers['c4_name']?>" maxlength="20"><br>
		Caractéristique 5 : <input type="text" class="input_carac5" value="<?=$univers['c5_name']?>" maxlength="20"><br>
		<input type="submit" class="carac_submit">
	</div>
</div>

<!-------------- RACES -------------->
<div class="titre">RACES</div>
<div class="ventreBox">
	<div class="raceBox">
		<div class="selectContainer">
			<h3>Races disponibles :</h3>
			<select class="selectBox selectAttribute selectNature selectRace"></select>
		</div>
		<div class="descriptionBox raceDescription"></div>
		<div class="button update_button edit_button edit_race" edit="race">éditer cette race</div>
		<div class="button update_button delete_button delete_nature delete_race" natureType="race">supprimer cette race</div>
	</div>

	<div class="addBox addRace">
		<h4><div class="downArrow"></div>Ajouter une race<div class="downArrow"></div></h4>

		<div class="addContainer" hidden>
			<label>nom :</label><br>
			<input class="race_name" type="text" maxlength="20"><br>


			<label>Description :</label><br>
			<textarea class="race_description"></textarea><br>

			<input type="submit" class="nature_submit" nature_type="race">
		</div>
	</div>


</div>
<div class="ventreBox">
<!-------------- CAPACITES DE LA RACE -------------->

	<div class="capaBox">
		<div class="selectContainer">
			<h3>Capacités de la race :</h3>
			<select class="selectBox selectAttribute selectPower selectCapa"></select>
		</div>
		<div class="descriptionBox capaDescription"></div>
		<div class="button update_button edit_button edit_capa" edit="capa">éditer cette capacité</div>	
		<div class="button update_button delete_button delete_power delete_capa" powerType="capa">supprimer cette capacité</div>	
	</div>

	<div class="addBox addCapa">
		<h4><div class="downArrow"></div>Ajouter une capacité pour cette race<div class="downArrow"></div></h4>

		<div class="addContainer" hidden>
			<label>nom :</label><br>
			<input class="capa_name" type="text" maxlength="20"><br>


			<label>Description :</label><br>
			<textarea class="capa_description"></textarea><br>

			<input type="submit" class="power_submit" power_type='capa'>
		</div>
	</div>


</div>

<!-------------- CLASSES -------------->
<div class="titre">CLASSES</div>
<div class="ventreBox">
	<div class="classeBox">
		<div class="selectContainer">
			<h3>Classes disponibles :</h3>
			<select class="selectBox selectAttribute selectNature selectClasse"></select>
		</div>
		<div class="descriptionBox classeDescription"></div>
		<div class="button update_button edit_button edit_classe" edit="classe">éditer cette classe</div>
		<div class="button update_button delete_button delete_nature delete_classe" natureType="classe">supprimer cette classe</div>
	</div>

	<div class="addBox addClasse">
		<h4><div class="downArrow"></div>Ajouter une classe<div class="downArrow"></div></h4>

		<div class="addContainer" hidden>
			<label>nom :</label><br>
			<input class="classe_name" type="text" maxlength="20"><br>


			<label>Description :</label><br>
			<textarea class="classe_description"></textarea><br>

			<input type="submit" class="nature_submit" nature_type="classe">
		</div>
	</div>

</div>
<div class="ventreBox">
<!-------------- DISCIPLINES DE LA CLASSE -------------->

	<div class="discBox">
		<div class="selectContainer">
			<h3>Disciplines de la classe :</h3>
			<select class="selectBox selectAttribute selectPower selectDisc"></select>
		</div>
		<div class="descriptionBox discDescription"></div>
		<div class="button update_button edit_button edit_disc" edit="disc">éditer cette discipline</div>
		<div class="button update_button delete_button delete_power delete_disc" powerType="disc">supprimer cette discipline</div>		
	</div>

	<div class="addBox addDisc">
		<h4><div class="downArrow"></div>Ajouter une discipline pour cette classe<div class="downArrow"></div></h4>

		<div class="addContainer" hidden>
			<label>nom :</label><br>
			<input class="disc_name" type="text" maxlength="20"><br>


			<label>Description :</label><br>
			<textarea class="disc_description"></textarea><br>

			<input type="submit" class="power_submit" power_type='disc'>
		</div>
	</div>


</div>




</section>

<?php include("_shared_/scripts.php"); ?>
<script type="text/javascript" src="js/creauniv.js"></script>

</body>
</html>
