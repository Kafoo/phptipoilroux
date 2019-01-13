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
				$persoID=$_GET['persoID'];
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

			//On récupère le dernier message du joueur, pour l'édition/suppression
			$req = $bdd->query("
				SELECT *
				FROM mas_messages_aventure
				WHERE avID= '$avID' AND auteurID='$userID'
				ORDER BY mas_messages_aventure.id DESC ");
			$lastMsgID = $req->fetch()[0];

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
			?>

			<!------ TITRE AVENTURE ------>
			<h2><?=strtoupper($msgS[0]['nom_aventure'])?></h2>

			<div id="gridAv">

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



/*					for ($j=0; $j < ; $j++) { 
						# code...
					}

					$info = $msgS[$i];
					
*/
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

				<!-- REPONSE AREA -->
				<div>
					<div style="height: 40px" SPACER></div>			
					<div class="showingOW replyOption button desktop" OW="diceReply">
						Lancé de dés
					</div>
					<div class="showingOW replyOption button desktop" OW="alloGM">
						Allô GM
					</div>
					<div class="showingOW replyOption button desktop" OW="notes">
						Notes
					</div>
				</div>

				<div class="OWContainer" id="replyContainer">
					<div class="OW" id="diceReply">
						<div class="closingCross"></div>
						<form method="POST" action="">
							<h4>Titre</h4>
								
							<input type="text" name="title">
							<h4>Caractéristique</h4>

							<div class="diceReply-caracContainer container centering">	
								<div class="logo-carac1 diceReply-carac button"></div>
								<div class="logo-carac2 diceReply-carac button"></div>
								<div class="logo-carac3 diceReply-carac button"></div>
								<div class="logo-carac4 diceReply-carac button"></div>
								<div class="logo-carac5 diceReply-carac button"></div>
							</div>

							<h4>Difficulté</h4>
						</form>
					</div>
					<div class="OW" id="alloGM">
						<div class="closingCross"></div>
						ALLO GM
					</div>
					<div class="OW" id="notes">
						<div class="closingCross"></div>
						NOTES
					</div>
					<form method="POST" action="">
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

<!---------- SCRIPTS ---------->
<?php include("_shared_/scripts.php"); ?>
<script type="text/javascript" src="js/aventures.js"></script>

</body>
</html>