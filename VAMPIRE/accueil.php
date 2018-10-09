<?php
include("shared/refresh.php");
include("shared/connectDB.php");
include("php/functions.php");
?>

<!DOCTYPE html>
<html>
<head>
	<?php include("shared/headconfig.php") ?>
	<link rel="stylesheet" type="text/css" href="css/accueil.css">
	<title>VAMPIRE - Accueil</title>
</head>
<body>

	<div class="mainGrid">

	<!--HEADER-->
		<?php include("shared/view/header.php") ?>

	<!--SECTION-->
		<section class="sectionGrid">

			<h1>ACCUEIL</h1>

			<div id="bienvenue">

				<div id="ongletBlock">

					<div class="allonglet currentOnglet" 
					id="ongletgg"
					onmouseover="this.style.backgroundColor='rgba(211,211,211,0.5)';"
					onmouseout="this.style.backgroundColor='transparent';"
					onclick="choose('gg')" 
					>Univers</div>
					<div class="allonglet" 
					id="ongletg"
					onmouseover="this.style.backgroundColor='rgba(211,211,211,0.5)';"
					onmouseout="this.style.backgroundColor='transparent';"
					onclick="choose('g')" 
					>Vampires</div>
					<div class="allonglet" 
					id="ongletd"
					onmouseover="this.style.backgroundColor='rgba(211,211,211,0.5)';"
					onmouseout="this.style.backgroundColor='transparent';"
					onclick="choose('d')" 
					>Traditions</div>
					<div class="allonglet" 
					id="ongletdd"
					onmouseover="this.style.backgroundColor='rgba(211,211,211,0.5)';"
					onmouseout="this.style.backgroundColor='transparent';"
					onclick="choose('dd')" 
					>Vous</div>
			
				</div>


				<div id="infosAccueil">
				</div>

			</div>

		</section>

	<!--FOOTER-->
		<?php include("shared/view/footer.php");
		?>

	</div>

<script type="text/javascript" src="js/accueil.js"></script>
</body>
</html> 	