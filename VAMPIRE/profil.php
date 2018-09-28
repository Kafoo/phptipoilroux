<?php
include("shared/refresh.php");
include("shared/connectDB.php");
include("php/functions.php");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/profil.css">
	<!-- 	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
	<script src="shared/jquery"></script>
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