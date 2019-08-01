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
	<title>Shukidy - Aventures</title>
</head>
<body>

<?php 
include('_shared_/header.php');
include('_shared_/class_persos.php');
?>


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
			<h2><?=$avInfos['nom_aventure']?></h2>

			<!-- SELECTION DE PAGE -->	
			<?php
			showPages();
			?>
			<div class="fixInfosSlider desktop">
				<?php include('content/aventures/fixinfos.php');?>
			</div>
			<div id="gridAv">

				<?php // ------- WHILE MESSAGES ------- 

				foreach ($allMsg as $msgKey => $msg) {
					//Si le message est sensé être sur la page
					if ($msg['postID'] >= $firstPostOfPage
					AND $msg['postID'] <= $lastPostOfPage) {

						if ($msgKey>0) {
							$previousMsg = $allMsg[$msgKey-1];
						}
						if ($msgKey<count($allMsg)-1) {
							$nextMsg = $allMsg[$msgKey+1];
						}

						//On définit le début et la fin du post total
						$firstMsgOfPost = False;
						$lastMsgOfPost = False;
						$LPOP = False;
						if ($msgKey == 0 
						OR $msg['postID'] > $previousMsg['postID']) {
							$firstMsgOfPost = True;
						}
						if ($msgKey == count($allMsg)-1 
						OR $msg['postID'] < $nextMsg['postID']) {
							$lastMsgOfPost = True;
						}
						//Last post of page pour l'ancre
						if ($msg['postID'] == $lastPostOfPage
						OR $msg['postID'] == $nbrPosts) {
							$LPOP = True;
						}

						//------ RP / diceroll from player ------
						if ($msg['type'] == 'rp' OR $msg['type'] == 'drPlayer') {
							
							//START
							if ($firstMsgOfPost == True) {
								include('content/aventures/msg_rp_start.php');
							}
							//si RP 
							if ($msg['type'] == 'rp') {
								key($msg);
								//si précédent rp du même perso, on met un séparateur
								if ($msgKey !== 0 
								AND $previousMsg['type'] == 'rp' 
								AND $firstMsgOfPost == False) { 
									echo '<div class="separate"></div>';
								} ?>

								<!-- CONTENT -->
								<span <?php if ($lastMsgOfPost == True){echo "class='lastMsgOfPost'";} ?> >
									<?=htmlspecialchars_decode(nl2br($msg['content_rp']))?>
								</span>
							<?php
							} 

							//si DiceRoll
							if ($msg['type'] == 'drPlayer') {
								include ("content/aventures/msg_diceroll.php");		
							} 

							//END
							if ($lastMsgOfPost == True) {
								include('content/aventures/msg_rp_end.php');
							}

						}

						//------ Dice Roll from GM ------
						if ($msg['type'] == 'drGM') {

							//START
							if ($firstMsgOfPost == True) {
								include('content/aventures/msg_drGM_start.php');
							}

							include('content/aventures/msg_drGM.php');

							//END
							if ($lastMsgOfPost == True) {
								echo "</div>";
							}
						}

						//------ LOG ------
						if ($msg['type'] == 'log') {

							//START
							if ($firstMsgOfPost == True) { ?>

								<div></div>
								<div class="msgLog">	

							<?php
							}
							if ($msgKey !== 0
							AND $firstMsgOfPost == False) { 
								echo '<div class="separate"></div>';
							}
							echo htmlspecialchars_decode(nl2br($msg['content_log']));

							//END
							if ($lastMsgOfPost == True) {
								echo "</div>";
							}	
							
						}

						//------ LOG ------
						if ($msg['type'] == 'start') { ?>

							<div></div><div class="msg centering">Bienvenue dans une nouvelle aventure ! Poste un premier message pour commencer</div>

						<?php
						}
					}
				}


				?>

				<!-- SELECTION DE PAGE -->	
				<div></div>
				<?php
				showPages();
				?>


				<div></div><div style="height: 20px" SPACER></div>
				

				<!-- SHOWING OW -->
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
						<div class="showingOW replyOption showingGMDashBoard" OW="GMDashBoard-menu">
							<img src="img/icones/baguette.png">
						</div>
					<?php 
					} ?>

				</div>


				<!-- REPONSE AREA -->
				<div class="OWContainer" id="replyContainer">
					<!-- REPONSE TEXTE -->
					<form class="OW" id="classicReply" method="POST" action="">
						<div class="mobile">
							<div class="closingArrow"></div>
						</div>
						<textarea class="mytextarea" id="tinymce-classicReply" name="message"></textarea>
						<input type="text" name="persoID" value="<?=$persoID?>" hidden>
						<input type="submit" name="submit" value='Je réponds !'>
					</form>

					<!-- LANCER DE DES -->
					<div class="OW" id="diceReply">
						<div class="mobile">
							<div class="closingArrow"></div>
						</div>
						<h3>LANCE DE DES</h3>
						<div class="OWContent">
							<form method="POST" action="">

								<h4>Titre</h4>
								<input type="text" name="diceReply-title" placeholder="titre du lancé">
								<h4>Caractéristique</h4>
								<div class="diceReply-caracContainer container centering">	
									<div class="carac1 diceReply-carac button"
									onclick="choose('carac', '1')" data-toggle="tooltip" data-placement="top" title="<?=ucfirst($caracOfAv['c1_name'])?>"></div>
									<div class="carac2 diceReply-carac button" 
									onclick="choose('carac', '2')" data-toggle="tooltip" data-placement="top" title="<?=ucfirst($caracOfAv['c2_name'])?>"></div>
									<div class="carac3 diceReply-carac button" 
									onclick="choose('carac', '3')" data-toggle="tooltip" data-placement="top" title="<?=ucfirst($caracOfAv['c3_name'])?>"></div>
									<div class="carac4 diceReply-carac button" 
									onclick="choose('carac', '4')" data-toggle="tooltip" data-placement="top" title="<?=ucfirst($caracOfAv['c4_name'])?>"></div>
									<div class="carac5 diceReply-carac button" 
									onclick="choose('carac', '5')" data-toggle="tooltip" data-placement="top" title="<?=ucfirst($caracOfAv['c5_name'])?>"></div>
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
								<input type="text" name="persoID" value="<?=$persoID?>" hidden>
								<?php 
								$persoObjectID = 'perso'.$persoID;
								$persoObjectJson = json_encode($$persoObjectID); 
								?>
								<input type="text" name="persoObjectJson" value='<?=$persoObjectJson?>' hidden>

								<input id="diceReply-submit"  type="submit" name="diceReply-submit" value="Je lance mon dé !">
							</form>
						</div>
					</div>
					<div class="OW" id="diceReply-error">
						<div class="mobile">
							<div class="closingArrow"></div>
						</div>
						<h3>LANCE DE DES</h3>
						<div class="OWContent">
							<br>
							Avant de lancer un dé, tu dois écrire et poster un message qui décrit ton action ! ;-)
						</div>
					</div>


					<!-- ALLO GM -->
					<div class="OW" id="alloGM-menu">
						<div class="mobile">
							<div class="closingArrow"></div>
						</div>
						<h3>ALLO GM</h3>
						<div class="OWContent">
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
					</div>
					<div class="OW" id="alloGM">
						<div class="mobile">
							<div class="closingArrow"></div>
						</div>
						<h3>ALLO GM</h3>
						<div class="OWContent">
							<!-- ajax -->
							<div class="alloGM-content">
							</div>
							<textarea class="alloGM-textArea"></textarea>
							<div class="alloGM-submit button"></div>
						</div>
					</div>


					<!-- NOTES PERSOS -->
					<div class="OW" id="notes">
						<div class="mobile">
							<div class="closingArrow"></div>
						</div>
						<h3>NOTES</h3>
						<div class="OWContent">
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
					</div>

					<!-- FIXINFOS MOBILE -->
					<div class="OW" id="fixinfosMobile">
						<div class="mobile">
							<div class="closingArrow"></div>
						</div>
						<h3>INFOS PERSOS</h3>
						<div class="OWContent">
							<?php include('content/aventures/fixinfos.php');?>
						</div>
					</div>

					<!-- GM DASHBOARD -->
					<div class="OW" id="GMDashBoard-menu">
						<div class="mobile">
							<div class="closingArrow"></div>
						</div>
						<h3>GM DASHBOARD</h3>
						<div class="OWContent">
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

					</div>

					<!-- Pour chaque perso, on créé le dashboard correspondant -->
					<?php
					foreach ($array_objectPersos as $perso) {
						if ($perso->nom !== "GM") { ?>
							<div class="OW GMDashBoard" id="GMDashBoard-<?=$perso->userID?>">
								<div class="mobile">
									<div class="closingArrow"></div>
								</div>
								<!-- ajax -->
								<div class="GMDashBoard-content OWContent">
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