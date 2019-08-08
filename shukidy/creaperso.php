<?php
include("_shared_/start.php");
include("submits/creaperso_submit.php");
?>

<!DOCTYPE html>
<html>
<head>
	<?php include("_shared_/headconfig.php"); ?>
	<link rel="stylesheet" type="text/css" href="style/creaperso.css">
	<title>Shukidy - Création de personnage</title>
</head>
<body>

<?php include('_shared_/header.php') ?>

<div class="univID-stock" hidden><?=$_GET['univID']?></div>

<!---------- CONTENU ---------->
<section>

	<h1>Création de personnage</h1>


	<?php
	if (!isset($_GET['avID']) OR !isset($_GET['userID']) OR $_GET['avID']=='' OR $_GET['userID']=='') {
		echo 'il y a eu un petit souci en route... Merci de réessayer <br><a href="aventures.php"><u>Retour aux aventures</u></a>';

	}else{ 

		$avID = $_GET['avID'];
		$univID = $_GET['univID'];
		$userID = $_GET['userID'];
		
		
		$req = $bdd->query("
			SELECT univ.name, univ.description, univ.regles,
			univ.c1_name, univ.c2_name, univ.c3_name, univ.c4_name, univ.c5_name,
			univ.c1_icon, univ.c2_icon, univ.c3_icon, univ.c4_icon, univ.c5_icon,
			univ.c1_color, univ.c2_color, univ.c3_color, univ.c4_color, univ.c5_color 
			FROM mas_univers as univ
			WHERE univ.id = '$univID'
		");

		$univers = $req->fetch();


		//On récupère les carac de l'univers

		$req = $bdd->query("
			SELECT id, name, color, icon
			FROM carac
			WHERE univid = '$univID'
			ORDER BY num
			");
		$caracOfUniv = $req->fetchall();
		
		?>


		<div class="pagerTitle">
			<span class="pageCount"></span> : 
			<span class="pageName"></span>
		</div>

		<div class="pagerErrorContainer">
			<div class="closingError"></div>
			<div class="pagerError"></div>
		</div>

		<!-- PAGES -->
		<div class="pagesBigContainer">

			<!-- RACE CHOICE -->
			<div class="pageContainer" pageName="Race/Capacité" page="1">
				<?php include('content/creaperso/race_choice.php') ?>
			</div>

			<!-- CLASSE CHOICE -->
			<div class="pageContainer" pageName="Classe/Discipline" page="2">
				<?php include('content/creaperso/classe_choice.php') ?>
			</div>
			
			<!-- CARAC CHOICE -->
			<div class="pageContainer" pageName="T'as quoi dans le ventre ?" page="3">
				<?php include('content/creaperso/carac_choice.php') ?>
			</div>
			
			<!-- QUI ES TU -->
			<div class="pageContainer" pageName="Qui es-tu ?" page="4">
				<?php include('content/creaperso/quiestu.php') ?>
			</div>
			
		</div>

		<div class="pagerNav">
			<div class="button pagerbutton pagerPrev"></div>
			<div class="button pagerbutton pagerNext"></div>
		</div>

	<?php
	} ?>


</section>

<?php include("_shared_/scripts.php"); ?>
<script type="text/javascript" src="js/_shared_/controller_creaperso.js"></script>
<script type="text/javascript" src="js/creaperso.js"></script>

</body>
</html>