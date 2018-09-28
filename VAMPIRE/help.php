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
	<link rel="stylesheet" type="text/css" href="css/help.css">
	<!-- 	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
	<script src="shared/jquery"></script>
	<title>VAMPIRE - Help</title>
</head>
<body>

	<div class="mainGrid">

	<!--HEADER-->
		<?php include("shared/view/header.php") ?>

	<!--SECTION-->
		<section class="sectionGrid">
			<h1>HELP</h1>



			<div id="helpContainer">
					
					<div class="helpBox">

						LEXIQUE

					</div>


					<div class="helpBox">

						RECHERCHE

					</div>

					<div class="helpBox">

						CONVERSATION PRIVEE AVEC LE GM

					</div>


					<div class="helpBox">

						PLUS D'INFOS SUR L'UNIVERS

					</div>






		</section>

	<!--FOOTER-->
		<?php include("shared/view/footer.php") ?>

	</div>


<script type="text/javascript" src="js/help.js"></script>
</body>
</html> 