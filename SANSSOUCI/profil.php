<?php
include("shared/refresh.php");
include("shared/connectDB.php");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/profil.css">
	<title>SANS SOUCI</title>
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

			if (isset($_SESSION['connected'])){

				echo '
				<table>
					<tr>
						<td align="right">Messages postés :</td>
						<td align="left"><span class="infoMembre">';
						$membreID = $_SESSION['id'];
						echo getInfoMembre("$membreID","nombremsg");echo '</span></td>
					</tr>
					<tr>
						<td align="right">Grade :</td>
						<td align="left"><span class="infoMembre">';
						$membreID = $_SESSION['id'];
						echo getInfoMembre("$membreID","grade");echo '</span></td>
					</tr>
					<tr>
						<td align="right">Perso :</td>
						<td align="left">';
							getPersos();
						echo '
						</td>
					</tr>
				</table>

				';
			}
			
			else{
				echo "Connecte-toi d'abord ! ;-)";
			}

			?>


		</section>

	<!--FOOTER-->
		<?php include("shared/view/footer.php") ?>

	</div>



</body>
</html> 