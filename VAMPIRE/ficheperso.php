<?php
include("shared/refresh.php");
include("shared/connectDB.php");
include("php/functions.php");
?>


<!DOCTYPE html>
<html>
<head>
	<?php include("shared/headconfig.php"); ?>
	<link rel="stylesheet" type="text/css" href="css/ficheperso.css">
	<title>VAMPIRE - Fiche Perso</title>
</head>
<body>

	<div class="mainGrid">

	<!--HEADER-->
		<?php include("shared/view/header.php"); ?>

	<!--SECTION-->
		<section class="sectionGrid">

			<h1>FICHE PERSONNAGE</h1>


<?php


	if (isset($_GET['persoID']) AND !empty($_GET['persoID'])){

		$persoID = $_GET['persoID'];
		echo '

			<div id="ficheContainer">
					
					<div class="ficheBox">

						<b>Nom</b> : ';echo getInfoPerso("$persoID","nom");echo'<br><br>
						<b>Nature : </b>';echo getInfoPerso("$persoID","nature");echo'<br><br>
						<b>Attitude : </b>';echo getInfoPerso("$persoID","attitude");echo'<br><br>
						<b>Concept : </b>';echo getInfoPerso("$persoID","concept");echo'<br><br>
						<b>Physique : </b>';echo getInfoPerso("$persoID","physique");echo'<br><br>

					</div>


					<div class="ficheBox">

						<img src="img/illusClan/'; echo getInfoPerso("$persoID","clan"); echo '.jpg">
						<h3 class="soustitre">TU ES ';echo strtoupper(getInfoPerso("$persoID","clan"));echo'</h3>'
						;echo getClanDesc(getInfoPerso("$persoID","clan"));echo'

					</div>


					<div class="ficheBox">

						<h3 class="soustitre">Caractéristiques</h3>

						<table id="carac">
							<tr>
								<td>
									<label for="persoForce">Force</label>
								</td>
								<td>
									<span id="displayForce" class="displayCarac">';echo getInfoPerso("$persoID","forc");echo '</span>
								</td>
							</tr>
							<tr>
								<td>
									<label for="persoDexterité">Dexterité</label>
								</td>
								<td>
									<span id="displayDexterité" class="displayCarac">';echo getInfoPerso("$persoID","dexterite");echo '</span>
								</td>
							</tr>
							<tr>
								<td>
									<label for="persoIntelligence">Intelligence</label>
								</td>

								<td>
									<span id="displayIntelligence" class="displayCarac">';echo getInfoPerso("$persoID","intelligence");echo '</span>
								</td>
							</tr>
							<tr>
								<td>
									<label for="persoCharisme">Charisme</label>
								</td>

								<td>
									<span id="displayCharisme" class="displayCarac">';echo getInfoPerso("$persoID","charisme");echo '</span>
								</td>
							</tr>
							<tr>
								<td>
									<label for="persoPerception">Perception</label>
								</td>

								<td>
									<span id="displayPerception" class="displayCarac">';echo getInfoPerso("$persoID","perception");echo '</span>
								</td>
							</tr>
						</table>
					
					</div>


					<div class="ficheBox">

						<h3 class="soustitre">Tes disciplines</h3>

						<div class="infoDisc"><h4>';echo strtoupper(getInfoPerso("$persoID","premDisc"));echo '</h4><br>';echo getInfoDisc(getInfoPerso("$persoID","premDisc"));echo '
						</div>

					</div>

					<div class="ficheBox" style="grid-column: 1/3">
						<h3 class="soustitre">TON HISTOIRE</h3><br>
						<span style="font-style: italic">';echo getInfoPerso("$persoID","lore");echo '<span>
					</div>

			</div>'
			;
	}

	else{
		echo "erreur";
	}

?>

		</section>

	<!--FOOTER-->
		<?php include("shared/view/footer.php"); ?>

	</div>

<script type="text/javascript" src="js/ficheperso.js"></script>
</body>
</html> 