<?php
include("_shared_/start.php");
include("_shared_/functions.php");
/*include("submits/tapage_submit.php");*/
?>

<!DOCTYPE html>
<html>
<head>
	<?php include("_shared_/headconfig.php"); ?>
	<link rel="stylesheet" type="text/css" href="style/profil.css">
	<title>Vampire - Social</title>
</head>
<body>

<?php include('_shared_/header.php') ?>


<!-- -------- CONTENU -------- -->
<section>



	<?php //IF RIEN PRÉCISÉ
	if (empty($_GET)){ ?>

		<h1>PROFIL DE KAFOO</h1>

		<div class="container centering	">


			<table>
				<tr>
					<td align="right">Messages postés :</td>
					<td align="left">
						<span class="infoMembre">12</span></td>
				</tr>
				<tr>
					<td align="right">Grade :</td>
					<td align="left"><span class="infoMembre">Goule</span></td>
				</tr>
			</table>


			<br>
			<h3>Persos :</h3>

			Alma


		</div>
		

	<?php //ENDIF RIEN PRÉCISÉ



	}if(isset($_GET['persoID']) AND !empty($_GET['persoID'])){ //IF PERSO PRÉCISÉ ?>


		<h1>FICHE PERSO - ALMA</h1>

		<div class="container" id="gridFichePerso">
			
			<div class="test" style="grid-area: avatar">
				AVATAR
			</div>

			<div class="test" style="grid-area: infos">
				<h3>Infos</h3>
				<p>
					Nom<br>
					Nature<br>
					Attitude<br>
					Concept<br>
				</p> 
			</div>

			<div class="test" style="grid-area: disciplines">
				<h3>Disciplines</h3>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
			</div>

			<div class="test" style="grid-area: carac">
				<h3>Carac</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p> 
			</div>

			<div class="test" style="grid-area: autres">
				<h3>Autres</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur.dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p> 
			</div>

		</div>


	<?php //ENDIF PERSO PRÉCISÉ
	} ?>








	<div class="container">
		
	</div>

	<div class="container">
		
	</div>

</section>

<?php include("_shared_/scripts.php"); ?>
<script type="text/javascript" src="js/profil.js"></script>

</body>
</html>