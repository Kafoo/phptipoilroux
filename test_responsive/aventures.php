<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="style/main.css">
	<link rel="stylesheet" type="text/css" href="style/aventures.css">
	<title>Vampire - Aventures</title>
</head>
<body>

<?php include('view/header.php') ?>


<!-- -------- CONTENU -------- -->
<section>


	<?php //SI PAS D'AVENTURE PRÉCISÉE
	if (!isset($_GET['avID']) OR empty($_GET['avID'])) { ?>

		<h1>AVENTURES</h1>

		<div class="container">
			<div class="choixAv">

				<span>
					OEIL POUR OEIL...
				</span>
				<a class="goAv" href="aventures.php?avID=1">
					Rejoindre l'aventure !
				</a>

			</div>
		</div>		

	<?php //ENDIF PAS D'AVENTURE PRÉCISÉE



	}else{ //SI AVENTURE PRÉCISÉE ?>

		<h2>OEIL POUR OEIL</h2>

		<div class="fixInfo">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip </div>

		<div class="container">
			
			<div id="gridAv">

				<div class="writerInfo" style="background-image: url(img/avatars/test.jpg);">
					<div class="layer">
						Blabloup
					</div>
				</div>

				<div class="msg">
					
				</div>

				<div class="fixSpace"></div>

			</div>

		</div>



	<?php //ENDIF AVENTURE PRÉCISÉE
	} ?>



	<div class="container">
		
	</div>

	<div class="container">
		
	</div>

</section>


</body>
</html>