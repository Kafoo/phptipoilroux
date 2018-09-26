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
	<link rel="stylesheet" type="text/css" href="css/accueil.css">
<!-- 	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
	<script src="shared/jquery"></script>
	<title>SANS SOUCI</title>
</head>
<body>

	<div class="mainGrid">

	<!--HEADER-->
		<?php include("shared/view/header.php") ?>

	<!--SECTION-->
		<section class="sectionGrid">

			<div id="bienvenue">

				<div id="ongletBlock">

					<div class="allonglet" 
					id="ongletgg"
					onmouseover="this.style.backgroundColor='rgba(211,211,211,0.5)';"
					onmouseout="this.style.backgroundColor='transparent';"
					onclick="choose('gg')" 
					>Le Jyhad</div>
					<div class="allonglet" 
					id="ongletg"
					onmouseover="this.style.backgroundColor='rgba(211,211,211,0.5)';"
					onmouseout="this.style.backgroundColor='transparent';"
					onclick="choose('g')" 
					>Les vampires</div>
					<div class="allonglet currentOnglet" 
					id="ongletc"
					onmouseover="this.style.backgroundColor='rgba(211,211,211,0.5)';"
					onmouseout="this.style.backgroundColor='transparent';"
					onclick="choose('c')"
					>L'univers</div>
					<div class="allonglet" 
					id="ongletd"
					onmouseover="this.style.backgroundColor='rgba(211,211,211,0.5)';"
					onmouseout="this.style.backgroundColor='transparent';"
					onclick="choose('d')" 
					>La géhenne</div>
					<div class="allonglet" 
					id="ongletdd"
					onmouseover="this.style.backgroundColor='rgba(211,211,211,0.5)';"
					onmouseout="this.style.backgroundColor='transparent';"
					onclick="choose('dd')" 
					>Vous</div>
			
				</div>


				<div id="infosAccueil">
					Univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers 
				</div>

			</div>

		</section>

	<!--FOOTER-->
		<?php include("shared/view/footer.php") ?>

	</div>

<script type="text/javascript" src="js/accueil.js"></script>
</body>
</html> 