<?php
include("_shared_/start.php");
include("_shared_/functions.php");
/*include("submits/tapage_submit.php");*/
?>

<!DOCTYPE html>
<html>
<head>
	<?php include("_shared_/headconfig.php"); 
	$_SESSION['currentURL'] = $_SERVER['REQUEST_URI']; ?>
	<link rel="stylesheet" type="text/css" href="style/aventures.css">
	<title>Vampire - Aventures</title>
</head>
<body>

<?php include('_shared_/header.php') ?>


<!-- -------- CONTENU -------- -->
<section>

	<?php //IF USER IS DISCONNECTED
	if (!isset($_SESSION['connected'])) { ?>

		<h1>AVENTURES</h1>

		<div class="paco">
			Il faut te connecter pour accéder à cette page !
		</div>


	<?php //endif disconnected user


	}else{ //IF CONNECTED USER ?>


		<?php //SI PAS D'AVENTURE PRÉCISÉE
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
						WHERE ss_relation_perso2aventure.aventureID='$avID'
						AND ss_persos.userID='$userID';
						");
					//Si oui, $persoOfAv sera défini par le nom de ce perso
					$persoOfAv = $req->fetch()['nom']; ?>

					<!-- On affiche l'aventure -->
					<div class="choixAv">
						<span>
							<?=strtoupper($row['nom'])?>
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
						<?php
						} ?>
					</div>

					
				<?php }?>





			</div>		


		<?php //endif pas d'aventure précisée


		}else{ //SI AVENTURE PRÉCISÉE ?>

			<h2>OEIL POUR OEIL</h2>


				<div id="gridAv">


					<!-- MESSAGE GM -->
					<div class="writerAvatarSlider">
						<div class="writerAvatar" style="background-image: url(img/avatars/test.jpg);">
							<div class="layer">
								<img src="img/mobile/croix.png" class="croixAvatar" hidden>
								ALMA<br><br>Blabloup<br>Blabloup<br>
							</div>
						</div>
					</div>	

					<div class="msg msgGM">
						<div class="dateMsg">Kafoo, le 15/10/2018 à 15h34</div>
						<span class="contenuMsg">
							LOREM IPSUM<br><br>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
							consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
							cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
							proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
						</span>
					</div>

					<div class="fixInfo desktop">
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip.
					</div>

					<!-- MESSAGE 2 -->
					<div class="writerAvatarSlider">
						<div class="writerAvatar" style="background-image: url(img/avatars/test.jpg);">
							<div class="layer">
								<img src="img/mobile/croix.png" class="croixAvatar" hidden>
								ALMA<br><br>Blabloup<br>Blabloup<br>
							</div>
						</div>
					</div>	

					<div class="msg">
						<div class="dateMsg">Kafoo, le 15/10/2018 à 15h34</div>
						<span class="contenuMsg">
							LOREM IPSUM<br><br>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
							consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
							cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
							proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
						</span>
					</div>

					<div><!-- FIXINFO DESKTOP SPACE --></div>


		<?php //endif aventure précisée
		} ?>

	<?php //endif connected user
	} ?>



</section>

<?php include("_shared_/scripts.php"); ?>
<script type="text/javascript" src="js/aventures.js"></script>


</body>
</html>