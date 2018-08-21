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

			if (isset($_SESSION['connected'])){
				echo '

				<h2><?=$_SESSION["pseudo"];?></h2>

				<table>
					<tr>
						<td align="right">Messages postés :</td>
						<td align="left"><span class="infoMembre">'.
							$_SESSION['nombremsg']
						.'</span></td>
					</tr>
					<tr>
						<td align="right">Grade :</td>
						<td align="left"><span class="infoMembre">'.
							$_SESSION['grade']
						.'</span></td>
					</tr>
					<tr>
						<td align="right">Perso :</td>
						<td align="left">';
							if (isset($_SESSION['nomPerso'])){
								echo $_SESSION['nomPerso'];
							}
							else{
								echo '<a class="infoMembre" href="creaperso.php">Créer un perso</a>';
							}
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