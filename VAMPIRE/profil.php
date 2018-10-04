<?php
include("shared/refresh.php");
include("shared/connectDB.php");
include("php/functions.php");

if (isset($_POST['submit'])) {

	if (isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name'])){

		$maxSize = 2097152;
		if ($_FILES['avatar']['size'] <= $maxSize) {
			$validExt = array('jpg', 'jpeg', 'png');
			$uploadExt = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));

			if (in_array($uploadExt, $validExt)) {
				$uploadPath = "img/avatars/plop"/*.$_SESSION['id'].".".$uploadExt*/;
				$tempPath = $_FILES['avatar']['tmp_name'];
				$move = move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadPath);
				
				if ($move) {
					$error="yeah";

				}else{
					$error = "Il y a eu un souci avec l'upload...";
				}
			}else{
				$error = "Ton avatar doit être au format 'jpg', 'jpeg' ou 'png'";
			}
		}else{
			$error = "Ton avatar est trop lourd ! (2Mo max)";
		}
	}else{
		$error = "avatar non précisé";
	}
	

}


?>

<!DOCTYPE html>
<html>
<head>
	<?php include("shared/headconfig.php") ?>
	<link rel="stylesheet" type="text/css" href="css/profil.css">
	<title>VAMPIRE - Profil</title>
</head>
<body>

	<div class="mainGrid">

	<!--HEADER-->
		<?php include("shared/view/header.php") ?>

	<!--SECTION-->
		<section class="sectionGrid">

			<h1>PROFIL <?php if (isset($_SESSION['connected'])) {echo "DE ". strtoupper($_SESSION["pseudo"]);}?> </h1>
			___________________________________________________
			<br/>
			<br/>

			<?php
		
			if (isset($error)) {
				echo '
				<div id="erreur">
					<h3 style="margin-top:5px;">Oups !</h3>
					'.$error.'
				</div>';
			}


			if (isset($_SESSION['connected'])){ ?>

				<table>
					<tr>
						<td align="right">Messages postés :</td>
						<td align="left"><span class="infoMembre">
						<?php $membreID = $_SESSION['id'];
						echo getInfoMembre("$membreID","nombremsg"); ?> </span></td>
					</tr>
					<tr>
						<td align="right">Grade :</td>
						<td align="left"><span class="infoMembre">
						<?php $membreID = $_SESSION['id'];
						echo getInfoMembre("$membreID","grade"); ?> </span></td>
					</tr>
				</table>

				<form method="POST" enctype="multipart/form-data" action="">
					<input type="file" name="avatar">
					<input type="submit" name="submit">
				</form>

				<br>
				<h3>Persos :</h3>

				<?php showPersosList(); ?>

				<br><br>

				<?php
				$reqNomPerso = $bdd->query("SELECT nom FROM ss_persos WHERE membreID = '$membreID' ORDER BY id");
				$nombrePerso = $reqNomPerso->rowCount();
				if ($nombrePerso > 0) {
					echo '<a href="creaperso.php" style="color: #bfbfbf; font-style: italic">Créer un nouveau perso</a>';
				};

			} else{ ?>

				Connecte-toi d'abord ! ;-)

			<?php 
			} ?>


		</section>

	<!--FOOTER-->
		<?php include("shared/view/footer.php") ?>

	</div>


<script type="text/javascript" src="js/profil.js"></script>
</body>
</html> 