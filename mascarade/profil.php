<?php
include("_shared_/start.php");
include("_shared_/functions.php");
/*include("submits/tapage_submit.php");*/
?>

<!DOCTYPE html>
<html>
<head>
	<?php include("_shared_/headconfig.php"); ?>
	<link rel="stylesheet" type="text/css" href="style/profil.css">
	<title>Vampire - Social</title>
</head>
<body>

<?php include('_shared_/header.php') ?>


<!-- -------- CONTENU -------- -->
<section>

	<?php //IF RIEN PRÉCISÉ
	if (empty($_GET)){
		$userID = $_SESSION['id'];
		$req = $bdd->query("
			SELECT *
			FROM mas_persos
			JOIN mas_membres ON mas_membres.id = mas_persos.userID
			WHERE userID = '$userID'");
		$infoPerso = $req->fetchall();
		$infoUser = $infoPerso[0];
		?>

		<h1>PROFIL DE <?=strtoupper($infoUser['pseudo'])?></h1>

		<div class="container centering	infoUser">

			<table>
				<tr>
					<td align="right">Messages postés :</td>
					<td align="left">
						<span class="infoMembre"><?=$infoUser['nombremsg']?></span></td>
				</tr>
				<tr>
					<td align="right">Grade :</td>
					<td align="left"><span class="infoMembre"><?=$infoUser['grade']?></span></td>
				</tr>
			</table>


			<br>
			<h3>Persos :</h3>

			<?php //Affichage des persos
			for ($i=0; $i < count($infoPerso) ; $i++) {  ?>
				<a href="profil.php?persoID=<?=$infoPerso[$i][0]?>" class="persoBox button">
					<?=$infoPerso[$i]['nom']?>
				</a>
			<?php
			} ?>

		</div>
		
	<?php //endif rien précisé

	//IF PERSO PRÉCISÉ
	}if(isset($_GET['persoID']) AND !empty($_GET['persoID'])){
		$persoID = $_GET['persoID'];
		$req = $bdd->query("
			SELECT *
			FROM mas_persos
			LEFT JOIN mas_clanshtml
			ON mas_persos.clan=mas_clanshtml.nom_clan
			LEFT JOIN mas_disciplines
			ON mas_persos.discID=mas_disciplines.id
			WHERE mas_persos.id = '$persoID'");
		$infoPerso = $req->fetchall()[0];

		?>

		<h1>FICHE PERSO - <?=strtoupper($infoPerso['nom'])?></h1>

		<div class="container" id="gridFichePerso">
			
			<img class="ficheBox ficheBox-avatar" style="grid-area: avatar" src="img/avatars/<?php
						//Si GM, avatar générique de GM
						if ($infoPerso['nom']=='GM'){echo'GM';}
						else{echo $infoPerso[0];} ?>.jpg">

			<div class="ficheBox mobile centering" style="grid-area: lvl">
				<i>XP : soon<br>
				suivant : soon</i>
			</div>

			<div class="ficheBox centering" style="grid-area: infos">
				<h3>"<?=strtoupper($infoPerso['nom'])?>"</h3>
					<b><u>Nature</u></b><br><?=$infoPerso['nature']?><br><br>
					<b><u>Attitude</u></b><br><?=$infoPerso['attitude']?><br><br>
					<b><u>Concept</u></b><br><?=$infoPerso['concept']?><br><br>
					<b><u>Physique</u></b><br><?=nl2br($infoPerso['physique'])?>
			</div>

			<div class="ficheBox clanBox" style="grid-area: clan">
				<img class="logoClan" src="img/clans/<?=$infoPerso['clan']?>.png">
				<h3>CLAN <?=strtoupper($infoPerso['clan'])?></h3>
				<?=$infoPerso['description_clan']?>
			</div>

			<div class="ficheBox carac centering" style="grid-area: carac">
				<span class="lvl">LVL <?=$infoPerso['lvl']?></span><br>
				<span class="desktop">
					<i>XP : soon<br>
					suivant : soon</i>
				</span>
				<br><br>
				<table>
					<tr>
						<td><span class="caracDigit"><?=$infoPerso['forc']?></span></td>
						<td>Force</td>
					</tr>
					<tr>
						<td><span class="caracDigit"><?=$infoPerso['dexterite']?></span></td>
						<td>Dextérité</td>
					</tr>
					<tr>
						<td><span class="caracDigit"><?=$infoPerso['intelligence']?></span></td>
						<td>Intelligence</td>
					</tr>
					<tr>
						<td><span class="caracDigit"><?=$infoPerso['charisme']?></span></td>
						<td>Charisme</td>
					</tr>
					<tr>
						<td><span class="caracDigit"><?=$infoPerso['perception']?></span></td>
						<td>Perception</td>
					</tr>
				</table>
			</div>

			<div class="ficheBox" style="grid-area: disciplines">
				<h3>DISCIPLINES</h3>
				<!-- Hidden windows des disciplines -->
				<div class="discWindow discWindow-1 disc1">
					<img class="croix" src="img/mobile/croix.png">
					<h3><?=strtoupper($infoPerso['nom_discipline'])?> - lvl 1</h3>
					<?=$infoPerso['description_discipline']?>
					<div class="discWindow-box button">
						level up : <i>soon !</i> 
					</div>
				</div>
				<!-- end -->
				<div class="discContainer">
					<div class="discBox button" id="disc1">
						<b><?=strtoupper($infoPerso['nom_discipline'])?></b><br>
						<span>lvl 1</span>
					</div>
					<div class="discBox discBox-empty">
						<i>soon</i>
					</div>
					<div class="discBox discBox-empty">
						<i>soon</i>
					</div>
					<div class="discBox discBox-empty">
						<i>soon</i>
					</div>
				</div>
			</div>

			<div class="ficheBox" style="grid-area: lore">
				<h3>HISTOIRE</h3>
				<i><?=nl2br($infoPerso['lore'])?></i> 
			</div>

		</div>

	<?php //endif perso précisé
	} ?>

</section>

<?php include("_shared_/scripts.php"); ?>
<script type="text/javascript" src="js/profil.js"></script>

</body>
</html>