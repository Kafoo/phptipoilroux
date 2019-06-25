<?php
include("_shared_/start.php");
include("_shared_/functions.php");
/*include("submits/tapage_submit.php");*/
?>

<!DOCTYPE html>
<html>
<head>
	<?php include("_shared_/headconfig.php"); ?>
	<title>Vampire - Home</title>
</head>
<body>

<?php include('_shared_/header.php') ?>


<!-- -------- CONTENU -------- -->
<section>

	<h1>ACCUEIL</h1>

	<div class="container centering">

		Mmh, ouais, alors ça c'est l'accueil<br>
		Ok c'est pas très sexy pour le moment<br>
		Mais promis je mets des trucs bientôt ^_^<br><br>
		Des poutous

	</div>

	<div class="container centering">
	</div>

<?php

		$dat = getRealDate();
		$avID = 25;

		//On check si le dernier post date d'il y a moins de 12h
		$req = $bdd->query("
			SELECT dat
			FROM mas_messages_aventure
			WHERE avID='$avID'
			ORDER BY id DESC
			");
		$lastPostDat = $req->fetch()[0];

		$exDat_current = explode('--', $dat);
		$exDat_old = explode('--', $lastPostDat);
		$day_current = new DateTime(str_replace('/', '-', $exDat_current[0]));
		$day_old = new DateTime(str_replace('/', '-', $exDat_old[0]));
		$day_interval = $day_current->diff($day_old);
		$mail_frequency = 12;
		$hour_current = explode(':', $exDat_current[1])[0];
		$hour_old = explode(':', $exDat_old[1])[0];

		if ($day_interval->days > 0) {
			//MAIL
		}elseif ($hour_current > $hour_old + $mail_frequency) {
			//MAIL
		}
?>



	<div class="container">
		
	</div>

</section>

<?php include("_shared_/scripts.php"); ?>
<script type="text/javascript" src="js/accueil.js"></script>

</body>
</html>