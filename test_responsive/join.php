<?php
include("_shared_/start.php");
include("_shared_/functions.php");
/*include("submits/tapage_submit.php");*/
?>

<!DOCTYPE html>
<html>
<head>
	<?php include("_shared_/headconfig.php"); ?>
	<link rel="stylesheet" type="text/css" href="style/tapage.css">
	<title>Vampire - Ta Page</title>
</head>
<body>

<?php include('_shared_/header.php') ?>


<!---------- CONTENU ---------->
<section>

	<h1>TITRE</h1>

	<div class="container">

		<?php
		$req = $bdd->query("SELECT persoID FROM ss_relation_perso2aventure WHERE aventureID = 52 ")->fetchall(PDO::FETCH_COLUMN); 

		var_dump($req);
		?>		
	</div>

</section>

<?php include("_shared_/scripts.php"); ?>
<script type="text/javascript" src="js/tapage.js"></script>

</body>
</html>