<?php
include("_shared_/start.php");
?>

<!DOCTYPE html>
<html>
<head>
	<?php include("_shared_/headconfig.php"); ?>
	<link rel="stylesheet" type="text/css" href="style/creauniv.css">
	<title>Vampire - Ta Page</title>
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
		Caractéristique 1 : <input type="text" class="input_carac1" value="<?=$univers['c1_name']?>"><br>
		Caractéristique 2 : <input type="text" class="input_carac2" value="<?=$univers['c2_name']?>"><br>
		Caractéristique 3 : <input type="text" class="input_carac3" value="<?=$univers['c3_name']?>"><br>
		Caractéristique 4 : <input type="text" class="input_carac4" value="<?=$univers['c4_name']?>"><br>
		Caractéristique 5 : <input type="text" class="input_carac5" value="<?=$univers['c5_name']?>"><br>
		<input type="submit" class="carac_submit">
	</div>
</div>

<!-------------- RACES -------------->
<div class="titre">RACES</div>
<div class="ventreBox">
	<div class="raceBox">
		<div class="selectBox">
			<h3>Races disponibles :</h3>
			<select class="selectAttribute selectNature selectRace"></select>
		</div>
		<div class="descriptionBox raceDescription">
		</div>
		<span class="deleteNature" natureType="race" style="cursor: pointer"><u>supprimer cette race</u></span>
	</div>
	<div class="addBox addRace">
		<h4>Ajouter une race </h4>

		<label>nom :</label><br>
		<input class="race_name" type="text"><br>


		<label>Description :</label><br>
		<textarea class="race_description"></textarea><br>

		<input type="submit" class="nature_submit" nature_type="race">
	</div>

<!-------------- CAPACITES DE LA RACE -------------->

	<div class="capaBox">
		<div class="selectBox">
			<h3>Capacités de la race:</h3>
			<select class="selectAttribute selectPower selectCapa"></select>
		</div>
		<div class="descriptionBox capaDescription"></div>	
		<span class="deletePower" powerType="capa" style="cursor: pointer"><u>supprimer cette capacité</u></span>	
	</div>


	<div class="addBox addCapa">
		<h4>Ajouter une capacité pour cette race</h4>

		<label>nom :</label><br>
		<input class="capa_name" type="text"><br>


		<label>Description :</label><br>
		<textarea class="capa_description"></textarea><br>

		<input type="submit" class="power_submit" power_type='capa'>
	</div>


</div>

<!-------------- CLASSES -------------->
<div class="titre">CLASSES</div>
<div class="ventreBox">
	<div class="classeBox">
		<div class="selectBox">
			<h3>Classes disponibles :</h3>
			<select class="selectAttribute selectNature selectClasse"></select>
		</div>
		<div class="descriptionBox classeDescription">
		</div>
		<span class="deleteNature" natureType="classe" style="cursor: pointer"><u>supprimer cette classe</u></span>
	</div>
	<div class="addBox addClasse">
		<h4>Ajouter une classe </h4>

		<label>nom :</label><br>
		<input class="classe_name" type="text"><br>


		<label>Description :</label><br>
		<textarea class="classe_description"></textarea><br>

		<input type="submit" class="nature_submit" nature_type="classe">
	</div>

<!-------------- DISCIPLINES DE LA CLASSE -------------->

	<div class="discBox">
		<div class="selectBox">
			<h3>Discipline de la classe:</h3>
			<select class="selectAttribute selectPower selectDisc"></select>
		</div>
		<div class="descriptionBox discDescription"></div>
		<span class="deletePower" powerType="disc" style="cursor: pointer"><u>supprimer cette discipline</u></span>		
	</div>


	<div class="addBox addDisc">
		<h4>Ajouter une discipline pour cette race</h4>

		<label>nom :</label><br>
		<input class="disc_name" type="text"><br>


		<label>Description :</label><br>
		<textarea class="disc_description"></textarea><br>

		<input type="submit" class="power_submit" power_type='disc'>
	</div>


</div>







</section>

<?php include("_shared_/scripts.php"); ?>
<script type="text/javascript" src="js/creauniv.js"></script>

</body>
</html>
