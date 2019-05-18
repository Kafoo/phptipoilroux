<?php
include("_shared_/start.php");
include("_shared_/functions.php");
/*include("submits/tapage_submit.php");*/
?>

<!DOCTYPE html>
<html>
<head>
	<?php include("_shared_/headconfig.php"); ?>
	<link rel="stylesheet" type="text/css" href="style/help.css">
	<title>Vampire - Aventures</title>
</head>
<body>

<?php include('_shared_/header.php') ?>


<!-- -------- CONTENU -------- -->
<section>

	<?php //IF USER IS DISCONNECTED
	if (!isset($_SESSION['connected'])) { ?>

		<h1>HELP</h1>

		<div class="paco">
			[Descriptif]
		</div>


	<?php //endif disconnected user


	}else{ //IF CONNECTED USER ?>
		<h1>HELP</h1>

		<div class="container">
			
		</div>

		<div class="container">
			
		</div>

	<?php //endif connected user
	} ?>

</section>

<?php include("_shared_/scripts.php"); ?>
<script type="text/javascript" src="js/help.js"></script>

</body>
</html>