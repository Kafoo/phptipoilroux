<?php
include("_shared_/start.php");
/*include("submits/tapage_submit.php");*/
?>

<!DOCTYPE html>
<html>
<head>
	<?php include("_shared_/headconfig.php"); ?>
	<link rel="stylesheet" type="text/css" href="style/profil.css">
	<title>Shukidy - Profil</title>
</head>
<body>

<?php include('_shared_/header.php') ?>


<!-- -------- CONTENU -------- -->
<section>

	<?php //IF USER IS DISCONNECTED
	if (!isset($_SESSION['connected'])) { ?>

		<h1>PROFIL</h1>

		<div class="paco">
			Il faut te connecter pour accéder à cette page !
		</div>


	<?php //endif disconnected user


	}else{ //IF CONNECTED USER ?>





		<?php //IF RIEN PRÉCISÉ
		if (empty($_GET)){
			$userID = $_SESSION['id'];
			$req = $bdd->query("
				SELECT *
				FROM mas_persos
				JOIN mas_users ON mas_users.id = mas_persos.userID
				WHERE userID = '$userID'");
			$persoInfos = $req->fetchall();
			$infoUser = $persoInfos[0];
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
				for ($i=0; $i < count($persoInfos) ; $i++) {  ?>
					<a href="profil.php?persoID=<?=$persoInfos[$i][0]?>" class="persoBox button">
						<?=$persoInfos[$i]['nom']?>
					</a>
				<?php
				} ?>

			</div>
			
		<?php //endif rien précisé

		//IF PERSO PRÉCISÉ
		}if(isset($_GET['persoID']) AND !empty($_GET['persoID'])){

			$persoID = $_GET['persoID'];
			$req = $bdd->query("
				SELECT 
				perso.id, perso.nom, perso.lvl, perso.xp, perso.nature, perso.attitude, perso.concept, perso.defaut, perso.physique, perso.c1, perso.c2, perso.c3, perso.c4, perso.c5, perso.lore,
				classe.name as classeName, classe.description as classeDescription,
				race.name as raceName, race.description as raceDescription
				FROM mas_persos as perso
				JOIN natures as classe
				ON classe.id = perso.classeID
				JOIN natures as race
				ON race.id = perso.raceID
				WHERE perso.id = '$persoID'");
			$persoInfos = $req->fetch();

			$req = $bdd->query("
				SELECT 
				p.lvl, p.name, p.description, p.active
				FROM powers as p
				JOIN rel_persos2powers as p2p
				ON p.id = p2p.powerID
				WHERE p2p.persoID = '$persoID'
				");

			$persoPowers = $req->fetchall();

			?>

			<h2><?=strtoupper($persoInfos['nom'])?></h2>

			<div class="container" id="gridFichePerso">
				
				<img class="ficheBox ficheBox-avatar" style="grid-area: avatar" src="img/avatars/<?php
							//Si GM, avatar générique de GM
							if ($persoInfos['nom']=='GM'){echo'GM';}
							else{echo $persoInfos['id'];} ?>.jpg">


				<div class="ficheBox ficheBox-lvl mobile centering" style="grid-area: lvl">
					<i>XP : soon<br>
					suivant : soon</i>
				</div>

				<div class="ficheBox centering" style="grid-area: infos">
						<h4>Nature</h4><b><?=$persoInfos['nature']?></b><br><br>
						<h4>Attitude</h4><b><?=$persoInfos['attitude']?></b><br><br>
						<h4>Concept</h4><b><?=$persoInfos['concept']?></b><br><br>
						<h4>Physique</h4>
						<?php
						if (in_array($persoID, $_SESSION['persosArray'])) { ?>
							<div class="editButton" id="editButtonPhysique">éditer</div>
						<?php 
						} ?>
						<br>
						<span id="persoPhysique"><?=nl2br($persoInfos['physique'])?></span>
						<div id="editPhysiqueBlock" hidden>
							<form method="POST" action="SERVER_UPDATES.php?action=updatePersoPhysique&persoID=<?=$_GET['persoID']?>">
								<textarea id="editPhysiqueArea" name="contentEditPhysique"></textarea>
								<input type="submit" name="submitEditPhysique" value="J'édite mon physique !">
							</form>
						</div>
				</div>

				<div class="ficheBox clanBox" style="grid-area: clan">
					<img class="logoClan" src="">
					<h3>CLAN : </h3>
					<!-- Description du clan ici -->
				</div>

				<div class="ficheBox carac centering" style="grid-area: carac">
					<h4>LVL <?=$persoInfos['lvl']?></h4>
					<span class="desktop">
						<i>XP : soon<br>
						suivant : soon</i><br>
					</span>
					<br>
					<table>
						<tr>
							<td><span class="infoPersoCarac carac1" carac="carac1"><?=$persoInfos['c1']?></span></td>
							<td>Force</td>
						</tr>
						<tr>
							<td><span class="infoPersoCarac carac2" carac="carac2"><?=$persoInfos['c2']?></span></td>
							<td>Dextérité</td>
						</tr>
						<tr>
							<td><span class="infoPersoCarac carac3" carac="carac3"><?=$persoInfos['c3']?></span></td>
							<td>Intelligence</td>
						</tr>
						<tr>
							<td><span class="infoPersoCarac carac4" carac="carac4"><?=$persoInfos['c4']?></span></td>
							<td>Charisme</td>
						</tr>
						<tr>
							<td><span class="infoPersoCarac carac5" carac="carac5"><?=$persoInfos['c5']?></span></td>
							<td>Perception</td>
						</tr>
					</table>
				</div>

				<div class="ficheBox" style="grid-area: disciplines">
					<h3>DISCIPLINES</h3>
					<!-- Hidden windows des disciplines -->
					<div class="discWindow discWindow-1 disc1">
						<img class="croix" src="img/mobile/croix.png">
						<h3><?=strtoupper($persoInfos['nom_discipline'])?> - lvl 1</h3>
						<?=$persoInfos['description_discipline']?>
						<div class="discWindow-box button">
							level up : <i>soon !</i> 
						</div>
					</div>
					<!-- end -->
					<div class="discContainer">
						<div class="discBox button" id="disc1">
							<b>Nom Discipline</b><br>
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
					<h3>HISTOIRE
						<?php
						if (in_array($persoID, $_SESSION['persosArray'])) { ?>
							<div class="editButton" id="editButtonLore">éditer</div>
						<?php 
						} ?>
					</h3>
					<span id="persoLore"><?=nl2br($persoInfos['lore'])?></span>
					<div id="editLoreBlock" hidden>
						<form method="POST" action="SERVER_UPDATES.php?action=updatePersoLore&persoID=<?=$_GET['persoID']?>">
							<textarea id="editLoreArea" name="contentEditLore"></textarea>
							<input type="submit" name="submitEditLore" value="J'édite mon histoire !">
						</form>
					</div>
				</div>

			</div>

		<?php //endif perso précisé
		} ?>
	<?php //endif connected user
	} ?>

</section>

<?php include("_shared_/scripts.php"); ?>
<script type="text/javascript" src="js/profil.js"></script>

</body>
</html>