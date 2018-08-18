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
	<link rel="stylesheet" type="text/css" href="css/creaperso.css">
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
				<div id="titre">CREATION DE PERSONNAGE</div>

				<form method="POST" action="">


					<label for="persoNom">Nom :</label>
					<input type="text" name="persoNom" placeholder="Nom du perso">
					<br><br><br>


					<h1 style="text-decoration: underline">CHOISIS TON CLAN</h1>


					<div id="clanBox">


					</div>



					<br><br><br>

					<h1 style="text-decoration: underline">AJUSTE TES CARACTERISTIQUES</h1>

					<br>

					<table>
						<tr>
							<td>
								<label for="persoForce">Force :</label>
							</td>
							<td>
								<input id="valForce" type="range" min="1" max="10" value="1" name="persoForce" oninput="change('Force')">
							</td>
							<td>
								<span id="displayForce" class="displayCarac">1</span>
							</td>
						</tr>
						<tr>
							<td>
								<label for="persoAdresse">Adresse :</label>
							</td>
							<td>
								<input id="valAdresse" type="range" min="1" max="10" value="1" name="persoAdresse" oninput="change('Adresse')">
							</td>
							<td>
								<span id="displayAdresse" class="displayCarac">1</span>
							</td>
						</tr>
						<tr>
							<td>
								<label for="persoMagie">Magie :</label>
							</td>
							<td>
								<input id="valMagie" type="range" min="1" max="10" value="1" name="persoMagie" oninput="change('Magie')">
							</td>
							<td>
								<span id="displayMagie" class="displayCarac">1</span>
							</td>
						</tr>
						<tr>
							<td>
								<label for="persoCharisme">Charisme :</label>
							</td>
							<td>
								<input id="valCharisme" type="range" min="1" max="10" value="1" name="persoCharisme" oninput="change('Charisme')">
							</td>
							<td>
								<span id="displayCharisme" class="displayCarac">1</span>
							</td>
						</tr>
						<tr>
							<td>
								<label for="persoChance">Chance :</label>
							</td>
							<td>
								<input id="valChance" type="range" min="1" max="10" value="1" name="persoChance" oninput="change('Chance')">
							</td>
							<td>
								<span id="displayChance" class="displayCarac">1</span>
							</td>
						</tr>
						<tr>
							<td>Total :</td>
							<td id="totalCarac">5</td>
						</tr>
					</table>


					<br><br><br>

					<input type="submit" name="submit" value="Je te donne la viie !">
				</form>
				<br/>

			</div>
			<br><br><br><br><br><br><br><br><br><br><br><br>

		</section>

	<!--FOOTER-->
		<?php include("shared/view/footer.php"); ?>

	</div>
<script type="text/javascript" src="js/creaperso.js"></script>
</body>
</html> 