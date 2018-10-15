<!DOCTYPE html>
<html>
<head>
	<?php include("config/headconfig.php"); ?>
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


			<div id="gridAv">


				<!-- MESSAGE GM -->
				<div class="writerInfoSlider">
					<div class="writerInfo" style="background-image: url(img/avatars/test.jpg);">
						<div class="layer">
							Blabloup<br>Blabloup<br>Blabloup<br>
						</div>
					</div>
				</div>	

				<div class="msg msgGM">
					LOREM IPSUM<br><br>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</div>

				<div class="fixInfo">
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip.
				</div>

				<!-- MESSAGE 2 -->
				<div class="writerInfoSlider">
					<div class="writerInfo" style="background-image: url(img/avatars/test.jpg);">
						<div class="layer">
							Blabloup<br>Blabloup<br>Blabloup<br>
						</div>
					</div>
				</div>	

				<div class="msg">
					LOREM IPSUM<br><br>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</div>

				<div class="fixSpace"></div>

				<!-- MESSAGE 3 -->
				<div class="writerInfoSlider">
					<div class="writerInfo" style="background-image: url(img/avatars/test.jpg);">
						<div class="layer">
							Blabloup<br>Blabloup<br>Blabloup<br>
						</div>
					</div>
				</div>	

				<div class="msg">
					LOREM IPSUM<br><br>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</div>

				<div class="fixSpace"></div>

			</div>




	<?php //ENDIF AVENTURE PRÉCISÉE
	} ?>



	<div class="container">
		
	</div>

	<div class="container">
		
	</div>

</section>

<?php include("config/scripts.php"); ?>

</body>
</html>