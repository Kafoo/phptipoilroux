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
				<div id="ariane">CREATION DE PERSONNAGE</div>

				<form method="POST" action="">

					<div class="titre">QUI ES-TU ?</div>

					<table id="formBases">
						<tr>
							<td><label for="persoNom" style="font-weight: bold">Nom :</label></td>
							<td><input type="text" name="persoNom" placeholder="Nom du perso"></td>
							<td></td>
						</tr>
						<tr>
							<td><label for="persoNature">Nature :</label></td>
							<td><input type="text" name="persoNature" placeholder="1 adjectif"></td>
							<td>
								<img src="img/help.png" onmouseover="showHelp('Nature')" onmouseout="hideHelp('Nature')">
								<div class="helpDiv" id="helpNature" hidden>La nature d'un personnage est sa véritable personnalité, ce qu'il est fondamentalement. <br/><i>Exemples : joueur, démoniaque, passionné, intéressé, altruiste, pervers...</i></div>
							</td>
						</tr>
						<tr>
							<td><label for="persoAttitude">Attitude :</label></td>
							<td><input type="text" name="persoAttitude" placeholder="1 adjectif"></td>
							<td>
								<img src="img/help.png" onmouseover="showHelp('Attitude')" onmouseout="hideHelp('Attitude')">
								<div class="helpDiv" id="helpAttitude" hidden>L'attitude d'un personnage est ce qu'il montre de sa personnalité. Plus elle est contraire à sa nature, plus le personnage cache son jeu.<br/><i>Exemples : joueur, démoniaque, passionné, intéressé, altruiste, pervers...</i></div>
							</td>
						</tr>
						<tr>
							<td><label for="persoConcept">Concept :</label></td>
							<td><input type="text" name="persoConcept" placeholder="1 concept"></td>
							<td>
								<img src="img/help.png" onmouseover="showHelp('Concept')" onmouseout="hideHelp('Concept')">
								<div class="helpDiv" id="helpConcept" hidden>Le concept d'un personnage est ce qui prépondère le plus dans sa vie d'humain (avant l'Etreinte) : son métier, sa passion, ou encore sa position sociale.<br/><i>Exemples : drogue addict, charpentier, boxer, hermite...</i></div>
							</td>
						</tr>
					</table>
					


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
							style="background-image: url('img/logoClans/ventrue.png');cursor: pointer;"
							onmouseover="show('clan','logoVentrue','infoVentrue')"
							onmouseout="hide('clan','logoVentrue','infoVentrue')"
							onclick= "choose('clan','Ventrue')">
							</div>
							<div 
							class="logoClan"
							id="logoMalkavian" 
							style="background-image: url('img/logoClans/malkavian.png');cursor: pointer;"
							onmouseover="show('clan','logoMalkavian','infoMalkavian')"
							onmouseout="hide('clan','logoMalkavian','infoMalkavian')"
							onclick= "choose('clan','Malkavian')">
							</div>
							<div 
							class="logoClan" 
							id="logoToreador" 
							style="background-image: url('img/logoClans/toreador.png');cursor: pointer;"
							onmouseover="show('clan','logoToreador','infoToreador')"
							onmouseout="hide('clan','logoToreador','infoToreador')"
							onclick= "choose('clan','Toreador')">
							</div>
							<div 
							class="logoClan"
							id="logoGangrel" 
							style="background-image: url('img/logoClans/gangrel.png');cursor: pointer;"
							onmouseover="show('clan','logoGangrel','infoGangrel')"
							onmouseout="hide('clan','logoGangrel','infoGangrel')"
							onclick= "choose('clan','Gangrel')">
							</div>
							<div 
							class="logoClan" 
							id="logoBrujah" 
							style="background-image: url('https://laconfreriedesdeuxtours.files.wordpress.com/2016/06/logoclanbrujah.png?w=193&h=197');cursor: pointer;"
							onmouseover="show('clan','logoBrujah','infoBrujah')" 
							onmouseout="hide('clan','logoBrujah','infoBrujah')"
							onclick= "choose('clan','Brujah')">
							</div>
							<div 
							class="logoClan" 
							id="logoTremere" 
							style="background-image: url('https://laconfreriedesdeuxtours.files.wordpress.com/2016/06/logoclantremere.png?w=176&h=175');cursor: pointer;"
							onmouseover="show('clan','logoTremere','infoTremere')" 
							onmouseout="hide('clan','logoTremere','infoTremere')"
							onclick= "choose('clan','Tremere')">
							</div>
							<div 
							class="logoClan" 
							id="logoNosferatu" 
							style="background-image: url('https://laconfreriedesdeuxtours.files.wordpress.com/2016/06/logoclannosferatu.png?w=151&h=184');cursor: pointer;"
							onmouseover="show('clan','logoNosferatu','infoNosferatu')" 
							onmouseout="hide('clan','logoNosferatu','infoNosferatu')"
							onclick= "choose('clan','Nosferatu')">
							</div>
							<div 
							class="logoClan" 
							id="logoRavnos" 
							style="background-image: url('https://laconfreriedesdeuxtours.files.wordpress.com/2016/06/logoclanravnos.png?w=135&h=149');cursor: pointer;"
							onmouseover="show('clan','logoRavnos','infoRavnos')" 
							onmouseout="hide('clan','logoRavnos','infoRavnos')"
							onclick= "choose('clan','Ravnos')">
							</div>
							<div 
							class="logoClan" 
							id="logoGiovanni" 
							style="background-image: url('https://laconfreriedesdeuxtours.files.wordpress.com/2016/06/logoclangiovanni.png?w=146&h=143');cursor: pointer;"
							onmouseover="show('clan','logoGiovanni','infoGiovanni')" 
							onmouseout="hide('clan','logoGiovanni','infoGiovanni')"
							onclick= "choose('clan','Giovanni')">
							</div>
							<div 
							class="logoClan" 
							id="logoAssamite" 
							style="background-image: url('https://laconfreriedesdeuxtours.files.wordpress.com/2016/06/logoclanassamite.png?w=195&h=95');cursor: pointer;"
							onmouseover="show('clan','logoAssamite','infoAssamite')" 
							onmouseout="hide('clan','logoAssamite','infoAssamite')"
							onclick= "choose('clan','Assamite')">
							</div>
							<div 
							class="logoClan" 
							id="logoSethite" 
							style="background-image: url('https://laconfreriedesdeuxtours.files.wordpress.com/2016/06/logoclanfollowersofset.png?w=139&h=147');cursor: pointer;"
							onmouseover="show('clan','logoSethite','infoSethite')" 
							onmouseout="hide('clan','logoSethite','infoSethite')"
							onclick= "choose('clan','Sethite')">
							</div>
							<div 
							class="logoClan" 
							id="logoLasombra" 
							style="background-image: url('https://laconfreriedesdeuxtours.files.wordpress.com/2016/06/logoclanlasombra.png?w=146&h=130');cursor: pointer;"
							onmouseover="show('clan','logoLasombra','infoLasombra')" 
							onmouseout="hide('clan','logoLasombra','infoLasombra')"
							onclick= "choose('clan','Lasombra')">
							</div>
							<div 
							class="logoClan" 
							id="logoTzimisce" 
							style="background-image: url('https://laconfreriedesdeuxtours.files.wordpress.com/2016/06/logoclantzimisce.png?w=118&h=125');cursor: pointer;"
							onmouseover="show('clan','logoTzimisce','infoTzimisce')" 
							onmouseout="hide('clan','logoTzimisce','infoTzimisce')"
							onclick= "choose('clan','Tzimisce')">
							</div>
						</div>

						<div class="infoClan" id="infoGen" clanShown="true">
							<img src="https://img.etsystatic.com/il/678f26/1388933820/il_570xN.1388933820_646q.jpg?version=1">
							<h1>LES CLANS</h1>
							Selon le mythe des Antédiluviens, Caïn a engendré un certain nombre de descendants, qui ont engendré à leur tour. <br><br>Ces infants, la Troisième Génération, étaient les créateurs des clans modernes, et tous les vampires qui en descendent partagent des traits et des caractéristiques communes. Ceci est certainement vrai à un degré ou à un autre, puisque chaque clan dispose d'un certain nombre de pouvoirs que ses membres apprennent plus facilement que les autres, et chaque clan a également des faiblesses et des traits de caractères qui permettent d'en identifier les membres. <br><br>Le respect dû à un vampire provient autant de son clan que de sa génération, et même le vampire le plus mal embouché recevra un minimum de marques de respect si son héritage l'impose. Il existe 13 clans connus, chacun censé descendre d'un Antédiluvien. Il est largement accepté que parmi les 13 "grands" clans, sept appartiennent à la Camarilla, deux au Sabbat et les quatre derniers restent en dehors des sectes.<br><br><b>Clique sur l'icone d'un clan pour le choisir !</b>
						</div>

						<div class="infoClan" id="infoVentrue" hidden>
							<img src="https://laconfreriedesdeuxtours.files.wordpress.com/2016/06/5937288904_b9c1a24e0f_b.jpg?w=308&h=469">
							<h1>VENTRUE - L'ELITE</h1>
							Les Ventrues ont toujours été considérés (et se sont toujours considérés) comme l’élite de la race vampirique.<br><br>Ils ont tendance à être respectables et distingués. Depuis toujours, les Ventrues sont le clan des dirigeants, des meneurs, cherchant à modeler la destinée des vampires. Jadis choisis parmi les nobles, princes ou détenteurs du pouvoir, ils sont aujourd’hui recrutés parmi les ‘vieilles’ familles riches, les cadres ou encore les politiciens.<br><br>Les Ventrues aiment le pouvoir et sont souvent à la tête des cités du monde. La combinaison de l’influence de leur clan dans la politique mondiale, de son poids politique au sein de la Camarilla, de leurs ambitions personnelles et de leurs formidables pouvoirs mentaux, en font tout naturellement des dirigeants.<br><br>Les Ventrues sont des dirigeants nés ou des humains hautement spécialisés dans des domaines permettant l’accès au pouvoir. L’ambition est le maître mot du clan, le pouvoir politique la voie de son accomplissement. L’argent et l’armée ne sont que des accessoires, mais ils sont considérés à leur juste valeur.
						</div>

						<div class="infoClan" id="infoMalkavian" hidden><img src="https://laconfreriedesdeuxtours.files.wordpress.com/2016/06/5936731353_bb131dd0fe_z.jpg?w=312&h=476"> 
							<h1>MALKAVIAN - LA FOLIE</h1>
							Tous les autres clans craignent les Malkavian à cause de leur folie, qui peut prendre n’importe quelle forme, de la rage aveugle à la catatonie. Mais la plupart du temps, il est difficile de distinguer un Malkavian d’un être ‘sain d’esprit’. Ceux dont la folie est apparente sont certainement les plus dangereux. Ils ne sont que les esclaves de leurs propres lubies.<br><br>Le clan Malkavian semble former le lignage le plus incohérent des vampires. On y trouve un nombre égal d’âmes gentiment naïves et de psychopathes.<br><br>Les Malkavian préfèrent rester aux limites des groupes mortels, absorbant, tournant et exagérant les idées et les théories des mortels, ou les transplantant d’une culture à l’autre. Ils sont parfois crédités des pratiques les plus folles des mortels ; parfois, ils revendiquent la responsabilité des choses les plus incongrues.
						</div>

						<div class="infoClan" id="infoToreador" hidden><img src="https://laconfreriedesdeuxtours.files.wordpress.com/2016/06/13eb76986f60e1d96c7405fef7daa251.jpg">
							<h1>TOREADOR - L'ART</h1>
							Les Toreadors représentent le clan de la haute société. Ils sont élégants, brillants, et quoi qu’ils fassent, c’est toujours avec passion. Ils savourent leur vie éternelle et sont les plus prodigues des vampires, aimant l’excès et la décadence, tout en affirmant être les protecteurs de l’art.<br><br>Ils se considèrent comme les conservateurs et les gardiens de l’exquis, les porteurs de la flamme de l’inspiration. De tous les clans, les Toreadors sont ceux qui apprécient le plus les réalisations de la race humaine.<br><br>En général, les Toreadors sont des artistes (musiciens, peintres, poètes, etc), et ils passent souvent des siècles dans la frustration d’accomplir une nouvelle oeuvre. En fait, d’un côté il y a les artistes de talent, et de l’autre ceux qui se donnent des allures de grands esthètes, mais qui sont incapables de créer quoi que ce soit, les poseurs. Ils considèrent qu’ils se doivent de cultiver ce qui est le mieux pour l’humanité. Ils leur<!--  arrivent donc d’Etreindre un être doué dans son art pour conserver son talent pour l’éternité.<br><br>Ils sont constamment à la recherche de nouveaux talents et passent énormément de temps à décider qui protéger et qui abandonner à son destin. -->
						</div>

						<div class="infoClan" id="infoGangrel" hidden><img src="https://laconfreriedesdeuxtours.files.wordpress.com/2016/06/4a70bac86e1ea503f2cf31ef4cad17f3.jpg?w=300&h=458">
							<h1>GANGREL - L'ANIMAL</h1>
							Les Gangrels sont des nomades solitaires qui préfèrent les étendues sauvages à la société. Restant rarement en place, ils ne trouvent du plaisir qu’en voyageant seuls sous la lune. C’est d’ailleurs le clan qui a le plus d’affinités avec les Loup-Garous. Mais la présence de Garous féroces et hostiles les obligent souvent à s’orienter vers les villes. Ce sont de féroces guerriers guidés par leur instinct bestial et qui aiment généralement peu la présence des autres vampires. Selon la légende, le fondateur était un barbare, et c’est pour cette raison que les Gangrels donnent parfois l’Etreinte à des étrangers.<br><br>Les Gangrels sont calmes, taciturnes et impénétrables, un peu comme les animaux sauvages. Ils sont très liés aux gitans qui descendraient de leur antédiluvien, et quiconque s’en prend à l’un d’eux, a de grandes chances de provoquer la colère de l’un des anciens du clan. Les Ravnos ayant aussi beaucoup d’affinité avec les gitans, ont des différents avec les Gangrels depuis la nuit des temps.
						</div>

						<div class="infoClan" id="infoBrujah" hidden><img src="https://laconfreriedesdeuxtours.files.wordpress.com/2016/06/2.jpg?w=309&h=471">
							<h1>BRUJAH - L'ANARCHIE</h1>
							Les Brujahs étaient autrefois les rois philosophes de la Mésopotamie, de la Perse et de Babylone. Ils contrôlaient un empire s’étendant du berceau de la civilisation au nord de l’Afrique, et accumulèrent des connaissances du monde entier. Cependant, il est dit que dans leur recherche de liberté et d’illumination, ils tuèrent leur fondateur. Pour cela, Caïn les chassa de la Première Cité. Depuis ils ont connu un déclin inéluctable.<br><br>Désormais, le Clan Brujah est une preuve même de l’existence du chaos. Le clan ne semble avoir aucune cohésion si ce n’est le désir commun de tous ses membres de détruire et de changer les choses. Un Brujah peut défendre avec une véritable fureur ses passions éliminant tout ce qui se dresse face à lui. Le clan n’est donc qu’un amas chaotique et brutal, et c’est ce qu’on attend d’eux alors ils ne changeront pas. Aussi désordonnés soient-ils, face à un ennemi commun, ils se lèveront en masse jusqu’à sa destruction puis chacun repartira dans sa direction. Tels sont les Brujahs : passionnés, impulsifs.
						</div>

						<div class="infoClan" id="infoTremere" hidden><img src="https://laconfreriedesdeuxtours.files.wordpress.com/2016/06/bradstreet-new-image-tremere-20th-anniv-ed.jpg?w=322&h=491">
							<h1>TREMERE - LA MAGIE</h1>
							Les Tremeres sont les magiciens des vampires et aucun clan n’est entouré d’autant de secrets qu’eux. Avec leurs propres artifices, ils ont développé leur propre magie vampirique liée au sang. Les Tremeres possèdent également une hiérarchie hyper structurée, et ne supportent aucun écart. C’est ce qui leur a permis de survivre au cours de ces derniers siècles et qui fait leur force désormais.<br><br> Le clan est aussi l’un des plus récents, si l’on se place par rapport à une chronologie vampirique (les clans datent normalement des Premières Cités, alors que les Tremeres ont vu le jour au cours du début du 2e millénaire). Ils auraient été jadis magiciens, et ils auraient réalisé un grand rituel sur un Antédiluvien endormi.<br><br>Il y a moins de 1000 ans, au coeur des montagnes roumaines, en Transylvanie, un groupe de magiciens appartenant à un Ordre ancien subit l’Etreinte d’un<!--  Ancien insensé. Combinant leurs nouveaux pouvoirs avec leur ancien savoir, les magiciens prirent rapidement le contrôle du Clan. Ils étreignirent d’autres membres de l’Ordre, et burent le Sang de tous les Anciens du Clan. Il est même supposé que les plus puissants d’entre eux (Tremere lui même) réussirent à pourchasser et tuer le Fondateur du Clan. -->
						</div>

						<div class="infoClan" id="infoNosferatu" hidden><img src="https://laconfreriedesdeuxtours.files.wordpress.com/2016/06/russell-nosferatu.jpg?w=312&h=475">
							<h1>NOSFERATU - LA PESTE</h1>
							Les Nosferatu souffrent de la malédiction la plus visible : ils ont été déformés par leur malédiction du sang. Après l’Etreinte, le jeune vampire subit des déformations pour finalement, au bout d’une semaine, finir en un monstre hideux. La psychologie du jeune en prend souvent un coup, de plus, il devient incapable de marcher parmi les autres avec sa nouvelle apparence. Il rejoint alors ses frères qui sont généralement dans les égouts ou les catacombes.<br><br>La plupart des Nosferatu sont plus équilibrés et pondérés que leurs frères, mais certains d’entre eux se complaisent dans l’horreur qu’inspire leur apparence aux autres.<br><br>Les Nosferatu sont une unité, tous se respectent dans le clan, et entre eux ils partagent librement les infos. Mieux vaut ne pas fâcher l’un d’eux, car ce serait se fâcher avec tous… Le clan assure aujourd’hui prendre ses distances avec son fondateur, et ne plus le servir. Certains vampires affirment que le clan est en très mauvais termes avec son créateur, et qu’il le recherche activement pour le détruire.
						</div>

						<div class="infoClan" id="infoRavnos" hidden><img src="https://laconfreriedesdeuxtours.files.wordpress.com/2016/06/ravnos1.jpg?w=316&h=481">
							<h1>RAVNOS - LE MYSTERE</h1>
							Les Ravnos sont célèbres pour leur sens de l’humour noir très particulier. Ils sont des mystificateurs de premier ordre, tissant illusions et mensonges par leur fantaisie. Les Ravnos respectent scrupuleusement les marchés qu’ils passent, autant avec les mortels qu’avec les vampires, dignes des pactes avec le diable. Ils s’abattent donc sans pitié sur ceux qui sont incapables d’en payer les termes cachés.<br><br>Les Ravnos se considèrent eux-mêmes comme des tricheurs légendaires. Ils s’appuient sur une tradition de tromperie héritée des rakshasas et ghuls du Moyen et de l’Extrême Orient.<br><br>Les Ravnos ont une âme nomade et ne s’installent jamais très longtemps quelque part. Même ceux qui décident de s’installer dans une ville, changent de refuge quand l’humeur les prend. Cette habitude enrage les princes du monde entier, qui y voient du mépris pour la Tradition de l’Hospitalité. Mais rares sont ceux qui les punissent pour ça car ils craignent trop de s’attirer les foudres du clan entier.
						</div>

						<div class="infoClan" id="infoGiovanni" hidden><img src="https://laconfreriedesdeuxtours.files.wordpress.com/2016/06/990a35effd4c75f42445ee784950dbb6.jpg?w=324&h=494">
							<h1>GIOVANNI - LA LUXURE</h1>
							Les Gangrels sont des nomades solitaires qui préfèrent les étendues sauvages à la société. Restant rarement en place, ils ne trouvent du plaisir qu’en voyageant seuls sous la lune. C’est d’ailleurs le clan qui a le plus d’affinités avec les Loup-Garous. Mais la présence de Garous féroces et hostiles les obligent souvent à s’orienter vers les villes. Ce sont de féroces guerriers guidés par leur instinct bestial et qui aiment généralement peu la présence des autres vampires. Selon la légende, le fondateur était un barbare, et c’est pour cette raison que les Gangrels donnent parfois l’Etreinte à des étrangers.<br><br>Les Gangrels sont calmes, taciturnes et impénétrables, un peu comme les animaux sauvages. Ils sont très liés aux gitans qui descendraient de leur antédiluvien, et quiconque s’en prend à l’un d’eux, a de grandes chances de provoquer la colère de l’un des anciens du clan. Les Ravnos ayant aussi beaucoup d’affinité avec les gitans, ont des différents avec les Gangrels depuis la nuit des temps.
						</div>

						<div class="infoClan" id="infoAssamite" hidden><img src="https://laconfreriedesdeuxtours.files.wordpress.com/2016/06/38c7e4bf3a1592c5b0102eedf2110ec4.jpg?w=303&h=421">
							<h1>ASSAMITE - LE CRIME</h1>
							Les Assamites sont arrivés des étendues désertiques de l’Orient. Ils sont connus des vampires comme étant des assassins, travaillant pour ceux qui y mettent le prix. Le prix qu’ils demandent est de la vitae d’autres vampires. Pour eux la diablerie est le plus grand des sacrements et aucun autre clan n’a acquis une telle réputation en ce qui concerne ce sujet. Selon leur enseignement, les Assamites boivent le sang des autres vampires pour purifier leur propre flétrissure. Ils nomment Caïn : « Khayyin» ou encore «l’Unique».<br><br>Les Assamites travaillent indifféremment pour la Camarilla ou le Sabbat, en essayant de ne pas avantager l’une ou l’autre secte, pour arriver à leur but. Ils circulent donc librement à travers le monde.<br><br>Ils considèrent les autres comme inférieurs, et se lient rarement avec <!-- eux pour des alliances. Ils pensent que leur fondateur était de la Seconde Génération et que donc les autres vampires ne sont que des pâles copies d’eux mêmes.<br><br>Avant et pendant la Grande Révolte Anarch, les Assamites pratiquaient de façon intensive la diablerie, cherchant à se rapprocher toujours d’avantage de «l’Unique», leur fondateur. -->
						</div>

						<div class="infoClan" id="infoSethite" hidden><img src="https://laconfreriedesdeuxtours.files.wordpress.com/2016/06/a07acb949290d3fc2f55076ff383dd67.jpg?w=299&h=423">
							<h1>SETHITE - LE MYTHE</h1>
							Les Sethites sont considérés avec plus de méfiance que tous les autres clans. Leurs liens avec le Serpent mythologique sont bien connus, et soutenus par d’étranges pouvoirs. Si un Sethite pénètre dans une ville, le pouvoir Caïnite en place s’effrite inévitablement.<br><br>Selon la plupart des Sethites, le fondateur même du clan n’était nul autre que le dieu sombre de l’ancienne Egypte, le chasseur hors pair des nuits du désert. D’autres légendes racontent que Seth était un Antédiluvien qui s’est proclamé dieu des Egyptiens. Son pouvoir n’était mis en cause par personne, jusqu’à ce qu’il soit défié par un être appelé Osiris (sûrement un vampire). Leur guerre dura des siècles, mais finalement, Seth fut jeté hors d’Egypte, dans les ténèbres. C’est depuis ces ténèbres que Seth commença son règne sur l’Orient. Ses infants oeuvrent pour s’assurer que le monde sera prêt pour son retour (et pour faire progresser leurs propres plans). L’objectif ultime du c<!-- lan est de corrompre les codes d’éthique de l’humanité et des Caïnites, créant ainsi un excès d’esclaves pour eux mêmes et pour leur sinistre maître.<br><br>Selon les Sethites, la dépendance, la séduction et la décadence sont les outils les plus anciens et les plus efficaces. Ils utilisent la drogue, le sexe, l’argent, le pouvoir et même la vitae et les connaissances surnaturelles pour réduire les autres à leur merci. -->
						</div>

						<div class="infoClan" id="infoLasombra" hidden><img src="https://laconfreriedesdeuxtours.files.wordpress.com/2016/06/30c93b98a55c422d8111956c20b1e09e.jpg">
							<h1>LASOMBRA - LA FOURBERIE</h1>
							Les Lasombras sont les meneurs du Sabbat, les membres les plus loyaux de la secte et les plus agressifs. Ils font tout pour offrir les meilleurs dirigeants à la secte, en créant des conflits et des intrigues internes au clan. Ainsi une sélection des meilleurs éléments est effectuée et seuls les plus puissants dirigent la secte, mais en aucun cas ils ne favorisent un membre d’un autre clan. Ils sont machiavéliques, rusés et fourbes. De tous les membres du Sabbat ce sont eux qui ont le plus de serviteurs et d’influence sur les mortels. Pour eux ce qui est bon pour le clan est bon pour la secte.<br><br>Les Lasombras se prétendent les instruments de la propagation de la foi chrétienne. Le clan depuis son adhésion au Sabbat s’est détaché de l’Eglise, sauf exception, mais n’oublie pas pour autant son passé. La grande majorité des Auctoritas et Ignobilis Ritae sont issus du clan Lasombra et des anciennes doctrines c<!-- hrétiennes tournées en ridicule. De manière étonnante certains anciens du clan maintiennent encore leurs liens étroits avec l’Eglise.<br><br>Note : les Lasombras apprennent aux jeunes à ne pas nommer les antédiluviens, et à ne pas leur donner de genre : il faut les considérer comme des créatures, dont le nom s’est perdu au travers des âges. -->
						</div>

						<div class="infoClan" id="infoTzimisce" hidden><img src="https://laconfreriedesdeuxtours.files.wordpress.com/2016/06/tzimisce.jpg?w=311&h=473">
							<h1>TZIMISCE - LE DEMONISME</h1>
							Si les Lasombras sont le coeur du Sabbat, les Tzimisces sont son âme. En général les autres sont mal à l’aise en leur présence. Ce qui est le plus craint, c’est leur discipline de Vicissitude.<br><br>Dans un premier temps, les Tzimisces sont des personnes réservées et perspicaces, loin des meutes hurlantes du Sabbat. Ils paraissent rationnels, supérieurement intelligents, possédant un esprit scientifique et pénétrant.<br><br>Ensuite, on réalise ce que sont réellement les Tzimisces : depuis des millénaires, les Démons explorent et affinent leur compréhension de la nature vampirique, transformant leur corps et leur esprit vers des formes nouvelles et étrangères. Les victimes subissent aussi souvent ce genre de ‘changements’.<br><br>En vieillissant, les anciens finissent par ne plus comprendre ce qu’est la pitié ou la souffrance, ou ne leur donne plus autant d’importance.
						</div>


					</div>



					<div class="titre">T'AS QUOI DANS LE VENTRE ?</div>

					<h3><u>Caractéristiques</u></h2>

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
								<label for="persoDexterité">Dexterité :</label>
							</td>
							<td>
								<input id="valDexterité" type="range" min="1" max="10" value="1" name="persoDexterité" oninput="change('Dexterité')">
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
						<tr>
							<td></td>
							<td style="text-align: center; font-weight: bold;"> Total :</td>
							<td id="totalCarac">5</td>
						</tr>
					</table>
					<br><br>
					<h3><u>Discipline de base</u></h2>

					<div
					class="logoDisc" 
					id="logoDiscGen" 
					style="cursor: pointer;width: 20px"
					onmouseover="show('disc','logoDiscGen','infoDiscGen')"
					onmouseout="hide('disc','logoDiscGen','infoDiscGen')"
					currentdiscLogo="true"
					>?</div>

					<div
					class="logoDisc" 
					id="logoDisc1" 
					style="cursor: pointer;"
					onmouseover="show('disc','logoDisc1','infoDisc1')"
					onmouseout="hide('disc','logoDisc1','infoDisc1')"
					onclick= "choose('disc','Disc1')">
						Discipline 1</div>
					<div
					class="logoDisc" 
					id="logoDisc2" 
					style="cursor: pointer;"
					onmouseover="show('disc','logoDisc2','infoDisc2')"
					onmouseout="hide('disc','logoDisc2','infoDisc2')"
					onclick= "choose('disc','Disc2')">
						Discipline 2</div>
					<div
					class="logoDisc" 
					id="logoDisc3" 
					style="cursor: pointer;"
					onmouseover="show('disc','logoDisc3','infoDisc3')"
					onmouseout="hide('disc','logoDisc3','infoDisc3')"
					onclick= "choose('disc','Disc3')">
						Discipline 3</div>
					<div
					class="logoDisc" 
					id="logoDisc4" 
					style="cursor: pointer;"
					onmouseover="show('disc','logoDisc4','infoDisc4')"
					onmouseout="hide('disc','logoDisc4','infoDisc4')"
					onclick= "choose('disc','Disc4')">
						Discipline 4</div>



					<div class="infoDisc" id="infoDiscGen" discShown="true">[Explication des disciplines, plus tard tu en auras en fonction de ton clan et expérience, blabla]</div>

					<div class="infoDisc" id="infoDisc1" hidden>ure dolor in repreheniatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>

					<div class="infoDisc" id="infoDisc2" hidden>int occaecat cuquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>

					<div class="infoDisc" id="infoDisc3" hidden>quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariuis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>

					<div class="infoDisc" id="infoDisc4" hidden>citation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure do ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>

					<div class="infoDisc" id="infoDisc1" hidden>Discipline 1</div>


					<div class="titre">QUEL EST TON HISTOIRE ?</div>
					

					<div id="descriptionLore">
						C'est ici que tu vas décrire librement ton personnage, ce qu'il a vécu, ce qui fait qu'il est ce qu'il est aujourd'hui.<br><br>Quel âge a-t-il ? A-t-il un travail, de la famille, des amis ? Quel a été son premier contact avec le monde des vampires ? Qui est son Sire, son Etreinte a-t-elle été agréable ? Où est-il réfugié depuis, et que pense-t-il de tout ça ?<br><br>Libre à toi d'écrire 3 lignes, ou un bouquin ;-)
						<textarea id="lore" placeholder="Allez, raconte-nous tout."></textarea>
					</div>

					<br>

					<input id="submitAll" type="submit" name="submit" value="C'est parti !">
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