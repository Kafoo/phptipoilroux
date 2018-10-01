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
	$_SESSION['currentStoryPage'] = $_SERVER['REQUEST_URI'];

	?>
	<link rel="stylesheet" type="text/css" href="css/histoire.css">
  
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


	<title>VAMPIRE - Histoire</title>
</head>
<body>

	<div class="mainGrid">

	<!--HEADER-->
		<?php include("shared/view/header.php") ?>

	<!--SECTION-->
		<section id="sectionGrid">


			<?php

			if (isset($_SESSION['connected'])) {

				if (!isset($_GET['avID'])) {  

					echo '<div></div><h1>HISTOIRES</h1><div></div>';

					$reqAventures = $bdd->query("SELECT DISTINCT nom, aventureID FROM ss_aventures ORDER BY id");
					while ($row = $reqAventures->fetch()) {
						echo '
						<div></div>
						<div class="choixAventure" onclick="window.location=\'histoire.php?avID='.$row['aventureID'].'\'"; >'.$row['nom'].'</div>
						<div></div>';
					}

				}
				else { ?>


					<div></div>
					<h1>
						<?php
						$aventureID = $_GET['avID'];
						$nomAv = $bdd->query("SELECT nom FROM ss_aventures WHERE aventureID = '$aventureID' ");
						echo $nomAv->fetch()[0]."bouh";
						?>
					</h1>

					<div></div>

					<div></div><span><?php if (isset($error)) {
						echo '
						<div id="erreur">
							<h3 style="margin-top:5px;">Oups !</h3>
							'.$error.'
						</div>';
					} ?></span><div></div>

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




					<?php 
					$aventureID = $_GET['avID'];
					$reqMessages = $bdd->query("SELECT * FROM ss_messages_aventure WHERE aventureID='$aventureID' ");

					while ($m = $reqMessages->fetch()) {
					?>


						<div class="mobileInfo" hidden>
							<span class="mobileInfoWriter">
								<a href="" style="font-weight: bold; color: black"><?=getInfoMembre('$m["auteurID"]', 'pseudo')?></a>LVL100<br/>
								Malkavien - Célérité
							</span>
							<span class="mobileInfoUser">
								<img src="img/icones/conversgm.png" width="30px" style="cursor: pointer;" onclick="showConversGm()">
						<img src="img/icones/d20.png" width="37px" style="cursor: pointer;" onclick="showDice()">
							</span>

						</div>
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
					<div>
					  <form method="post" action="">
					    <textarea id="mytextarea" name="message"></textarea>
					    <input type="submit" name="submit">
					  </form>
					</div>
					<div></div>


				<?php }

			} 
			else { ?>
				

				<div></div><h1>HISTOIRE</h1><div></div>
				<div></div><div>Connecte toi d'abord ;-)</div><div></div>

			<?php
			}
			?>

		</section>



	<!--FOOTER-->
		<?php include("shared/view/footer.php") ?>

	</div>

<script type="text/javascript" src="js/histoire.js"></script>
</body>
</html> 