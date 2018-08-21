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
			<h1>CONFIRM CREA PERSO</h1>
			_______________
			<br/>
			<br/>

			<?php 


			if (isset($_POST['persoNom'])) {


				$persoNom = $_POST['persoNom'];
				$persoNature = $_POST['persoNature'];
				$persoAttitude = $_POST['persoAttitude'];
				$persoConcept = $_POST['persoConcept'];
				$persoDefaut = $_POST['persoDefaut'];
				$persoPhysique = $_POST['persoPhysique'];
				$persoClan = $_POST['persoClan'];
				$persoForce = $_POST['persoForce'];
				$persoDexterite = $_POST['persoDexterite'];
				$persoIntelligence = $_POST['persoIntelligence'];
				$persoCharisme = $_POST['persoCharisme'];
				$persoPerception = $_POST['persoPerception'];
				$persoDisc = $_POST['persoDisc'];
				$persoLore = $_POST['persoLore'];



				echo
				$persoNom."<br>".
				$persoNature."<br>".
				$persoAttitude."<br>".
				$persoConcept."<br>".
				$persoDefaut."<br>".
				$persoPhysique."<br>".
				$persoClan."<br>".
				$persoForce."<br>".
				$persoDexterite."<br>".
				$persoIntelligence."<br>".
				$persoCharisme."<br>".
				$persoPerception."<br>".
				$persoDisc."<br>".
				$persoLore."<br>"
				;

				include("shared/connectDB.php");

				$bdd -> query ("INSERT INTO ss_persos (membreID, nom, nature, attitude, concept, defaut, physique, clan, forc, dexterite, intelligence, charisme, perception, lore) VALUES ('4','$persoNom','$persoNature','$persoAttitude','$persoConcept','$persoDefaut','$persoPhysique','$persoClan','$persoForce','$persoDexterite','$persoIntelligence','$persoCharisme','$persoPerception','$persoLore')" );


			}


			if (isset($errorCrea)) {
				echo "$errorCrea";
			}

			?>


		</section>

	<!--FOOTER-->
		<?php include("shared/view/footer.php") ?>

	</div>



</body>
</html> 