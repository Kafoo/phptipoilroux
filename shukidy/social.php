<?php
include("_shared_/start.php");
/*include("submits/tapage_submit.php");*/
?>

<!DOCTYPE html>
<html>
<head>
	<?php include("_shared_/headconfig.php"); ?>
	<link rel="stylesheet" type="text/css" href="style/social.css">
	<title>Shukidy - Social</title>
</head>
<body>

<?php include('_shared_/header.php') ?>


<!-- -------- CONTENU -------- -->
<section>

	<?php //IF USER IS DISCONNECTED
	if (!isset($_SESSION['connected'])) { ?>

		<h1>SOCIAL</h1>

		<div class="paco">
			Il faut te connecter pour accéder à cette page !
		</div>


	<?php //endif disconnected user


	}else{ //IF CONNECTED USER ?>


		<h1>SOCIAL</h1>

		<div class="container">
			
		</div>

		<div class="container">
			
		</div>

	<?php //endif connected user
	} ?>

</section>

<?php include("_shared_/scripts.php"); ?>
<script type="text/javascript" src="js/social.js"></script>

</body>
</html>