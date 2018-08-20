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
	<title>SANS SOUCI</title>
</head>
<body>

	<div class="mainGrid">

	<!--HEADER-->
		<?php include("shared/view/header.php"); ?>

	<!--SECTION-->
		<section class="sectionGrid">
			<div id="subscribeBlock">
				<div id="ariane">FICHE PERSONNAGE</div>



					<table id="formBases">
						<tr>
							<td><label for="persoNom" style="font-weight: bold">Nom</label></td>
						</tr>
						<tr>
							<td><label for="persoNature">Nature</label></td>
						</tr>
						<tr>
							<td><label for="persoAttitude">Attitude</label></td>
						</tr>
						<tr>
							<td><label for="persoConcept">Concept</label></td>
						</tr>
					</table>
					

					<hr width="75%"><br>

						<div class="infoClan" id="infoBrujah"><img src="https://laconfreriedesdeuxtours.files.wordpress.com/2016/06/2.jpg?w=309&h=471">
							<h1>BRUJAH - L'ANARCHIE</h1>
							Selon leur histoire, les Brujahs étaient autrefois les rois-philosophes de la Mésopotamie, de la Perse et de Babylone.<br><br>Dans leur recherche de liberté et d'illumination, ils tuèrent cependant leur fondateur. Pour cela, Caïn les chassa de la Première Cité. Depuis, les Brujahs ont connu un déclin inéluctable. Ils sont considérés comme des enfants gâtés qui n'ont ni fierté, ni sens de l'histoire.<br><br>Bien que membre de la Camarilla, le Clan Brujah est l'agitateur et le trublion de la secte, toujours à la limite des Traditions et se rebellant sans cesse au nom de toutes les causes. De nombreux Brujahs sont des anarchs proscrits, défiant les autorités et ne servant aucun prince.
						</div>

						<br><hr width="75%">

					<div class="ventreBox">

						<h3 class="soustitre">Caractéristiques</h3>

						<table>
							<tr>
								<td>
									<label for="persoForce">Force :</label>
								</td>
								<td>
									<span id="displayForce" class="displayCarac">1</span>
								</td>
							</tr>
							<tr>
								<td>
									<label for="persoDexterité">Dexterité :</label>
								</td>
								<td>
									<span id="displayDexterité" class="displayCarac">1</span>
								</td>
							</tr>
							<tr>
								<td>
									<label for="persoIntelligence">Intelligence :</label>
								</td>

								<td>
									<span id="displayIntelligence" class="displayCarac">1</span>
								</td>
							</tr>
							<tr>
								<td>
									<label for="persoCharisme">Charisme :</label>
								</td>

								<td>
									<span id="displayCharisme" class="displayCarac">1</span>
								</td>
							</tr>
							<tr>
								<td>
									<label for="persoPerception">Perception :</label>
								</td>

								<td>
									<span id="displayPerception" class="displayCarac">1</span>
								</td>
							</tr>

						</table>
					
					</div>
					<hr width="75%">
					<div class="ventreBox">
						<h3 class="soustitre">Tes disciplines</h3>


						<div class="infoDisc" id="infoDiscGen" discShown="true"><h4>Ta première discipline</h4><br>Choisis la discipline avec laquelle ton personnage va commencer sa vie de vampire ! Plus tard, tu découvriras d'autres disciplines, plus ou moins spécifiques à ton clan, plus ou moins puissantes, plus ou moins subtiles, plus ou moins effrayantes ;-)
							<div
							class="logoDisc" 
							id="logoDiscGen" 
							style="cursor: pointer;width: 20px"
							onmouseover="show('disc','logoDiscGen','infoDiscGen')"
							onmouseout="hide('disc','logoDiscGen','infoDiscGen')"
							currentdiscLogo="true">?</div>
						</div>

						<div class="infoDisc" id="infoAugure" hidden><h4>Augure</h4><br>Un vampire doté de la discipline d’augure possède la vision divine, capable de voir plus loin que n’importe quel mortel, de lire l’âme des hommes et même leurs esprits. Les sensations sont tellement puissantes qu’un vampire peut se retrouver déconnecté de la réalité par la force de l’augure.
							<div
							class="logoDisc" 
							id="logoDiscGen" 
							style="cursor: pointer;width: 20px"
							onmouseover="show('disc','logoDiscGen','infoDiscGen')"
							onmouseout="hide('disc','logoDiscGen','infoDiscGen')"
							>?</div>
						</div>

						<div class="infoDisc" id="infoPuissance" hidden><h4>Puissance</h4><br>Puissance apporte au Vampire une force bien au dessus des standards caïnites. Avec elle, le non-mort peut projeter un destrier, bondir sur des distances incroyables ou déchirer un adversaire à mains nues.
							<div
							class="logoDisc" 
							id="logoDiscGen" 
							style="cursor: pointer;width: 20px"
							onmouseover="show('disc','logoDiscGen','infoDiscGen')"
							onmouseout="hide('disc','logoDiscGen','infoDiscGen')"
							>?</div>
						</div>

						<div class="infoDisc" id="infoCelerite" hidden><h4>Célérité</h4><br>En période de stress, certains caïnites ayant la célérité peuvent se déplacer à une vitesse incroyable, devenant flous aux yeux des mortels et immortels ne possédant pas cette discipline. La célérité offre la vitesse dans les espaces sauvages, la précision dans l’art et la prouesse dans l’art du combat.
							<div
							class="logoDisc" 
							id="logoDiscGen" 
							style="cursor: pointer;width: 20px"
							onmouseover="show('disc','logoDiscGen','infoDiscGen')"
							onmouseout="hide('disc','logoDiscGen','infoDiscGen')"
							>?</div>
						</div>

						<div class="infoDisc" id="infoAnimalisme" hidden><h4>Animalisme</h4><br>La discipline de l’animalisme offre au caïnite une intense empathie et un grand pouvoir sur le règne animal. Permettant d’appeler, de discuter avec les animaux, son plus grand pouvoir est celui qu’elle offre sur la Bête qu’il y a en chaque mortel et en chaque Vampire.
							<div
							class="logoDisc" 
							id="logoDiscGen" 
							style="cursor: pointer;width: 20px"
							onmouseover="show('disc','logoDiscGen','infoDiscGen')"
							onmouseout="hide('disc','logoDiscGen','infoDiscGen')"
							>?</div>
						</div>

					</div>

					<hr width="75%"><br>

					<div id="descriptionLore">
						<h3>HISTOIRE</h3><br>
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
						proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
					</div>

					<br>

				<br/>

			</div>


		</section>

	<!--FOOTER-->
		<?php include("shared/view/footer.php"); ?>

	</div>
<script type="text/javascript" src="js/creaperso.js"></script>
</body>
</html> 