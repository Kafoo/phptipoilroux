<?php
include("_shared_/start.php");
include("_shared_/functions.php");
include("submits/aventures_submit.php");
?>

<!DOCTYPE html>
<html>
<head>
	<?php include("_shared_/headconfig.php");
	$_SESSION['currentURL'] = $_SERVER['REQUEST_URI']; ?>
	<!-- TINYMCE SOURCE -->
	<!-- <script src='https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=fqt2ki9s4j252fq1ttq1lqvmkpegi0vltirbxqsvjvezla8g'></script> -->
	<!-- END TINYMCE -->
	<link rel="stylesheet" type="text/css" href="style/aventures.css">
	<title>Vampire - Aventures</title>
</head>
<body>

<?php include('_shared_/header.php') ?>


<!---------- CONTENU ---------->
<section>

	<?php //IF USER IS DISCONNECTED
	if (!isset($_SESSION['connected'])) { ?>

		<h1>AVENTURES</h1>

		<div class="paco">
			Il faut te connecter pour accéder à cette page !
		</div>


	<?php //endif disconnected user


	}else{ //IF CONNECTED USER ?>


		<?php //---------SI PAS D'AVENTURE PRÉCISÉE---------
		if (!isset($_GET['avID']) OR empty($_GET['avID'])) { ?>

			<h1>AVENTURES</h1>


			<div class="container">

				<?php
				$reqAv = $bdd->query("
					SELECT * 
					FROM ss_aventures 
					ORDER BY id");

				//~~~ WHILE AVENTURES ~~~
				while ($row = $reqAv->fetch()) {
					$avID = $row['id'];
					$userID = $_SESSION['id'];
					//On cherche si un personnage du user est dans l'aventure
					$req = $bdd->query("
						SELECT ss_persos.nom
						FROM ss_persos
						JOIN ss_relation_perso2aventure 
						ON ss_persos.id=ss_relation_perso2aventure.persoID
						WHERE ss_relation_perso2aventure.avID='$avID'
						AND ss_persos.userID='$userID';
						");
					//Si oui, $persoOfAv sera défini par le nom de ce perso
					$persoOfAv = $req->fetch()['nom']; ?>

					<!-- On affiche l'aventure -->
					<div class="choixAv">
						<span>
							<?=strtoupper($row['nom_aventure'])?>
						</span>
						<?php
						if (isset($persoOfAv)) { ?>
							<a href="aventures.php?avID=<?=$avID?>" class="goAv">
								Continuer avec <?=$persoOfAv?>
							</a>
						<?php
						}else{ ?>
							<div class="goAv joinAv">
								<a>
									Rejoindre l'aventure !
								</a>
								<div class="joinPerso">
									Tu veux rejoindre cette aventure avec quel personnage ?<br><br>
									<ul class="listPersos">
									<?php
										$userID = $_SESSION['id'];
										$reqPersos = $bdd->query("
											SELECT nom, id 
											FROM ss_persos 
											WHERE userID='$userID'");
										$persos = $reqPersos->fetchall();
										for ($i=0; $i < count($persos); $i++) { 
											echo "<li>".$persos[$i]['nom']."</li>";
										}
										?>
									</ul>
								</div>
							</div>
						<?php }?>
					</div>
				<?php }?>
			</div>		
		<?php //endif pas d'aventure précisée

		}else{ //--------- SI AVENTURE PRÉCISÉE ---------?>

			<?php
			$avID = $_GET['avID'];
			$req = $bdd->query("
				SELECT *
				FROM ss_messages_aventure
				JOIN ss_persos ON ss_messages_aventure.persoID = ss_persos.id
				JOIN ss_membres ON ss_persos.userID=ss_membres.id
				JOIN ss_aventures ON ss_messages_aventure.avID = ss_aventures.id
				WHERE avID= '$avID'");
			$infoAv = $req->fetchall();
			?>

			<!------ TITRE AVENTURE ------>
			<h2><?=strtoupper($infoAv[0]['nom_aventure'])?></h2>


			<div id="gridAv">


				<?php // ------- WHILE MESSAGES ------- 
				for ($i=0; $i < count($infoAv); $i++) { 
					$info = $infoAv[$i]?>
			
					<!------ AVATAR ------>
					<div class="writerAvatarSlider <?php if($info['nom']=='GM'){echo'GM';} ?>">
						<div class="writerAvatar" style="background-image: url(img/avatars/<?php
						//Si GM, avatar générique de GM
						if ($info['nom']=='GM'){echo'GM';}
						else{echo $info['persoID'];}
						?>.jpg);">
							<div class="layer desktop">
								<b><u><?=strtoupper($info['nom'])?></u><br><br>
								<?=$info['pseudo']?></b><br>
								<?=$info['nombremsg']?> messages<br>
								(<?=$info['grade']?>)<br><br>
								<?php $date = explode('--', $info['dat']);?>
								<i>le <?=$date[0]?><br>
								à <?=$date[1]?></i>
							</div>
							<div class="layer mobile" hidden>									
								<img src="img/mobile/croix.png" class="croixAvatar">
								<span class="nomPerso">
									<?=strtoupper($info['nom'])?>
								</span><br><br>
									<table class="carac">
										<tr>
											<td>
												Force :
											</td>
											<td>
												5
											</td>
										</tr>
										<tr>
											<td>
												Dextérité :
											</td>
											<td>
												5
											</td>
										</tr>
																				<tr>
											<td>
												Intelligence :
											</td>
											<td>
												5
											</td>
										</tr>
																				<tr>
											<td>
												Charisme :
											</td>
											<td>
												5
											</td>
										</tr>
																				<tr>
											<td>
												Perception :
											</td>
											<td>
												5
											</td>
										</tr>
									</table>
									<div class="layerBox">
										<b><?=ucfirst($info['clan'])?></b><br>
										<b>LVL : </b><?=$info['lvl']?><br><br>
										<?=$info['nature']?><br>
										/<?=$info['attitude']?><br><br>
									</div>
									<div class="centering layerBox">
										<b>Concept : </b><br><?=$info['concept']?><br>
										<b>Défaut : </b><br><?=$info['defaut']?><br>
									</div>
									<div class="layerBottom">
										<b>Auteur : </b><?=$info['pseudo']?><br>
										<i><?=$info['nombremsg']?> messages<br>
										(<?=$info['grade']?>)</i><br>
									</div>
									<img class="msg-logo" src="img/icones/msg.png">
							</div>
						</div>
					</div>	

					<!------ MESSAGE ------>
					<?php //Changement de classe si c'est un msgGM
					if ($info['nom'] == 'GM') {
						echo"<div class='msg msgGM'>";
					}else{echo"<div class='msg'>";}
					?>
						<div class="dateMsg mobile">
							<?=$info['pseudo']?>, 
							<?php
							$date = explode('--', $info['dat']);
							echo 'le '.$date[0].' à '.$date[1]?>
						</div>
						<span class="contenuMsg">
							<?=htmlspecialchars_decode(nl2br($info['contenu']))?>
						</span>
					</div>

					<!------ FIXINFO ------>
					<?php 
					if ($i == 0) {//Seulement pour le 1er message ?>
						<div class="fixInfo desktop">
							<?php
							$req = $bdd->query("
								SELECT * 
								FROM ss_persos
								JOIN ss_relation_perso2aventure
								ON ss_persos.id=ss_relation_perso2aventure.persoID
								WHERE ss_relation_perso2aventure.avID = 25
								");
							$coterie = $req->fetchall();
							for ($j=0; $j < count($coterie); $j++) { 
								if ($coterie[$j]['nom']!=='GM') { //On n'affiche pas le GM ?>
									<div class="infoPersoCoterie-logo">
										<img class="logoCoterie" src="img/icones/perso.png" style="width:30px">
										<div class="infoPersoCoterie" hidden>
											<b>LVL : </b><?=$coterie[$j]['lvl']?><br><br>
											<b>Clan : </b><?=ucfirst($coterie[$j]['clan'])?><br>
											<b>Nature : </b><?=$coterie[$j]['nature']?><br>
											<b>Attitude : </b><?=$coterie[$j]['attitude']?><br>
											<b>Concept : </b><?=$coterie[$j]['concept']?><br>
											<b>Défaut : </b><?=$coterie[$j]['defaut']?><br><br>
											<b>Force : </b><?=$coterie[$j]['forc']?><br>
											<b>Dextérité : </b><?=$coterie[$j]['dexterite']?><br>
											<b>Intelligence : </b><?=$coterie[$j]['intelligence']?><br>
											<b>Charisme : </b><?=$coterie[$j]['charisme']?><br>
											<b>Perception : </b><?=$coterie[$j]['perception']?><br><br>
											<b>Discipline : </b><?=ucfirst($coterie[$j]['premDisc'])?><br>
										</div>
									</div>
									<?=$coterie[$j]['nom']?><br>
								<?php	
								} ?>
							<?php
							} ?>
						</div>		
					<?php
					}else{echo"<div></div>";}?>


				<?php //endwhile messages	
				} ?>


				<!-- REPONSE AREA -->
				<div></div>
				<div id="mceMainContainer">
					<form method="post" action="">
						<textarea id="mytextarea" name="message"></textarea>
						<input type="submit" name="submit" value='Je réponds !' style="margin: 20px;">
					</form>
				</div>
				<div></div>
			</div>



		<?php //endif aventure précisée
		} ?>

	<?php //endif connected user
	} ?>



</section>


<!---------- SCRIPTS ---------->
<?php include("_shared_/scripts.php"); ?>
<script type="text/javascript" src="js/aventures.js"></script>


</body>
</html>