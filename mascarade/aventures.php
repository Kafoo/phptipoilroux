<?php
include("_shared_/start.php");
include("submits/aventures_submit.php");
?>

<!DOCTYPE html>
<html>
<head>
	<?php include("_shared_/headconfig.php");
	$_SESSION['currentURL'] = $_SERVER['REQUEST_URI']; ?>
	<!-- TINYMCE SOURCE -->
    <script src='https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=fqt2ki9s4j252fq1ttq1lqvmkpegi0vltirbxqsvjvezla8g'></script>
 	<!-- END TINYMCE -->
	<link rel="stylesheet" type="text/css" href="style/aventures.css">
	<title>Vampire - Aventures</title>
</head>
<body>

<?php 
include('_shared_/header.php');
include('_shared_/class_persos.php');
?>


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
		if (!isset($_GET['avID']) OR empty($_GET['avID'])) { 

			include ('content/aventures/menu.php');

		}else{ //--------- SI AVENTURE PRÉCISÉE --------- 

			include ('content/aventures/start.php');	
			?>

			<!------ TITRE AVENTURE ------>
			<h2><?=$msgS[0]['nom_aventure']?></h2>


			<!-- SELECTION DE PAGE -->	
			<div></div>
			<?php
			showPages();
 			?>
			<div></div>

			<div id="gridAv">

				<?php // ------- WHILE MESSAGES ------- 

				for ($i=0; $i < count($postArray); $i++) {

					$msgOfPost = array_keys(array_column($msgS, 'postID'), $postArray[$i]);
					$firstMsgOfPost= $msgS[$msgOfPost[0]];
						if ($firstMsgOfPost['type'] === 'RP'){
							//MESSAGE REGULAR
							include("drawers/aventures_messages_rp.php");
						}
						if ($firstMsgOfPost['type'] === 'diceRoll_GM') { 
							//MESSAGE MECA
							include("drawers/aventures_messages_meca.php");
						}
					?>

				<?php //endwhile messages	
				} ?>

				<!-- SELECTION DE PAGE -->	
				<div></div>
				<?php
				showPages();
				?>
				<div></div>

				<div></div><div style="height: 20px" SPACER></div><div></div>
				
				<!-- REPONSE AREA -->
				<div class="showingOWContainer">
					<div class="desktop" style="height: 15px" SPACER></div>
					<div class="showingOW replyOption" OW="classicReply">
						<img src="img/icones/notes.png">
					</div>
					<?php
					if ($lastIsUser == True) { //diceReply possible ou non?>
					<div class="showingOW replyOption" OW="diceReply">
						<img src="img/icones/d20black2.png">
					</div>
					<?php
					} else{ ?>
					<div class="showingOW replyOption" OW="diceReply-error">
						<img src="img/icones/d20black2.png">
					</div>
					<?php
					}
					if ($_SESSION['GM'] == 1) { //Si GM, choix des players?>
						<div class="showingOW replyOption showingAlloGM showingAlloGM-menu" OW="alloGM-menu">
							<img src="img/icones/allogm2.png"><div class="
							unseen"></div>
						</div>
					<?php
					}
					else{ //Sinon, direct la messagerie?>
						<div class="showingOW replyOption showingAlloGM showingAlloGM-direct" OW="alloGM">
							<img src="img/icones/allogm2.png">
						</div>
					<?php
					}?>
					<div class="showingOW replyOption showingNotes" OW="notes">
						<img src="img/icones/notes2.png">
					</div>

					<div class="showingOW replyOption mobile showingFixInfos" OW="fixinfosMobile">
						<img src="img/icones/perso.png">
					</div>

					<?php
					if ($_SESSION['GM'] == 1){ ?>
						<div class="showingOW replyOption" OW="GMDashBoard-menu">
							<img src="img/icones/baguette.png">
						</div>
					<?php 
					} ?>

				</div>


				<div class="OWContainer" id="replyContainer">
					<!-- REPONSE TEXTE -->
					<form class="OW" id="classicReply" method="POST" action="">
						<div class="closingArrow mobile"></div>
						<textarea class="mytextarea" name="message"></textarea>
						<input type="submit" name="submit" value='Je réponds !'>
					</form>

					<!-- LANCER DE DES -->
					<div class="OW" id="diceReply">
						<div class="closingArrow mobile"></div>
						<form method="POST" action="">
							<h3>LANCE DE DES</h3>

							<h4>Titre</h4>
							<input type="text" name="diceReply-title">

							<h4>Caractéristique</h4>
							<div class="diceReply-caracContainer container centering">	
								<div class="carac1 diceReply-carac button"
								onclick="choose('carac', '1')"></div>
								<div class="carac2 diceReply-carac button" 
								onclick="choose('carac', '2')"></div>
								<div class="carac3 diceReply-carac button" 
								onclick="choose('carac', '3')"></div>
								<div class="carac4 diceReply-carac button" 
								onclick="choose('carac', '4')"></div>
								<div class="carac5 diceReply-carac button" 
								onclick="choose('carac', '5')"></div>
							</div>
							<input id="caracStock" type="text" name="diceReply-carac" hidden>

							<h4>Difficulté</h4>
							<div class="diff8 diceReply-diff button"
							onclick="choose('diff','8')">Facile</div>
							<div class="diff10 diceReply-diff button"
							onclick="choose('diff','10')">Normal</div>
							<div class="diff12 diceReply-diff button"
							onclick="choose('diff','12')">Difficile</div>
							<input id="diffStock" type="text" name="diceReply-diff" hidden>
							
							<br>
							<input id="resultStock" type="text" name="diceReply-result" hidden>

							<input id="diceReply-submit"  type="submit" name="diceReply-submit" value="Je lance mon dé !">
						</form>
					</div>
					<div class="OW" id="diceReply-error">
						<div class="closingArrow mobile"></div>
						<div class="container">
							<br>
							Avant de lancer un dé, tu dois écrire et poster un message qui décrit ton action ! ;-)
						</div>
					</div>


					<!-- ALLO GM -->
					<div class="OW" id="alloGM-menu">
						<div class="closingArrow mobile"></div>
						<h3>ALLO GM</h3>
						<div style="height: 30px" SPACER></div>
						<?php
						foreach ($coterie as $perso) {
							if ($perso['nom'] !== "GM") { ?>
								<div class="alloGM-playerChoice choice-gen button" id="<?=$perso['userID']?>">
									<?=$perso['nom']?>
								</div>
							<?php
							}
						}
						?>
					</div>
					<div class="OW" id="alloGM">
						<div class="closingArrow mobile"></div>
						<h3>ALLO GM</h3>
						<!-- ajax -->
						<div class="alloGM-content">
						</div>
						<textarea class="alloGM-textArea"></textarea>
						<div class="alloGM-submit button"></div>
					</div>


					<!-- NOTES PERSOS -->
					<div class="OW" id="notes">
						<div class="closingArrow mobile"></div>
						<h3>Notes Perso</h3>
						<div class="notesPaper">
							<div class="notesPaperStyle">
								<span class="notesContent"></span>
							</div>
						</div>
						<div class="editNotesBlock" hidden>
							<textarea class="notesPaperStyle" id="editNotesArea"></textarea>
							<div class="confirmEditNotes button">OK</div>
						</div>
					</div>

					<!-- FIXINFOS MOBILE -->
					<div class="OW" id="fixinfosMobile">
						<div class="closingArrow mobile"></div>
						<?php include('drawers/aventures_fixinfos.php');?>
					</div>

					<!-- GM DASHBOARD -->
					<div class="OW" id="GMDashBoard-menu">
						<div class="closingArrow mobile"></div>
						<h3>GM DASHBOARD</h3>
						<div style="height: 30px" SPACER></div>
						<?php
						foreach ($array_objectPersos as $perso) {
							if ($perso->nom !== "GM") { ?>
								<div class="GMDashBoard-playerChoice choice-gen button" id="<?=$perso->userID?>">
									<?=$perso->nom?>
								</div>
							<?php
							}
						} ?>

					</div>

					<!-- Pour chaque perso, on créé le dashboard correspondant -->
					<?php
					foreach ($array_objectPersos as $perso) {
						if ($perso->nom !== "GM") { ?>
							<div class="OW GMDashBoard" id="GMDashBoard-<?=$perso->userID?>">
								<div class="closingArrow mobile"></div>
								<!-- ajax -->
								<div class="GMDashBoard-content">
								 <?php include ('ajax/aventures_gmdashboard.php');?>
								</div>
							</div>
						<?php
						}
					} ?>

				</div>

			</div>

		<?php //endif aventure précisée
		} ?>
	<?php //endif connected user
	} ?>

</section>

<!-- JAVASCRIPT STOCK -->

<div id="avID" hidden><?=$_GET['avID']?></div>
<div id="userID" hidden><?=$userID?></div>
<div id="GMID" hidden><?=$GMID?></div>

<!---------- SCRIPTS ---------->
<?php include("_shared_/scripts.php"); ?>
<script type="text/javascript" src="js/aventures.js"></script>

</body>
</html>