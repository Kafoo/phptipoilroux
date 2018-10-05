<?php
include("shared/refresh.php");
include("shared/connectDB.php");
include("php/functions.php");

?>

<!DOCTYPE html>
<html>
<head>
	<?php include("shared/headconfig.php") ?>
	<link rel="stylesheet" type="text/css" href="css/mobileconnect.css">
	<title>VAMPIRE - Profil</title>
</head>
<body>

	<div class="mainGrid">

	<!--HEADER-->
		<?php include("shared/view/header.php") ?>

	<!--SECTION-->
		<section class="sectionGrid">

			<div id="connectionMobile">
				<form method="POST" action="">
					<input type="text" name="pseudoConnect" placeholder="Pseudo"><br>
					<input type="password" name="passwordConnect" placeholder="Mot de passe"><br>
					<input type="submit" name="submitConnect" value="Se connecter">
				</form>
				<div id="subscribeMobile"><a href="subscribe.php">Nouveau ?</a></div>
			</div>


		</section>

	<!--FOOTER-->
		<?php include("shared/view/footer.php") ?>

	</div>


</body>
</html> 