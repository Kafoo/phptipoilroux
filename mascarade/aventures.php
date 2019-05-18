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
            	<script src='https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=fqt2ki9s4j252fq1ttq1lqvmkpegi0vltirbxqsvjvezla8g'></script>
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
					FROM mas_aventures 
					ORDER BY id");

				//~~~ WHILE AVENTURES ~~~
				while ($row = $reqAv->fetch()) {
					$avID = $row['id'];
					$userID = $_SESSION['id'];
					//On cherche si un personnage du user est dans l'aventure
					$req = $bdd->query("
						SELECT mas_persos.nom
						FROM mas_persos
						JOIN mas_relation_perso2aventure 
						ON mas_persos.id=mas_relation_perso2aventure.persoID
						WHERE mas_relation_perso2aventure.avID='$avID'
						AND mas_persos.userID='$userID';
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
							<a href="aventures.php?avID=<?=$avID?>#pmop" class="goAv">
								Continuer avec <?=$persoOfAv?>
							</a>
						<?php
						}else{ ?>
							<div class="joinPerso">
								Tu veux rejoindre cette aventure avec quel personnage ?<br><br>
								<?php
								$userID = $_SESSION['id'];
								$reqPersos = $bdd->query("
									SELECT nom, id 
									FROM mas_persos 
									WHERE userID='$userID'");
								$persos = $reqPersos->fetchall();
								for ($i=0; $i < count($persos); $i++) { ?> 
									<a href="aventures.php?avID=<?=$avID?>&persoID=<?=$persos[$i]['id']?>">
										<?=$persos[$i]['nom']?>
									</a>
								<?php 
								} ?>
							</div>
							<div class="goAv joinAv">
								<a>
									Rejoindre l'aventure !
								</a>
							</div>
						<?php }?>
					</div>
				<?php }?>
			</div>		
		<?php //endif pas d'aventure précisée

		}else{ //--------- SI AVENTURE PRÉCISÉE ---------

			//On check si un perso du user est déjà dans l'aventure
			$avID = $_GET['avID'];
			$userID = $_SESSION['id'];
			$req = $bdd->query("
				SELECT *
				FROM mas_relation_perso2aventure
				JOIN mas_persos
				ON mas_relation_perso2aventure.persoID=mas_persos.id
				WHERE mas_persos.userID='$userID'
				AND mas_relation_perso2aventure.avID='$avID'");
			$res = $req->fetchall();
			//Si non et qu'il rejoint, on l'ajoute :
			if (count($res)==0 
				AND isset($_GET['persoID'])){
				$persoID = $_GET['persoID'];
				$bdd->query("
					INSERT INTO mas_relation_perso2aventure (persoID, avID)
					VALUES ('$persoID','$avID') ");
			//Si oui, on défini quand même le $persoID
			}else{
				$persoID = $res[0]['persoID'];
			}

			$avID = $_GET['avID'];

			//PAGINATION
			$postsParPage = 6;
			$req = $bdd->query("SELECT DISTINCT postID FROM mas_messages_aventure WHERE avID='$avID'");
			$NbrMessages = $req->rowCount();
			$NbrPages = ceil($NbrMessages/$postsParPage);
			//On défini la page courante
			if (isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page'] > 0) {
				$_GET['page']=intval($_GET['page']);
				$currentPage = $_GET['page'];
			}else{
				$currentPage = $NbrPages;
			}
			//On défini où on en est sur cette page
			$start = ($currentPage-1)*$postsParPage;

			//On met toutes les infos de chaque message de la page dans $msgS
			$req = $bdd->query("
				SELECT DISTINCT postID 
				from mas_messages_aventure 
				ORDER BY postID 
				LIMIT ".$start.",".$postsParPage."
				");
			$postArray = $req->fetchall(PDO::FETCH_COLUMN, 0);
			$postString = implode("', '", $postArray);

			$req = $bdd->query("
				SELECT *
				FROM mas_messages_aventure
				LEFT JOIN mas_persos ON mas_messages_aventure.persoID = mas_persos.id
				LEFT JOIN mas_membres ON mas_persos.userID=mas_membres.id
				LEFT JOIN mas_aventures ON mas_messages_aventure.avID = mas_aventures.id
				WHERE avID= '$avID'
				AND postID IN ('$postString')
				ORDER BY postID
				");
			$msgS = $req->fetchall();

			//On cherche si le user est le GM
			if ($msgS[0]['gmID'] == $userID) {
				$_SESSION['GM'] = "1";
			} else {
				$_SESSION['GM'] = "0";
			}

			//On récupère le dernier message du joueur, pour l'édition/suppression
			$req = $bdd->query("
				SELECT *
				FROM mas_messages_aventure
				WHERE avID= '$avID' AND auteurID='$userID'
				ORDER BY mas_messages_aventure.id DESC ");
			$lastMsgID = $req->fetch()[0];

			//On vérifie si le dernier message posté est celui du user actif
			if ($currentPage == $NbrPages 
			AND $msgS[count($msgS)-1]['userID'] == $userID) {
				$lastIsUser = True;
			}else{
				$lastIsUser = False;
			}

			//On met tous les persos présents et leurs infos dans $coterie
			$req = $bdd->query("
				SELECT * 
				FROM mas_persos
				JOIN mas_relation_perso2aventure
				ON mas_persos.id=mas_relation_perso2aventure.persoID
				LEFT JOIN mas_disciplines
				ON mas_persos.discID=mas_disciplines.id
				WHERE mas_relation_perso2aventure.avID = 25
				");
			$coterie = $req->fetchall();

			//On identifie le GM de cette coterie et on le met dans $GMID
			foreach ($coterie as $perso) {
				if ($perso['nom'] == 'GM') {
					$GMID = $perso['userID'];
				}
			}

			?>

			<!------ TITRE AVENTURE ------>
			<h2><?=$msgS[0]['nom_aventure']?></h2>


			<!-- SELECTION DE PAGE -->	
			<div></div>
			<div class ="pagination"> Pages :
			<?php
			for ($i=1; $i <= $NbrPages ; $i++) {

				if ($i==$currentPage) {
					echo "<span style='color:#c8c8c8'>".$i."</span>";
				}
				else{
					echo "<a href='aventures.php?avID=".$avID."&page=".$i."'>".$i."</a> ";
				}
				if ($i<$NbrPages) {
					echo " - ";
				}
			} ?>
			</div>
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
				<div class ="pagination"> Pages :
				<?php
				for ($i=1; $i <= $NbrPages ; $i++) {

					if ($i==$currentPage) {
						echo "<span style='color:lightgrey'>".$i."</span>";
					}
					else{
						echo "<a href='aventures.php?avID=".$avID."&page=".$i."'>".$i."</a> ";
					}
					if ($i<$NbrPages) {
						echo " - ";
					}
				} ?>
				</div>
				<div></div>

				<div></div><div style="height: 20px" SPACER></div><div></div>
				
				<!-- REPONSE AREA -->
				<div>
					<div style="height: 40px" SPACER></div>
					<?php
					if ($lastIsUser == True) { //diceReply possible ou non?>
					<div class="showingOW replyOption desktop" OW="diceReply">
						<img src="img/icones/d20black.png">
					</div>
					<?php
					} else{ ?>
					<div class="showingOW replyOption desktop" OW="diceReply-error">
						<img src="img/icones/d20black.png">
					</div>
					<?php
					}
					if ($_SESSION['GM'] == 1) { //Si GM, choix des players?>
						<div class="showingOW replyOption desktop showingAlloGM showingAlloGM-menu" OW="alloGM-menu">
							<img src="img/icones/allogm.png"><div class="
							unseen"></div>
						</div>
					<?php
					}
					else{ //Sinon, direct la messagerie?>
						<div class="showingOW replyOption desktop showingAlloGM showingAlloGM-direct" OW="alloGM">
							<img src="img/icones/allogm.png">
						</div>
					<?php
					}
					?>
					<div class="showingOW replyOption desktop showingNotes" OW="notes">
						<img src="img/icones/notes.png">
					</div>
				</div>

				<div class="OWContainer" id="replyContainer">


					<!-- LANCER DE DES -->
					<div class="OW" id="diceReply">
						<div class="closingCross"></div>
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
						<div class="closingCross"></div>
						<div class="container">
							<br>
							Avant de lancer un dé, tu dois écrire et poster un message qui décrit ton action ! ;-)
						</div>
					</div>


					<!-- ALLO GM -->
					<div class="OW" id="alloGM-menu">
						<div class="closingCross"></div>
						<h3>ALLO GM</h3>
						<div style="height: 30px" SPACER></div>
						<?php
						foreach ($coterie as $perso) {
							if ($perso['nom'] !== "GM") { ?>
								<div class="alloGM-playerChoice choice-gen button unseen2" id="<?=$perso['userID']?>">
									<?=$perso['nom']?>
								</div>
							<?php
							}
						}
						?>
					</div>
					<div class="OW" id="alloGM">
						<div class="closingCross"></div>
						<h3>ALLO GM</h3>
						<!-- ajax -->
						<div class="alloGM-content">
						</div>
						<textarea class="alloGM-textArea"></textarea>
						<div class="alloGM-submit button"></div>
					</div>


					<!-- NOTES PERSOS -->
					<div class="OW" id="notes">
						<div class="closingCross"></div>
						<h3>Notes Perso</h3>
						<div class="notesPaper">
							<div class="notesPaperStyle">
								<span class="notesContent"></span>
							</div>
							<div class="editButton" id="editButtonNotes">edit</div>
						</div>
						<div class="editNotesBlock" hidden>
							<textarea class="notesPaperStyle" id="editNotesArea"></textarea>
							<div class="confirmEditNotes button">OK</div>
						</div>
					</div>
					<!-- REPONSE TEXTE -->
					<form id="classicReply" method="POST" action="">
						<textarea class="mytextarea" name="message"></textarea>
						<input type="submit" name="submit" value='Je réponds !'>
					</form>
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