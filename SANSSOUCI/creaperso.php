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
	<title>SANS SOUCI</title>
</head>
<body>

	<div class="mainGrid">

	<!--HEADER-->
		<?php include("shared/view/header.php"); ?>

	<!--SECTION-->
		<section class="sectionGrid">
			<div id="subscribeBlock">
				<h1>CREATION DE PERSONNAGE</h1>
				<form method="POST" action="">
					<table>
						
						<tr>
							<td>
								<label for="persoNom">Nom :</label>
							</td>
							<td>
								<input type="text" name="persoNom" placeholder="Nom du perso">
							</td>
						</tr>
						<tr>
							<td>
								<label for="persoRace">Race :</label>
							</td>
							<td>
								<input type="text" name="persoRace" placeholder="Race de perso">
							</td>
						</tr>
						<tr>
							<td>
								<label for="persoClasse">Classe :</label>
							</td>
							<td>
								<input type="text" name="persoClasse" placeholder="Classe du perso">
							</td>
						</tr>

					</table>
					<br/>
					<table>

						<tr>
							<td>
								<label for="persoForce">Force :</label>
							</td>
							<td>
								<input type="checkbox" name="persoForce1">1
								<input type="checkbox" name="persoForce2">2
								<input type="checkbox" name="persoForce3">3
								<input type="checkbox" name="persoForce4">4
								<input type="checkbox" name="persoForce5">5
							</td>
						</tr>
						<tr>
							<td>
								<label for="persoForce">Adresse :</label>
							</td>
							<td>
								<input type="checkbox" name="persoAdresse1">1
								<input type="checkbox" name="persoAdresse2">2
								<input type="checkbox" name="persoAdresse3">3
								<input type="checkbox" name="persoAdresse4">4
								<input type="checkbox" name="persoAdresse5">5
							</td>
						</tr>
						<tr>
							<td>
								<label for="persoForce">Magie :</label>
							</td>
							<td>
								<input type="checkbox" name="persoMagie1">1
								<input type="checkbox" name="persoMagie2">2
								<input type="checkbox" name="persoMagie3">3
								<input type="checkbox" name="persoMagie4">4
								<input type="checkbox" name="persoMagie5">5
							</td>
						</tr>
						<tr>
							<td>
								<label for="persoForce">Charisme :</label>
							</td>
							<td>
								<input type="checkbox" name="persoCharisme1">1
								<input type="checkbox" name="persoCharisme2">2
								<input type="checkbox" name="persoCharisme3">3
								<input type="checkbox" name="persoCharisme4">4
								<input type="checkbox" name="persoCharisme5">5
							</td>
						</tr>
						<tr>
							<td>
								<label for="persoForce">Chance :</label>
							</td>
							<td>
								<input type="checkbox" name="persoChance1">1
								<input type="checkbox" name="persoChance2">2
								<input type="checkbox" name="persoChance3">3
								<input type="checkbox" name="persoChance4">4
								<input type="checkbox" name="persoChance5">5
							</td>
						</tr>


					</table>
					<br/>
					<input type="submit" name="submit" value="Je te donne la viie !">
				</form>
				<br/>

			</div>


		</section>

	<!--FOOTER-->
		<?php include("shared/view/footer.php"); ?>

	</div>



</body>
</html> 