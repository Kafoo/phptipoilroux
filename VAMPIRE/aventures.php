<?php
include("shared/refresh.php");
include("shared/connectDB.php");
include("php/functions.php");

if (isset($_POST['submit'])) {
	
	if (isset($_POST['message']) AND !empty($_POST['message'])) {
		
		$membreID = $_SESSION['id'];
		$reqActif = $bdd->query("SELECT nom FROM ss_persos WHERE membreID = '$membreID' AND actif = '1' ");
		$CheckActif = $reqActif->rowCount();
		if ($CheckActif == 1) {
			
			$dat = getRealDate();
			$auteurID = $_SESSION['id'];
			$contenu = htmlspecialchars($_POST['message'], ENT_QUOTES);
			$membreID = $_SESSION['id'];
			$reqActifPerso = $bdd->query("SELECT nom FROM ss_persos WHERE membreID = '$membreID' AND actif = '1' ");
			$perso = $reqActifPerso->fetch()[0];
			$aventureID = $_GET['avID'];
			$bdd->query("INSERT INTO ss_messages_aventure (dat, auteurID, contenu, perso, aventureID) VALUES ('$dat', '$auteurID', '$contenu', '$perso', '$aventureID')");
			/*Incrémente de 1 le nombre de message postés pour ce compte*/
			$bdd->query("UPDATE ss_membres SET nombremsg=nombremsg+1 WHERE id=$auteurID");

		}else{
			$error = "Tu dois avoir un personnage actif avant d'écrire un message =)";
		}

	}else{
		$error = "Tu dois écrire quelque chose !";
	}
}


?>

<!DOCTYPE html>
<html>
<head>
	<?php include("shared/headconfig.php");
	$_SESSION['currentStoryURL'] = $_SERVER['REQUEST_URI'];

	?>
	<link rel="stylesheet" type="text/css" href="css/aventures.css">
 
<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=fqt2ki9s4j252fq1ttq1lqvmkpegi0vltirbxqsvjvezla8g"></script>

<script>
tinymce.init({
  selector: 'textarea',
  height: 300,
  menubar: false,
  forced_root_block_attrs: { "style": "margin: 2px 0;" },
  forced_root_block : '',
  plugins: [
    'advlist autolink lists link image charmap print preview anchor textcolor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table contextmenu paste code help'
  ],
  toolbar: 'undo redo |  formatselect | bold italic backcolor forecolor  | alignleft aligncenter alignright alignjustify | bullist numlist 	| image | help',
  content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    '//www.tinymce.com/css/codepen.min.css']
});
  </script>


	<title>VAMPIRE - Aventures</title>
</head>
<body>

	<div class="mainGrid">

	<!--HEADER-->
		<?php include("shared/view/header.php") ?>

	<!--SECTION-->
		<section id="sectionGrid">

			<?php

			if (isset($_SESSION['connected'])) {


				//------------- PAS D'AVENTURE PRECISEE : LISTE DES AVENTURES -------------
				if (!isset($_GET['avID'])) {  

					echo '<h1>AVENTURES</h1>';

					$reqAventures = $bdd->query("SELECT DISTINCT nom, aventureID FROM ss_aventures ORDER BY aventureID");
					while ($row = $reqAventures->fetch()) {

						$aventureID = $row['aventureID'];
						$reqPersosAventure = $bdd->query("SELECT perso FROM ss_aventures WHERE aventureID = '$aventureID'");
						$activePerso = getActivePerso();
						$checkActivePerso = $bdd->query("SELECT * FROM ss_aventures WHERE aventureID = '$aventureID' AND perso = '$activePerso' ")->rowCount();
						if ($checkActivePerso === 0	) {
							echo '
							<div></div>
								<div class="choixAventure">
								'.$row['nom'].'
									<a class="goAv joinAv" href=\'aventures.php?avID='.$row['aventureID'].'\'">
										Rejoindre l\'aventure !
									</a>
								</div>
							<div></div>';
						}
						else{
							echo '
							<div></div>
								<div class="choixAventure">
								'.$row['nom'].'
									<a class="goAv" href=\'aventures.php?avID='.$row['aventureID'].'\'">
										Continuer avec '.$activePerso.'
									</a>
								</div>
							<div></div>';	
						}
					}
				//------------- AVENTURE PRECISEE : AFFICHAGE DES MESSAGES -------------
				}
				if (isset($_GET['avID'])) {	

					//Si activePerso pas encore là, le rajouter
					$aventureID = $_GET['avID'];
					$aventureNom = $bdd->query("SELECT nom FROM ss_aventures WHERE aventureID = '$aventureID' ")->fetch()[0];
					$activePerso = getActivePerso();
					$checkActivePerso = $bdd->query("SELECT * FROM ss_aventures WHERE aventureID = '$aventureID' AND perso = '$activePerso' ")->rowCount();
					if ($checkActivePerso === 0	) {
						$bdd->query("INSERT INTO ss_aventures (aventureID, nom, perso) VALUES ('$aventureID', '$aventureNom', '$activePerso')");
					}
					?>

					<!-- NOM DE L'AVENTURE -->
					<h1><?= $aventureNom; ?></h1>

					<!-- MESSAGE D'ERREUR -->
					<div></div><span><?php if (isset($error)) {
						echo '
						<div id="erreur">
							<h3 style="margin-top:5px;">Oups !</h3>
							'.$error.'
						</div>';
					} ?></span><div></div>

					<!-- INFOS FIXES DE L'AVENTURE (DESKTOP)-->
					<div class="userInfo">
						<?php 
						$aventureID = $_GET['avID']; 
						$reqPersos = $bdd->query("SELECT perso FROM ss_aventures WHERE aventureID ='$aventureID' ");

						while ($row = $reqPersos->fetch()) {
							echo '<img src="img/icones/perso.png" style=\'width:30px\'>'.$row[0].'<br>';
						}
						?>
						<br>
						<img src="img/icones/conversgm.png" width="70px" style="cursor: pointer;" onclick="showConversGm()"><br>
					</div>

					<!-- GENERATION DES MESSAGES -->
					<?php 
					$aventureID = $_GET['avID'];
					//PAGINATION
					$messagesParPage = 10;
					$reqNbrMessages = $bdd->query("SELECT * FROM ss_messages_aventure WHERE aventureID='$aventureID'");
					$NbrMessages = $reqNbrMessages->rowCount();
					$NbrPages = ceil($NbrMessages/$messagesParPage);
					//On défini la page courante
					if (isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page'] > 0) {
						$_GET['page']=intval($_GET['page']);
						$currentPage = $_GET['page'];
					}
					else{
						$currentPage = $NbrPages;
					}
					//On défini où on en est sur cette page
					$start = ($currentPage-1)*$messagesParPage;

					$reqMessages = $bdd->query("SELECT * FROM ss_messages_aventure WHERE aventureID='$aventureID' LIMIT ".$start.",".$messagesParPage."	"); ?>


					<div></div>
					<div class ="pagination"> Pages :
					<?php
					//SELECTION DE PAGE	
					for ($i=1; $i <= $NbrPages ; $i++) {

						if ($i==$currentPage) {
							echo "<span style='color:darkgrey'>".$i."</span>";
						}
						else{
							echo "<a href='aventures.php?avID=1&page=".$i."'>".$i."</a> ";
						}
						if ($i<$NbrPages) {
							echo "- ";
						}
					} ?>
					</div>
					<div></div>

					<?php
					while ($m = $reqMessages->fetch()) {
					?>
						<!-- MOBILE -->
						<div class="mobileInfo" hidden>
							<a href="" style="font-weight: bold; color: black"><?=getInfoMembre($m['auteurID'], 'pseudo')?></a> |
							<span class="blackLink"><?=getInfoMessage($m['id'], 'perso')?></span> | 
							<span style="font-size: 0.8em;"><?=$m['dat'];?></span>
						</div>

						<!-- DESKTOP -->
						<div class="msgInfo">
							<a href="" style="font-weight: bold; color: black"><?=getInfoMembre($m['auteurID'], 'pseudo')?></a><br/>
							<?=getInfoMembre($m['auteurID'], 'grade')?><br/><br/>
							Perso :<br/>
							<span class="blackLink"><?=getInfoMessage($m['id'], 'perso')?></span><br/><br/>
							<span style="font-size: 0.8em;"><?=$m['dat'];?></span>
						</div>
						<div class="msg">
							<div id="suppButton"><a class="confirm" href="SERVER_UPDATES.php?action=supprimeMessage&messageID=<?= $m['id'] ?>">X</a></div>
							<span id="contenu"><?=  str_replace('&nbsp;', ' ', htmlspecialchars_decode(nl2br($m['contenu']))); ?></span>
						</div>
						<div> <!-- USER INFO SPACE --> </div>


					<?php
					}
					?>

					<div></div>
					<div class ="pagination"> Pages :
					<?php
					//SELECTION DE PAGE	
					for ($i=1; $i <= $NbrPages ; $i++) {

						if ($i==$currentPage) {
							echo "<span style='color:darkgrey'>".$i."</span>";
						}
						else{
							echo "<a href='aventures.php?avID=1&page=".$i."'>".$i."</a> ";
						}
						if ($i<$NbrPages) {
							echo "- ";
						}
					} ?>
					</div>
					<div></div>



					<div></div>
					<div id="tinymceContainer">
					  <form method="post" action="">
					    <textarea id="mytextarea" name="message"></textarea>
					    <input type="submit" name="submit" style="margin: 20px;">
					  </form>
					</div>
					<div></div>
				
				<?php
				} //ENDIF AVENTURE 

			} //ENDIF CONNECTE 
			else { ?>
				

				<h1>AVENTURES</h1>
				<div></div><div>Connecte toi d'abord ;-)</div><div></div>

			<?php
			}
			?>
			
		</section>



	<!--FOOTER-->
		<?php include("shared/view/footer.php") ?>

	</div>

<script type="text/javascript" src="js/aventures.js"></script>
</body>
</html> 