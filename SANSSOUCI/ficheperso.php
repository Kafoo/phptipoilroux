<?php
include("shared/refresh.php");
include("shared/connectDB.php");

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/ficheperso.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<title>VAMPIRE - fiche perso</title>
</head>
<body>

	<div class="mainGrid">

	<!--HEADER-->
		<?php include("shared/view/header.php"); ?>

	<!--SECTION-->
		<section class="sectionGrid">

			<div id="ariane">FICHE PERSONNAGE</div>

			<div id="ficheContainer">
					
					<div class="ficheBox">
						Nom<br>
						Nature<br>
						Attitude<br>
						Concept<br>
						Physique<br><br>
						Et d'autres trucs
					</div>

					<div class="ficheBox">
						<img src="https://laconfreriedesdeuxtours.files.wordpress.com/2016/06/2.jpg?w=309&h=471">
						<h1>TU ES BRUJAH</h1>
						Selon leur histoire, les Brujahs étaient autrefois les rois-philosophes de la Mésopotamie, de la Perse et de Babylone.<br><br>Dans leur recherche de liberté et d'illumination, ils tuèrent cependant leur fondateur. Pour cela, Caïn les chassa de la Première Cité. Depuis, les Brujahs ont connu un déclin inéluctable. Ils sont considérés comme des enfants gâtés qui n'ont ni fierté, ni sens de l'histoire.<br><br>Bien que membre de la Camarilla, le Clan Brujah est l'agitateur et le trublion de la secte, toujours à la limite des Traditions et se rebellant sans cesse au nom de toutes les causes. De nombreux Brujahs sont des anarchs proscrits, défiant les autorités et ne servant aucun prince.
					</div>


					<div class="ficheBox">

						<h3 class="soustitre">Caractéristiques</h3>

						<table>
							<tr>
								<td>
									<label for="persoForce">Force</label>
								</td>
								<td>
									<span id="displayForce" class="displayCarac">1</span>
								</td>
							</tr>
							<tr>
								<td>
									<label for="persoDexterité">Dexterité</label>
								</td>
								<td>
									<span id="displayDexterité" class="displayCarac">1</span>
								</td>
							</tr>
							<tr>
								<td>
									<label for="persoIntelligence">Intelligence</label>
								</td>

								<td>
									<span id="displayIntelligence" class="displayCarac">1</span>
								</td>
							</tr>
							<tr>
								<td>
									<label for="persoCharisme">Charisme</label>
								</td>

								<td>
									<span id="displayCharisme" class="displayCarac">1</span>
								</td>
							</tr>
							<tr>
								<td>
									<label for="persoPerception">Perception</label>
								</td>

								<td>
									<span id="displayPerception" class="displayCarac">1</span>
								</td>
							</tr>
						</table>
					
					</div>


					<div class="ficheBox">

						<h3 class="soustitre">Tes disciplines</h3>

						<div class="infoDisc"><h4>Animalisme</h4><br>La discipline de l’animalisme offre au caïnite une intense empathie et un grand pouvoir sur le règne animal. Permettant d’appeler, de discuter avec les animaux, son plus grand pouvoir est celui qu’elle offre sur la Bête qu’il y a en chaque mortel et en chaque Vampire.
						</div>

					</div>

					<div class="ficheBox" style="grid-column: 1/3">
						<h3>HISTOIRE</h3><br>
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
						proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
					</div>

			</div>


		</section>

	<!--FOOTER-->
		<?php include("shared/view/footer.php"); ?>

	</div>
</body>
</html> 