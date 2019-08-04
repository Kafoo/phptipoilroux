<?php
include("_shared_/start.php");
?>

<!DOCTYPE html>
<html>
<head>
	<?php include("_shared_/headconfig.php"); ?>
	<link rel="stylesheet" type="text/css" href="style/creauniv.css?v=4">
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
	SELECT univ.name, univ.description, univ.regles,
	univ.c1_name, univ.c2_name, univ.c3_name, univ.c4_name, univ.c5_name 
	FROM mas_univers as univ
	WHERE univ.id = '$univID'
	");
$univers = $req->fetch();

?>

<div class="univID-stock" hidden><?=$univID?></div>

<h1>"<?= strtoupper($univers['name'])?>" - EDITION</h1>

<!-------------- DESCRIPTION UNIV -------------->

<div class="titre">DESCRIPTION</div>

<div class="helper">Tu peux ici décrire ton univers, de son environnement naturel aux les êtres qui y évoluent, en passant par sa politique, ses conflits, son ambiance, ses couleurs et ses odeurs. Fais-toi plaisir, tu feras plaisir à tes joueurs !</div>

<div class="ventreBox">
	<div class="univDescription"><?=$univers['description']?></div>
	<div class="button update_button edit_univ" edit="univ">éditer la description</div>
</div>

<!-------------- CARACTERISTIQUES -------------->

<div class="titre">CARACTERISTIQUES</div>

<div class="helper">Ces caractéristiques définiront les attributs des personnages de ton univers. Chaque caractéristique sera représenté par une valeur entre 1 et 10 pour chaque personnage, cette valeur sera choisie par le joueur lors de la création de son personnage.</div>

<div class="ventreBox caracBox">
	Caractéristique 1 : <input type="text" class="input_carac1" value="<?=$univers['c1_name']?>" maxlength="20">
	<select>
		<option>Rouge</option><option>Vert</option><option>Bleu</option>
	</select>
	<div class="button chooseIcon chooseCaracIcone" icon="">?</div>
	<br>
	Caractéristique 2 : <input type="text" class="input_carac2" value="<?=$univers['c2_name']?>" maxlength="20">
	<select>
		<option>Rouge</option><option>Vert</option><option>Bleu</option>
	</select>
	<div class="button chooseIcon chooseCaracIcone" icon="">?</div>
	<br>
	Caractéristique 3 : <input type="text" class="input_carac3" value="<?=$univers['c3_name']?>" maxlength="20">
	<select>
		<option>Rouge</option><option>Vert</option><option>Bleu</option>
	</select>
	<div class="button chooseIcon chooseCaracIcone" icon="">?</div>
	<br>
	Caractéristique 4 : <input type="text" class="input_carac4" value="<?=$univers['c4_name']?>" maxlength="20">
	<select>
		<option>Rouge</option><option>Vert</option><option>Bleu</option>
	</select>
	<div class="button chooseIcon chooseCaracIcone" icon="">?</div>
	<br>
	Caractéristique 5 : <input type="text" class="input_carac5" value="<?=$univers['c5_name']?>" maxlength="20">
	<select>
		<option>Rouge</option><option>Vert</option><option>Bleu</option>
	</select>
	<div class="button chooseIcon chooseCaracIcone" icon="">?</div>
	<br>
	<input type="submit" class="button update_button edit_carac" value="Valider les caractéristiques">
</div>

<div class="titre">
	<span class="button selectBigContainer current" bigContainer="races">RACES</span>
	<span class="button selectBigContainer" bigContainer="classes">CLASSES</span>
</div>


<!-------------- RACES -------------->
<div class="bigContainer racesBigContainer">

	<div class="helper"><b>Une race représente la nature biologique profonde d'un personnage</b>, c'est à dire l'espèce animal/végétal/monstrueuse/etc à laquelle il appartient.<br><!-- 
	-->Chaque race possède ses propres <b>capacités</b>, qui sont des <b>pouvoirs passifs</b>. Par exemple, un elfe peut avoir la capacité de voir très loin. Cette capacité pourrait s'appeler "longue vue" et fait partie de la nature du personnage</div>

	<div class="ventreBox">
		<div class="raceBox">
			<div class="selectContainer">
				<h3>Races disponibles :</h3>
				<select class="selectBox selectAttribute selectNature selectRace"></select>
			</div>
			<div class="descriptionBox raceDescription"></div>
			<div class="button update_button edit_button edit_race" edit="race" hidden>éditer cette race</div>
			<div class="button update_button delete_button delete_nature delete_race" natureType="race" hidden>supprimer cette race</div>
		</div>
		<div class="addBox addRace">
			<div class="addTitle">
				<div class="addIcone"></div>
				<div class="addLabel">
				Ajouter une race
				</div>
				<div class="addIcone"></div>
			</div>

			<div class="addContainer" hidden>
				<label>nom :</label><br>
				<input class="race_name" type="text" maxlength="20"><br>


				<label>Description :</label><br>
				<textarea class="race_description"></textarea><br>

				<input type="submit" class="nature_submit" nature_type="race">
			</div>
		</div>

	</div>

	<!-------------- CAPACITES DE LA RACE -------------->
	<div class="ventreBox">
		<div class="capaBox">
			<div class="selectContainer">
				<h3>Capacités de la race :</h3>
				<select class="selectBox selectAttribute selectPower selectCapa"><option>---</option></select>
			</div>
			<div class="descriptionBox capaDescription">pas encore de capacité pour cette race</div>
			<div class="button update_button edit_button edit_capa" edit="capa" hidden>éditer cette capacité</div>	
			<div class="button update_button delete_button delete_power delete_capa" powerType="capa" hidden>supprimer cette capacité</div>	
		</div>
		<div class="addBox addCapa">
			<div class="addTitle">
				<div class="addIcone"></div>
				<div class="addLabel">Ajouter une capacité pour cette race</div>
				<div class="addIcone"></div>
			</div>

			<div class="addContainer" hidden>
				<label>nom :</label><br>
				<input class="capa_name" type="text" maxlength="20"><br>


				<label>Description :</label><br>
				<textarea class="capa_description"></textarea><br>

				<input type="submit" class="power_submit" power_type='capa'>
			</div>
		</div>
	</div>
</div>

<!-------------- CLASSES -------------->
<div class="bigContainer classesBigContainer" hidden>

	<div class="helper"><b>Une classe représente la spécialisation d'un personnage</b>, son métier en quelque sorte.<br><!-- 
	-->Chaque classe possède ses propres <b>disciplines</b>, qui sont des <b>pouvoirs actifs</b>, c'est à dire qu'ils peuvent être utilisés ponctuellement. Par exemple, un mage peut avoir la discipline "Boule de feu" et l'utiliser aussi souvent que ce que le niveau de cette discipline le permet.</div>

	<div class="ventreBox">
		<div class="classeBox">
			<div class="selectContainer">
				<h3>Classes disponibles :</h3>
				<select class="selectBox selectAttribute selectNature selectClasse"></select>
			</div>
			<div class="descriptionBox classeDescription"></div>
			<div class="button update_button edit_button edit_classe" edit="classe" hidden>éditer cette classe</div>
			<div class="button update_button delete_button delete_nature delete_classe" natureType="classe" hidden>supprimer cette classe</div>
		</div>

		<div class="addBox addClasse">
			<div class="addTitle">
				<div class="addIcone"></div>
				<div class="addLabel">Ajouter une classe</div>
				<div class="addIcone"></div>
			</div>

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

				<select class="selectBox selectAttribute selectPower selectDisc"><option>---</option></select>
			</div>
			<div class="descriptionBox discDescription">Pas encore de discipline pour cette classe</div>
			<div class="button update_button edit_button edit_disc" edit="disc" hidden>éditer cette discipline</div>
			<div class="button update_button delete_button delete_power delete_disc" powerType="disc" hidden>supprimer cette discipline</div>		
		</div>
		<div class="addBox addDisc">
			<div class="addTitle">
				<div class="addIcone"></div>
				<div class="addLabel">Ajouter une discipline pour cette classe</div>
				<div class="addIcone"></div>
			</div>

			<div class="addContainer" hidden>
				<label>nom :</label><br>
				<input class="disc_name" type="text" maxlength="20"><br>


				<label>Description :</label><br>
				<textarea class="disc_description"></textarea><br>

				<input type="submit" class="power_submit" power_type='disc'>
			</div>
		</div>
	</div>
</div>

<!-------------- REGLES PARTICULIERES -------------->

<div class="titre">REGLES PARTICULIERES</div>

<div class="helper">Tu peux définir des règles de jeu associé à cet univers. <br>Par exemple, tu peux vouloir qu'aucun joueur ne fasse de lancé de dés associé à une caractéristique particulière et que celle-ci soit dédié à autre chose, ou que tout le monde écrive à la 3e personne.</div>

<div class="ventreBox">
	<div class="regles"><?=$univers['regles']?></div>
	<div class="button update_button edit_regles" edit="regles">éditer les règles</div>
</div>




</section>

<?php include("_shared_/scripts.php"); ?>
<script type="text/javascript" src="js/creauniv.js?v=1"></script>

</body>
</html>
