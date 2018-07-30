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
			<h1>PROFIL</h1>
			_______________
			<br/>
			<br/>

			<?php

			if (isset($_SESSION['id'])){
				echo '

				<h2><?=$_SESSION["pseudo"];?></h2>

				<table>
					<tr>
						<td align="right">Statut :</td>
						<td align="left"><span class="infoMembre">Membre</span></td>
					</tr>
					<tr>
						<td align="right">Perso :</td>
						<td align="left"><a class="infoMembre" href="creaperso.php">Créer un nouveau perso !</a></td>
					</tr>
					<tr>
						<td align="right">Histoire actuelle :</td>
						<td align="left"></td>
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