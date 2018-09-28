<?php
include("shared/refresh.php");
include("shared/connectDB.php");
include("php/functions.php");

//VERIFICATION DE LA BONNE CREATION
if (isset($_POST['submit'])){

	if (!empty($_POST['persoNom']) AND 
		!empty($_POST['persoNature']) AND 
		!empty($_POST['persoAttitude']) AND 
		!empty($_POST['persoConcept']) AND 
		!empty($_POST['persoDefaut']) AND 
		!empty($_POST['persoPhysique']) AND 
		!empty($_POST['persoClan']) AND 
		!empty($_POST['persoForce']) AND 
		!empty($_POST['persoDexterite']) AND 
		!empty($_POST['persoIntelligence']) AND 
		!empty($_POST['persoCharisme']) AND 
		!empty($_POST['persoPerception']) AND 
		!empty($_POST['persoDisc']) AND 
		!empty($_POST['persoLore']) ) {

		$persoNom = htmlspecialchars($_POST['persoNom'], ENT_QUOTES);
		$persoNature = htmlspecialchars($_POST['persoNature'], ENT_QUOTES);
		$persoAttitude = htmlspecialchars($_POST['persoAttitude'], ENT_QUOTES);
		$persoConcept = htmlspecialchars($_POST['persoConcept'], ENT_QUOTES);
		$persoDefaut = htmlspecialchars($_POST['persoDefaut'], ENT_QUOTES);
		$persoPhysique = htmlspecialchars($_POST['persoPhysique'], ENT_QUOTES);
		$persoClan = strtolower(htmlspecialchars($_POST['persoClan'], ENT_QUOTES));
		$persoForce = htmlspecialchars($_POST['persoForce'], ENT_QUOTES);
		$persoDexterite = htmlspecialchars($_POST['persoDexterite'], ENT_QUOTES);
		$persoIntelligence = htmlspecialchars($_POST['persoIntelligence'], ENT_QUOTES);
		$persoCharisme = htmlspecialchars($_POST['persoCharisme'], ENT_QUOTES);
		$persoPerception = htmlspecialchars($_POST['persoPerception'], ENT_QUOTES);
		$persoDisc = strtolower(htmlspecialchars($_POST['persoDisc'], ENT_QUOTES));
		$persoLore = htmlspecialchars($_POST['persoLore'], ENT_QUOTES);

		$reqNomPerso = $bdd->prepare("SELECT * FROM ss_persos WHERE nom = ?");
		$reqNomPerso->execute(array($persoNom));
		$nomPersoExist = $reqNomPerso->rowCount();

		if ($nomPersoExist == 0) {

			if ($persoForce + $persoDexterite + $persoIntelligence + $persoCharisme + $persoPerception == 25) {

				$membreID = $_SESSION['id'];
				//Rend tout les autres persos inactifs
				$bdd->query("UPDATE ss_persos SET actif = '0' WHERE membreID='$membreID'");

				//Insert le perso dans la BDD
				$bdd -> query ("INSERT INTO ss_persos (membreID, nom, nature, attitude, concept, defaut, physique, clan, forc, dexterite, intelligence, charisme, perception, lore, premDisc) VALUES ('$membreID','$persoNom','$persoNature','$persoAttitude','$persoConcept','$persoDefaut','$persoPhysique','$persoClan','$persoForce','$persoDexterite','$persoIntelligence','$persoCharisme','$persoPerception','$persoLore','$persoDisc')" );



				header("Location: profil.php");
			}
			else{
				$errorCrea = "La somme de tes caractéristiques doit être 25 !";
			}
		}
		else{
			$errorCrea = "Ce nom de personnage est déjà pris !";
		}
	}
	else{
		$errorCrea = "Tous les champs doivent être complétés ! (n'oublie pas de séléctionner un clan et une discipline)";
	}
}

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/creaperso.css">
<!-- 	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
	<script src="shared/jquery"></script>
	<title>SANS SOUCI</title>
</head>
<body>

	<div class="mainGrid">

	<!--HEADER-->
		<?php include("shared/view/header.php"); ?>

	<!--SECTION-->
		<section class="sectionGrid">
			<div id="subscribeBlock">
				<div id="ariane">CREATION DE PERSONNAGE</div>


				<?php
					if (isset($errorCrea)) {
						echo '
						<div id="erreur">
							<h3 style="margin-top:5px;">Oups !</h3>
							'.$errorCrea.'
						</div>';
					}
				?>

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
								<img src="img/help.png" onmouseover="showHelp('Nature')" onmouseout="hideHelp('Nature')">
								<div class="helpDiv" id="helpNature" hidden>La nature d'un personnage est sa véritable personnalité, ce qu'il est fondamentalement. <br/><i>Exemples : simplet, démoniaque, passionné, intéressé, altruiste, pervers...</i></div>
							</td>
						</tr>
						<tr>
							<td><label for="persoAttitude">Attitude :</label></td>
							<td><input type="text" name="persoAttitude" placeholder="1 adjectif" maxlength="20" value="<?php if (isset($_POST['persoAttitude'])){echo $_POST['persoAttitude'];}else{echo'';}?>"></td>
							<td>
								<img src="img/help.png" onmouseover="showHelp('Attitude')" onmouseout="hideHelp('Attitude')">
								<div class="helpDiv" id="helpAttitude" hidden>L'attitude d'un personnage est ce qu'il montre de sa personnalité. Plus elle est contraire à sa nature, plus le personnage cache son jeu.<br/><i>Exemples : simplet, démoniaque, passionné, intéressé, altruiste, pervers...</i></div>
							</td>
						</tr>
						<tr>
							<td><label for="persoConcept">Concept :</label></td>
							<td><input type="text" name="persoConcept" placeholder="1 concept" maxlength="20" value="<?php if (isset($_POST['persoConcept'])){echo $_POST['persoConcept'];}else{echo'';}?>"></td>
							<td>
								<img src="img/help.png" onmouseover="showHelp('Concept')" onmouseout="hideHelp('Concept')">
								<div class="helpDiv" id="helpConcept" hidden>Le concept d'un personnage est ce qui prépondère le plus dans sa vie d'humain (avant l'Etreinte) : son métier, sa passion, ou encore sa position sociale.<br/><i>Exemples : drogue addict, charpentier, boxer, hermite...</i></div>
							</td>
						</tr>
						<tr>
							<td><label for="persoDefaut">Défaut :</label></td>
							<td><input type="text" name="persoDefaut" placeholder="Ton défaut" maxlength="30" value="<?php if (isset($_POST['persoDefaut'])){echo $_POST['persoDefaut'];}else{echo'';}?>"></td>
							<td>
								<img src="img/help.png" onmouseover="showHelp('Defaut')" onmouseout="hideHelp('Defaut')">
								<div class="helpDiv" id="helpDefaut" hidden>Un petit défaut de ton choix, pour donner un peu de réalisme à ton perso !</i></div>
							</td>
						</tr>
					</table>

					<br><br><label for="persoPhysique">Physique :</label><br>
						<textarea name="persoPhysique" placeholder="Rapidement, à quoi tu ressembles ?" maxlength="400" style="width: 280px; height: 80px; margin-top: 10px;"><?php if (isset($_POST['persoPhysique'])){echo $_POST['persoPhysique'];}else{echo'';}?></textarea>
					


					<div class="titre">QUEL EST TON CLAN ?</div>


					<div id="clanBox">

						<div id="logoBox">
							<div
							class="logoClan" 
							id="logoGen" 
							style="background-image: url('img/info.png');cursor: pointer;"
							onmouseover="show('clan','logoGen','infoGen')"
							onmouseout="hide('clan','logoGen','infoGen')"
							currentclanLogo="true">
							</div>
							<div 
							class="logoClan" 
							id="logoVentrue" 
							style="background-image: url('img/logoClan/ventrue.png');cursor: pointer;"
							onmouseover="show('clan','logoVentrue','infoVentrue')"
							onmouseout="hide('clan','logoVentrue','infoVentrue')"
							onclick= "choose('clan','Ventrue')">
							</div>
							<div 
							class="logoClan"
							id="logoMalkavien" 
							style="background-image: url('img/logoClan/malkavien.png');cursor: pointer;"
							onmouseover="show('clan','logoMalkavien','infoMalkavien')"
							onmouseout="hide('clan','logoMalkavien','infoMalkavien')"
							onclick= "choose('clan','Malkavien')">
							</div>
							<div 
							class="logoClan" 
							id="logoToreador" 
							style="background-image: url('img/logoClan/toreador.png');cursor: pointer;"
							onmouseover="show('clan','logoToreador','infoToreador')"
							onmouseout="hide('clan','logoToreador','infoToreador')"
							onclick= "choose('clan','Toreador')">
							</div>
							<div 
							class="logoClan"
							id="logoGangrel" 
							style="background-image: url('img/logoClan/gangrel.png');cursor: pointer;"
							onmouseover="show('clan','logoGangrel','infoGangrel')"
							onmouseout="hide('clan','logoGangrel','infoGangrel')"
							onclick= "choose('clan','Gangrel')">
							</div>
							<div 
							class="logoClan" 
							id="logoBrujah" 
							style="background-image: url('img/logoClan/brujah.png');cursor: pointer;"
							onmouseover="show('clan','logoBrujah','infoBrujah')" 
							onmouseout="hide('clan','logoBrujah','infoBrujah')"
							onclick= "choose('clan','Brujah')">
							</div>
							<div 
							class="logoClan" 
							id="logoTremere" 
							style="background-image: url('img/logoClan/tremere.png');cursor: pointer;"
							onmouseover="show('clan','logoTremere','infoTremere')" 
							onmouseout="hide('clan','logoTremere','infoTremere')"
							onclick= "choose('clan','Tremere')">
							</div>
							<div 
							class="logoClan" 
							id="logoNosferatu" 
							style="background-image: url('img/logoClan/nosferatu.png');cursor: pointer;"
							onmouseover="show('clan','logoNosferatu','infoNosferatu')" 
							onmouseout="hide('clan','logoNosferatu','infoNosferatu')"
							onclick= "choose('clan','Nosferatu')">
							</div>
							<div 
							class="logoClan" 
							id="logoRavnos" 
							style="background-image: url('img/logoClan/ravnos.png');cursor: pointer;"
							onmouseover="show('clan','logoRavnos','infoRavnos')" 
							onmouseout="hide('clan','logoRavnos','infoRavnos')"
							onclick= "choose('clan','Ravnos')">
							</div>
							<div 
							class="logoClan" 
							id="logoGiovanni" 
							style="background-image: url('img/logoClan/giovanni.png');cursor: pointer;"
							onmouseover="show('clan','logoGiovanni','infoGiovanni')" 
							onmouseout="hide('clan','logoGiovanni','infoGiovanni')"
							onclick= "choose('clan','Giovanni')">
							</div>
							<div 
							class="logoClan" 
							id="logoAssamite" 
							style="background-image: url('img/logoClan/assamite.png');cursor: pointer;"
							onmouseover="show('clan','logoAssamite','infoAssamite')" 
							onmouseout="hide('clan','logoAssamite','infoAssamite')"
							onclick= "choose('clan','Assamite')">
							</div>
							<div 
							class="logoClan" 
							id="logoSethite" 
							style="background-image: url('img/logoClan/sethite.png');cursor: pointer;"
							onmouseover="show('clan','logoSethite','infoSethite')" 
							onmouseout="hide('clan','logoSethite','infoSethite')"
							onclick= "choose('clan','Sethite')">
							</div>
							<div 
							class="logoClan" 
							id="logoLasombra" 
							style="background-image: url('img/logoClan/lasombra.png');cursor: pointer;"
							onmouseover="show('clan','logoLasombra','infoLasombra')" 
							onmouseout="hide('clan','logoLasombra','infoLasombra')"
							onclick= "choose('clan','Lasombra')">
							</div>
							<div 
							class="logoClan" 
							id="logoTzimisce" 
							style="background-image: url('img/logoClan/tzimisce.png');cursor: pointer;"
							onmouseover="show('clan','logoTzimisce','infoTzimisce')" 
							onmouseout="hide('clan','logoTzimisce','infoTzimisce')"
							onclick= "choose('clan','Tzimisce')">
							</div>
						</div>

						<div class="infoClan" id="infoGen" clanShown="true">
							<img src="https://img.etsystatic.com/il/678f26/1388933820/il_570xN.1388933820_646q.jpg?version=1">
							<h1>LES CLANS</h1>
							Selon le mythe des Antédiluviens, Caïn a engendré un certain nombre de descendants, qui ont engendré à leur tour. <br><br>Ces infants, la Troisième Génération, étaient les créateurs des clans modernes, et tous les vampires qui en descendent partagent des traits et des caractéristiques communes. Chaque clan a des forces, des faiblesses et des traits de caractères qui permettent d'en identifier les membres. <br><br>Il existe 13 clans connus, chacun censé descendre d'un Antédiluvien. Il est largement accepté que parmi les 13 "grands" clans, sept appartiennent à la Camarilla, deux au Sabbat et les quatre derniers restent en dehors des sectes.<br><br><b>Clique sur l'icone d'un clan pour le choisir !</b>
						</div>

						<div class="infoClan" id="infoVentrue" hidden>
							<img src="img/illusClan/ventrue.jpg">
							<h1>VENTRUE - L'ELITE</h1>
							Véritable chef de file de la Camarilla, le Clan Ventrue prétend lui avoir donné naissance et soutenir la secte depuis toujours. Il suspecte un membre du Clan Brujah d'avoir détruit son fondateur, ce qui est une blessure d'orgueil très cruelle.<br><br>Quelle qu'en soit la raison historique, le clan n'a plus de fondateur, et a de ce fait gagné son indépendance par rapport aux Antédiluviens. Toutefois, le Clan Ventrue est très actif dans le Jyhad, et peut exercer sa formidable influence sur les faits et gestes du bétail.<br><br>Les vampires sont très curieux de connaître ce qui se passe à l'intérieur de ce clan très bien organisé, et des rumeurs de sombres mystères et d'Aïeuls en sommeil s'échappent parfois de la façade austère des Ventrues. 
						</div>

						<div class="infoClan" id="infoMalkavien" hidden><img src="img/illusClan/malkavien.jpg"> 
							<h1>MALKAVIEN - LA FOLIE</h1>
							Le Clan Malkavien a souffert tout au long de son histoire et continue à souffrir chaque nuit. Chaque membre de ce clan est affligé de folie, et tous sont esclaves de leurs lubies.<br><br>Le fondateur du Clan Malkavien était, selon la rumeur, un des vampires les plus importants de l'époque, mais il aurait commis un crime impardonnable. Caïn aurait alors maudit sa descendance. Durant l'histoire caïnite, les Malkaviens ont été tour à tour craints pour leurs comportements étranges et recherchés pour leur perspicacité encore plus étrange.<br><br>Bien les Malkaviens aient été historiquement dispersés et désorganisé, de récentes vagues migratoires et d'inexplicables rassemblements font s'interroger — et s'inquiéter — de nombreux anciens futur du clan dément.
						</div>

						<div class="infoClan" id="infoToreador" hidden><img src="img/illusClan/toreador.jpg">
							<h1>TOREADOR - L'ART</h1>
							Les plus prodigues des vampires, les Toréadors aiment les excès et la décadence, tout en affirmant être les protecteurs de l'art.<br><br>Ce mécénat est une réalité, le clan comptant dans ses rangs de nombreux artistes de talent, musiciens, poètes, écrivains et autres créateurs. D'un autre côté, il y a également beaucoup de poseurs, qui se donnent des allures de grands esthètes, mais sont incapables de créer quoi que ce soit.<br><br>Ils passent souvent des siècles dans la frustration d’accomplir une nouvelle oeuvre. Ils considèrent qu’ils se doivent de cultiver ce qui est le mieux pour l’humanité. Ils leur arrivent donc d’Etreindre un être doué dans son art pour conserver son talent pour l’éternité. Mais chaque Toreador a bien évidemment son sens du talent.
						</div>

						<div class="infoClan" id="infoGangrel" hidden><img src="img/illusClan/gangrel.jpg">
							<h1>GANGREL - L'ANIMAL</h1>
							Les Gangrels, maraudeurs nocturnes, sont des vampires féroces, avec de déplaisantes caractéristiques et tendances animales. Restant rarement en place, ce sont des nomades qui ne trouvent du plaisir qu'en voyageant seuls sous la lune.<br><br>Selon la légende, leur fondateur était un barbare, au contraire des autres, et c'est pour cette raison que les Gangrels donnent parfois l'Étreinte à des étrangers. Distants, fiers et sauvages, les Gangrels sont souvent tragiques. Bien que beaucoup haïssent les villes étouffantes et grouillantes, la présence de garous hostiles empêche les Gangrels d'y échapper.<br><br>Ils ne semblent soutenir la Camarilla que parce qu'elle intervient moins dans leur existence que le Sabbat.
						</div>

						<div class="infoClan" id="infoBrujah" hidden><img src="img/illusClan/brujah.jpg">
							<h1>BRUJAH - L'ANARCHIE</h1>
							Selon leur histoire, les Brujahs étaient autrefois les rois-philosophes de la Mésopotamie, de la Perse et de Babylone.<br><br>Dans leur recherche de liberté et d'illumination, ils tuèrent cependant leur fondateur. Pour cela, Caïn les chassa de la Première Cité. Depuis, les Brujahs ont connu un déclin inéluctable. Ils sont considérés comme des enfants gâtés qui n'ont ni fierté, ni sens de l'histoire.<br><br>Bien que membre de la Camarilla, le Clan Brujah est l'agitateur et le trublion de la secte, toujours à la limite des Traditions et se rebellant sans cesse au nom de toutes les causes. De nombreux Brujahs sont des anarchs proscrits, défiant les autorités et ne servant aucun prince.
						</div>

						<div class="infoClan" id="infoTremere" hidden><img src="img/illusClan/tremere.jpg">
							<h1>TREMERE - LA SORCELLERIE</h1>
							Aucun clan n'est entouré d'autant de secret que celui des Tremeres. Inventeurs et adeptes d'une terrible magie du sang, les mystérieux Tremeres se sont donné une structure très rigide, basée sur le pouvoir et une loyauté fanatique pour le clan, concept inconnu de tous les autres vampires.<br><br>Certains vampires pensent que les Tremeres ne sont pas de véritables vampires, mais des magiciens mortels qui se sont condamnés pour l'éternité en tentant de percer les secrets de l'immortalité.<br><br>Une des rumeurs les plus tenaces veut que le fondateur, Tremere lui-même, ait entrepris une horrible mutation et se transformerait en quelque chose d'autre. Le clan Tremere reste silencieux sur le sujet, et considère avec méfiance ceux qui prétendent connaître ses secrets. 
						</div>

						<div class="infoClan" id="infoNosferatu" hidden><img src="img/illusClan/nosferatu.jpg">
							<h1>NOSFERATU - LA PESTE</h1>
							Les membres du Clan Nosferatu souffrent de la malédiction la plus visible. L'Étreinte les déforme de façon hideuse, les métamorphosant en créatures littéralement monstrueuses.<br><br>Les légendes disent que les Nosferatus ont été corrompus en châtiment de la dégénérescence de leur fondateur et du comportement pervers de ses descendants. Mais aujourd'hui, les Nosferatus sont bien connus pour leur pondération et leur calme face à l'adversité.<br><br>Ils ont la réputation d'être des informateurs de premier ordre et les gardiens de nombreux secrets, car leur apparence horrifiante les a forcés à développer leurs capacités de dissimulation de façon extraordinaire.
						</div>

						<div class="infoClan" id="infoRavnos" hidden><img src="img/illusClan/ravnos.jpg">
							<h1>RAVNOS - LE MYSTERE</h1>
							Descendants des gitans et de leurs prédécesseurs d'Inde, les vampires ravnos ont une existence nomade. Comme les gitans historiques, les Ravnos sont poursuivis par une réputation de voleurs et d'escrocs.<br><br>De nombreux princes et chefs du Sabbat les persécutent à cause du chaos qu'ils engendrent. Les Ravnos leur rendent la pareille, considérant la Camarilla et le Sabbat avec un égal mépris. Les Ravnos sont également célèbres pour leur capacité à créer de merveilleuses illusions, la meilleure façon d'éblouir leurs victimes.<br><br>On murmure dans les villes d'Europe et d'Asie que les Mathusalems ravnos se sont éveillés et dirigent à présent le jeu du clan.
						</div>

						<div class="infoClan" id="infoGiovanni" hidden><img src="img/illusClan/giovanni.jpg">
							<h1>GIOVANNI - LA LUXURE</h1>
							Le clan des Giovanni est celui des financiers et des nécromants. Les manipulations de l'âme ont donné à ce clan un pouvoir immense, tandis que les manipulations financières l'ont rendu immensément riche.<br><br>Les autres vampires font difficilement confiance aux mercenaires Giovanni, qui semblent toujours utiliser leur influence dans des buts secrets. Une bonne part de la mauvaise réputation du clan Giovanni provient du fait qu'il s'agit d'un clan insulaire, tirant quasiment tous ses membres de la même famille incestueuse et criminelle. Pire encore pour sa réputation est la rumeur qui veut que ses membres aient usurpé leur appartenance à la Famille : peu après son Etreinte, le chef de clan des Giovanni détruisit son sire et sa lignée, recréant le clan à sa propre image. 
						</div>

						<div class="infoClan" id="infoAssamite" hidden><img src="img/illusClan/assamite.jpg">
							<h1>ASSAMITE - LE CRIME</h1>
							Les Assamites sont des assassins redoutés venant des pays d'Orient. Aucun autre clan n'a acquis une telle réputation en diablerie, au point qu'ils louent leurs services aux autres vampires, agissant comme des tueurs à gage.<br><br>Selon leur enseignement, les Assamites boivent le sang des autres vampires pour purifier leur propre flétrissure. Ils étaient tellement craints que durant la Grande Révolte Anarch, les Tremeres lancèrent sur eux une malédiction, leur interdisant de boire le sang d'autres vampires. Toutefois, les Assamites ont récemment réussi à briser cette malédiction.<br><br>Certains pensent que les Assamites agissent à présent sous l'influence de pouvoirs anciens, se préparant peut-être à jouer leur rôle depuis longtemps écrit dans les derniers mouvements du Jyhad.
						</div>

						<div class="infoClan" id="infoSethite" hidden><img src="img/illusClan/sethite.jpg">
							<h1>DISCIPLE DE SETH - LE MYTHE</h1>
							Originaires d'Egypte, les Séthites adoreraient le dieu-vampire immortel Seth en le servant dans tous leurs actes.<br><br>Les Séthites semblent vouloir corrompre les autres, réduire en esclavage leurs victimes prises dans les anneaux de leurs propres faiblesses, mais nul ne sait dans quels inavouables buts. Les autres vampires exècrent les Disciples de Seth, qui n'ont aucuns alliés. Malgré tout, de nombreux vampires recherchent la compagnie des Séthites, car on raconte qu'ils possèdent des dons et des secrets issus des nuits du passé.<br><br>Inévitablement, le mal et la folie suivent le sillage des Séthites, et de nombreux princes leur refusent l'entrée de leur ville.
						</div>

						<div class="infoClan" id="infoLasombra" hidden><img src="img/illusClan/lasombra.jpg">
							<h1>LASOMBRA - LA FOURBERIE <span style="font-style: italic; font-size: 0.8em">(Sabbat)</span> </h1>
							Les Lasombras sont les maîtres des ténèbres et des ombres, et possèdent une aisance de commandement très semblable à celle des Ventrues.<br><br>De fait, nombre de vampires voient dans les Lasombras et les Ventrues un reflet déformé l'un de l'autre. Autrefois, les Lasombras étaient nobles, mais l'histoire chaotique des vampires et la formation du Sabbat ont forcé nombre d'entre eux à tourner le dos à leurs origines.<br><br>A présent, les Lasombras se donnent entièrement à la damnation du vampirisme. Le Sabbat a affecté ce clan aussi profondément que les Lasombras ont affecté le Sabbat, et sans la direction de ces aristocrates déchus, le Sabbat se désagrégerait. 
						</div>

						<div class="infoClan" id="infoTzimisce" hidden><img src="img/illusClan/tzimisce.jpg">
							<h1>TZIMISCE - LE MALEFICE <span style="font-style: italic; font-size: 0.8em">(Sabbat)</span></h1>
							Autrefois tyrans de l'Europe de l'Est, les Tzimisces ont été chassés de leurs anciens territoires et se sont réfugiés dans les replis du Sabbat.<br><br>Possédant une certaine noblesse, associée à un caractère maléfique dépassant l'imagination, le Clan Tzimisce conduit le Sabbat dans son rejet de tout ce qui est humain. Certains récits apocryphes racontent que les Tzimisces étaient autrefois le clan le plus puissant, mais que l'histoire et les conspirations des autres vampires l'ont conduit à sa déchéance actuelle.<br><br>Bien plus que tous les autres vampires, les Tzimisces arborent leur monstruosité. Ils pratiquent une discipline de "sculpture sur chair" pour défigurer leurs ennemis et se fabriquer des corps d'une beauté terrifiante. 
						</div>

						<input id="clanStock" type="text" name="persoClan" hidden>

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
							</tr>
							<tr>
								<td></td>
								<td><i>(Objectif : 25)</i></td>
								<td></td>
								
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

			</div>

		</section>

	<!--FOOTER-->
		<?php include("shared/view/footer.php"); ?>

	</div>
<script type="text/javascript" src="js/creaperso.js"></script>
</body>
</html> 