<?php
include("shared/refresh.php");
include("shared/connectDB.php");
include("php/functions.php");
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
				<form type="enc-data"></form>
				<input type="file" name="">
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