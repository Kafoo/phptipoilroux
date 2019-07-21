<?php
include("_shared_/start.php");
include("submits/creaperso_submit.php");
?>

<!DOCTYPE html>
<html>
<head>
	<?php include("_shared_/headconfig.php"); ?>
	<link rel="stylesheet" type="text/css" href="style/creaperso.css">
	<title>Vampire - Création de personnage</title>
</head>
<body>

<?php include('_shared_/header.php') ?>


<!---------- CONTENU ---------->
<section>

	<h1>Création de personnage</h1>

	<form method="POST" action="">

		<div class="titre">QUI ES-TU ?</div>

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


		<div class="ventreBox">
			<h3 class="soustitre">Race</h3>

			<div
			class="logoDisc" 
			id="logoAugure" 
			style="cursor: pointer;"
			onmouseover="show('disc','logoAugure','infoAugure')"
			onmouseout="hide('disc','logoAugure','infoAugure')"
			onclick= "choose('disc','Augure')">
				Augure</div>
			<div
			class="logoDisc" 
			id="logoPuissance" 
			style="cursor: pointer;"
			onmouseover="show('disc','logoPuissance','infoPuissance')"
			onmouseout="hide('disc','logoPuissance','infoPuissance')"
			onclick= "choose('disc','Puissance')">
				Puissance</div>
			<div
			class="logoDisc" 
			id="logoCelerite" 
			style="cursor: pointer;"
			onmouseover="show('disc','logoCelerite','infoCelerite')"
			onmouseout="hide('disc','logoCelerite','infoCelerite')"
			onclick= "choose('disc','Celerite')">
				Célérité</div>
			<div
			class="logoDisc" 
			id="logoAnimalisme" 
			style="cursor: pointer;"
			onmouseover="show('disc','logoAnimalisme','infoAnimalisme')"
			onmouseout="hide('disc','logoAnimalisme','infoAnimalisme')"
			onclick= "choose('disc','Animalisme')">
				Animalisme</div>

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

			<input id="discStock" type="text" name="persoDisc" hidden>

		</div>

		<div class="ventreBox">
			<h3 class="soustitre">Classe</h3>

			<div
			class="logoDisc" 
			id="logoAugure" 
			style="cursor: pointer;"
			onmouseover="show('disc','logoAugure','infoAugure')"
			onmouseout="hide('disc','logoAugure','infoAugure')"
			onclick= "choose('disc','Augure')">
				Augure</div>
			<div
			class="logoDisc" 
			id="logoPuissance" 
			style="cursor: pointer;"
			onmouseover="show('disc','logoPuissance','infoPuissance')"
			onmouseout="hide('disc','logoPuissance','infoPuissance')"
			onclick= "choose('disc','Puissance')">
				Puissance</div>
			<div
			class="logoDisc" 
			id="logoCelerite" 
			style="cursor: pointer;"
			onmouseover="show('disc','logoCelerite','infoCelerite')"
			onmouseout="hide('disc','logoCelerite','infoCelerite')"
			onclick= "choose('disc','Celerite')">
				Célérité</div>
			<div
			class="logoDisc" 
			id="logoAnimalisme" 
			style="cursor: pointer;"
			onmouseover="show('disc','logoAnimalisme','infoAnimalisme')"
			onmouseout="hide('disc','logoAnimalisme','infoAnimalisme')"
			onclick= "choose('disc','Animalisme')">
				Animalisme</div>

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

			<input id="discStock" type="text" name="persoDisc" hidden>

		</div>

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

		<div class="ventreBox">
			<h3 class="soustitre">Ta première discipline</h3>

			<div
			class="logoDisc" 
			id="logoAugure" 
			style="cursor: pointer;"
			onmouseover="show('disc','logoAugure','infoAugure')"
			onmouseout="hide('disc','logoAugure','infoAugure')"
			onclick= "choose('disc','Augure')">
				Augure</div>
			<div
			class="logoDisc" 
			id="logoPuissance" 
			style="cursor: pointer;"
			onmouseover="show('disc','logoPuissance','infoPuissance')"
			onmouseout="hide('disc','logoPuissance','infoPuissance')"
			onclick= "choose('disc','Puissance')">
				Puissance</div>
			<div
			class="logoDisc" 
			id="logoCelerite" 
			style="cursor: pointer;"
			onmouseover="show('disc','logoCelerite','infoCelerite')"
			onmouseout="hide('disc','logoCelerite','infoCelerite')"
			onclick= "choose('disc','Celerite')">
				Célérité</div>
			<div
			class="logoDisc" 
			id="logoAnimalisme" 
			style="cursor: pointer;"
			onmouseover="show('disc','logoAnimalisme','infoAnimalisme')"
			onmouseout="hide('disc','logoAnimalisme','infoAnimalisme')"
			onclick= "choose('disc','Animalisme')">
				Animalisme</div>

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

			<input id="discStock" type="text" name="persoDisc" hidden>

		</div>

		<div class="titre">QUEL EST TON HISTOIRE ?</div>
		
		<div id="descriptionLore">
			<b>C'est ici que tu vas décrire librement ton personnage, ce qu'il a vécu, ce qui fait ce qu'il est aujourd'hui.</b><br><br>Quel âge a-t-il ? A-t-il un travail, de la famille, des amis ? Quel a été son premier contact avec le monde des vampires ? Qui est son Sire, son Etreinte a-t-elle été agréable ? Où est-il réfugié depuis, et que pense-t-il de tout ça ?<br><br>Libre à toi d'écrire 3 lignes, ou un bouquin ;-)
			<textarea id="lore" name="persoLore" placeholder="Allez, raconte-nous tout."><?php if (isset($_POST['persoLore'])){echo $_POST['persoLore'];}else{echo'';}?></textarea>
		</div>

		<input id="submitAll" type="submit" name="submit" value="C'est parti !">

	</form>

</section>

<?php include("_shared_/scripts.php"); ?>
<script type="text/javascript" src="js/creaperso.js"></script>

</body>
</html>