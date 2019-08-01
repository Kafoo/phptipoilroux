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


<!---------- CONTENU ---------->
<section>

	<h1>Création de personnage</h1>

	<form method="POST" action="">


		<?php
		if (!isset($_GET['avID']) OR !isset($_GET['userID']) OR $_GET['avID']=='' OR $_GET['userID']=='') {
			echo 'il y a eu un petit souci en route... Merci de réessayer <br><a href="aventures.php"><u>Retour aux aventures</u></a>';
		}else{ 

			$avID = $_GET['avID'];
			$userID = $_GET['userID'];
			//On récupère les différentes natures de l'univers
			$req = $bdd->query("
				SELECT nat.id, nat.name, nat.type
				FROM natures as nat
				LEFT JOIN rel_univ2natures as u2n
				ON nat.id = u2n.natureID
				LEFT JOIN mas_aventures as av
				ON u2n.univID = av.univID
				WHERE av.id = 35
				");
			$natures = $req->fetchall();
			?>

			<div class="titre">QUI ES-TU ?</div>


			<div class="ventreBox">
				<div class="raceBox">
					<div class="selectBox">
						<h4>Ta race :</h4>
						<select class="selectNature" natureType="race" natureID="">
							<?php
							foreach ($natures as $nature) {
								if ($nature['type'] == 'race') { ?>
									<option value="<?=$nature['id']?>"><?=$nature['name']?></option>
								<?php
								}
							} ?>
						</select>
					</div>
					<div class="descriptionBox">					
						<div class="raceDescription"></div>
					</div>
				</div>
				<div class="capaBox">
					<div class="selectBox">
						<h4>Ta première capacité :</h4>
						<select class="selectPower selectCapacite">
						</select>
					</div>
					<div class="descriptionBox">
						<div class="capaciteDescription-container"></div>
					</div>		
				</div>

			</div>
			<div class="ventreBox">
				<div class="classeBox">
					<div class="selectBox">
						<h4>Ta classe :</h4>
						<select class="selectNature" natureType="classe" natureID="">
							<?php
							foreach ($natures as $nature) {
								if ($nature['type'] == 'classe') { ?>
									<option value="<?=$nature['id']?>"><?=$nature['name']?></option>
								<?php
								}
							} ?>
						</select>
					</div>				
					<div class="descriptionBox">				
						<div class="classeDescription"></div>
					</div>
				</div>

				<div class="disciplineBox">
					<div class="selectBox">
						<h4>Ta première discipline :</h4>
						<select class="selectPower selectDiscipline">
						</select>
					</div>				
					<div class="descriptionBox">
						<div class="disciplineDescription-container"></div>
					</div>
				</div>
			</div>







			<table id="formBases">
				<tr>
					<td><label for="persoNom"><b>Nom :</b></label></td>
					<td><input type="text" name="persoNom" placeholder="Nom du perso" maxlength="20" value="<?php if (isset($_POST['persoNom'])){echo $_POST['persoNom'];}else{echo'';}?>"></td>
					<td></td>
				</tr>
				<tr>
					<td><label for="persoNature">Nature :</label></td>
					<td><input type="text" name="persoNature" placeholder="1 adjectif" maxlength="20" value="<?php if (isset($_POST['persoNature'])){echo $_POST['persoNature'];}else{echo'';}?>"></td>
					<td>
						<img src="img/global/help.png" onmouseover="showHelp('Nature')" onmouseout="hideHelp('Nature')">
						<div class="helpDiv" id="helpNature" hidden>La nature d'un personnage est sa véritable personnalité, ce qu'il est fondamentalement. <br/><i>Exemples : simplet, démoniaque, passionné, intéressé, altruiste, pervers...</i></div>
					</td>
				</tr>
				<tr>
					<td><label for="persoAttitude">Attitude :</label></td>
					<td><input type="text" name="persoAttitude" placeholder="1 adjectif" maxlength="20" value="<?php if (isset($_POST['persoAttitude'])){echo $_POST['persoAttitude'];}else{echo'';}?>"></td>
					<td>
						<img src="img/global/help.png" onmouseover="showHelp('Attitude')" onmouseout="hideHelp('Attitude')">
						<div class="helpDiv" id="helpAttitude" hidden>L'attitude d'un personnage est ce qu'il montre de sa personnalité. Plus elle est contraire à sa nature, plus le personnage cache son jeu.<br/><i>Exemples : simplet, démoniaque, passionné, intéressé, altruiste, pervers...</i></div>
					</td>
				</tr>
				<tr>
					<td><label for="persoConcept">Concept :</label></td>
					<td><input type="text" name="persoConcept" placeholder="1 concept" maxlength="20" value="<?php if (isset($_POST['persoConcept'])){echo $_POST['persoConcept'];}else{echo'';}?>"></td>
					<td>
						<img src="img/global/help.png" onmouseover="showHelp('Concept')" onmouseout="hideHelp('Concept')">
						<div class="helpDiv" id="helpConcept" hidden>Le concept d'un personnage est ce qui prépondère le plus dans sa vie d'humain (avant l'Etreinte) : son métier, sa passion, ou encore sa position sociale.<br/><i>Exemples : drogue addict, charpentier, boxer, hermite...</i></div>
					</td>
				</tr>
				<tr>
					<td><label for="persoDefaut">Défaut :</label></td>
					<td><input type="text" name="persoDefaut" placeholder="Ton défaut" maxlength="30" value="<?php if (isset($_POST['persoDefaut'])){echo $_POST['persoDefaut'];}else{echo'';}?>"></td>

					<td>
						<img src="img/global/help.png" onmouseover="showHelp('Defaut')" onmouseout="hideHelp('Defaut')">
						<div class="helpDiv" id="helpDefaut" hidden>Un petit défaut de ton choix, pour donner un peu de réalisme à ton perso !</i></div>
					</td>
				</tr>
			</table>

			<br><br><label for="persoPhysique">Physique :</label><br>
			<textarea name="persoPhysique" placeholder="Rapidement, à quoi tu ressembles ?" maxlength="400" style="width: 280px; height: 80px; margin-top: 10px;"><?php if (isset($_POST['persoPhysique'])){echo $_POST['persoPhysique'];}else{echo'';}?></textarea>



			<div class="titre">T'AS QUOI DANS LE VENTRE ?</div>

			<div class="ventreBox">

				<h3 class="soustitre">Caractéristiques</h3>

				<table>
					<tr>
						<td>
							<label for="persoForce">Force :</label>
						</td>
						<td>
							<input id="valForce" type="range" min="1" max="10" 
							value="1" 
							name="persoForce" oninput="change('Force')">
						</td>
						<td>
							<span id="displayForce" class="displayCarac">1</span>
						</td>
					</tr>
					<tr>
						<td>
							<label for="persoDexterite">Dexterité :</label>
						</td>
						<td>
							<input id="valDexterite" type="range" min="1" max="10" value="1" name="persoDexterite" oninput="change('Dexterite')">
						</td>
						<td>
							<span id="displayDexterite" class="displayCarac">1</span>
						</td>
					</tr>
					<tr>
						<td>
							<label for="persoIntelligence">Intelligence :</label>
						</td>
						<td>
							<input id="valIntelligence" type="range" min="1" max="10" value="1" name="persoIntelligence" oninput="change('Intelligence')">
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
							<input id="valCharisme" type="range" min="1" max="10" value="1" name="persoCharisme" oninput="change('Charisme')">
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
							<input id="valPerception" type="range" min="1" max="10" value="1" name="persoPerception" oninput="change('Perception')">
						</td>
						<td>
							<span id="displayPerception" class="displayCarac">1</span>
						</td>
					</tr>
					<tr style="height: 60px;">
						<td></td>
						<td style="text-align: center; font-weight: bold;"> Total :</td>
						<td id="totalCarac">5</td>
						<td>/25</td>
					</tr>
				</table>
			
			</div>

			<div class="titre">QUEL EST TON HISTOIRE ?</div>
			
			<div id="descriptionLore">
				<b>C'est ici que tu vas décrire librement ton personnage, ce qu'il a vécu, ce qui fait ce qu'il est aujourd'hui.</b><br><br>Quel âge a-t-il ? A-t-il un travail, de la famille, des amis ? Quel a été son premier contact avec le monde des vampires ? Qui est son Sire, son Etreinte a-t-elle été agréable ? Où est-il réfugié depuis, et que pense-t-il de tout ça ?<br><br>Libre à toi d'écrire 3 lignes, ou un bouquin ;-)
				<textarea id="lore" name="persoLore" placeholder="Allez, raconte-nous tout."><?php if (isset($_POST['persoLore'])){echo $_POST['persoLore'];}else{echo'';}?></textarea>
			</div>

			<input id="submitAll" type="submit" name="submit" value="C'est parti !">

		<?php
		} ?>

	</form>

</section>

<?php include("_shared_/scripts.php"); ?>
<script type="text/javascript" src="js/creaperso.js"></script>

</body>
</html>