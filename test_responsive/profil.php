<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="style/main.css">
	<link rel="stylesheet" type="text/css" href="style/profil.css">
	<title>Vampire - Social</title>
</head>
<body>

<?php include('view/header.php') ?>


<!-- -------- CONTENU -------- -->
<section>



	<?php //IF RIEN PRÉCISÉ
	if (empty($_GET)){ ?>

		<h1>PROFIL DE KAFOO</h1>

		<div class="container">
			<div class="test"><a href="profil.php?persoID=1">Yo</a></div>
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


</body>
</html>