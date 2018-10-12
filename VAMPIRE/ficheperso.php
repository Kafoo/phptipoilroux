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

		$persoID = $_GET['persoID'];?>

			<div id="ficheContainer">
					
					<div class="ficheBox">

						<b>Nom</b> : <?=getInfoPerso("$persoID","nom")?><br><br>
						<b>Nature : </b><?=getInfoPerso("$persoID","nature")?><br><br>
						<b>Attitude : </b><?=getInfoPerso("$persoID","attitude")?><br><br>
						<b>Concept : </b><?=getInfoPerso("$persoID","concept")?><br><br>
						<div class="editButton" id="editButtonPhysique">éditer</div><b>Physique : </b><br><br>
						<span id="persoPhysique"><?=getInfoPerso("$persoID","physique")?></span>
						<div id="editPhysiqueBlock" hidden>
							<form method="POST" action="SERVER_UPDATES.php?action=updatePersoPhysique&persoID=<?=$_GET['persoID']?>">
								<textarea id="editPhysiqueArea" name="contentEditPhysique"></textarea>
								<input type="submit" name="submitEditPhysique" value="J'édite mon physique !">
							</form>
						</div>
						<br><br>

					</div>


					<div class="ficheBox">

						<img src="img/illusClan/<?=getInfoPerso("$persoID","clan")?>.jpg">
						<h3 class="soustitre">TU ES <?=strtoupper(getInfoPerso("$persoID","clan"))?></h3>
						<?=getClanDesc(getInfoPerso("$persoID","clan"))?>

					</div>


					<div class="ficheBox">

						<h3 class="soustitre">Caractéristiques</h3>

						<table id="carac">
							<tr>
								<td>
									<label for="persoForce">Force</label>
								</td>
								<td>
									<span id="displayForce" class="displayCarac"><?=getInfoPerso("$persoID","forc")?></span>
								</td>
							</tr>
							<tr>
								<td>
									<label for="persoDexterité">Dexterité</label>
								</td>
								<td>
									<span id="displayDexterité" class="displayCarac"><?=getInfoPerso("$persoID","dexterite")?></span>
								</td>
							</tr>
							<tr>
								<td>
									<label for="persoIntelligence">Intelligence</label>
								</td>

								<td>
									<span id="displayIntelligence" class="displayCarac"><?=getInfoPerso("$persoID","intelligence")?></span>
								</td>
							</tr>
							<tr>
								<td>
									<label for="persoCharisme">Charisme</label>
								</td>

								<td>
									<span id="displayCharisme" class="displayCarac"><?=getInfoPerso("$persoID","charisme")?></span>
								</td>
							</tr>
							<tr>
								<td>
									<label for="persoPerception">Perception</label>
								</td>

								<td>
									<span id="displayPerception" class="displayCarac"><?=getInfoPerso("$persoID","perception")?></span>
								</td>
							</tr>
						</table>
					
					</div>


					<div class="ficheBox">

						<h3 class="soustitre">Tes disciplines</h3>

						<div class="infoDisc"><h4><?=strtoupper(getInfoPerso("$persoID","premDisc"))?></h4><br><?=getInfoDisc(getInfoPerso("$persoID","premDisc"))?>
						</div>

					</div>

					<div class="ficheBox" style="grid-column: 1/3">
						<h3 class="soustitre">TON HISTOIRE <div class="editButton" id="editButtonLore">éditer</div></h3><br>
						<span id="persoLore"><?=getInfoPerso("$persoID","lore")?></span>
						<div id="editLoreBlock" hidden>
							<form method="POST" action="SERVER_UPDATES.php?action=updatePersoLore&persoID=<?=$_GET['persoID']?>">
								<textarea id="editLoreArea" name="contentEditLore"></textarea>
								<input type="submit" name="submitEditLore" value="J'édite mon histoire !">
							</form>
						</div>
					</div>

			</div>
	<?php
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