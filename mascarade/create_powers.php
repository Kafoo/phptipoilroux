<?php
include("_shared_/start.php");
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

<?php
$avID = 35;
//On récupère les différentes natures de l'univers
$req = $bdd->query("
	SELECT nat.id, nat.name, nat.type
	FROM natures as nat
	LEFT JOIN rel_univ2natures as u2n
	ON nat.id = u2n.natureID
	LEFT JOIN mas_aventures as av
	ON u2n.univID = av.univID
	WHERE av.id = 35
	");
$natures = $req->fetchall();
?>

<div class="titre">QUI ES-TU ?</div>


<div class="ventreBox">
	<div class="raceBox">
		<div class="selectBox">
			<h4>Ta race :</h4>
			<select class="selectNature" natureType="race" natureID="">
				<?php
				foreach ($natures as $nature) {
					if ($nature['type'] == 'race') { ?>
						<option value="<?=$nature['id']?>"><?=$nature['name']?></option>
					<?php
					}
				} ?>
			</select>
		</div>
		<div class="descriptionBox">					
			<div class="raceDescription"></div>
		</div>
	</div>
	<div class="capaBox">
		<div class="selectBox">
			<h4>Ta première capacité :</h4>
			<select class="selectPower selectCapacite">
			</select>
		</div>
		<div class="descriptionBox">
			<div class="capaciteDescription-container"></div>
		</div>		
	</div>

</div>
<div class="ventreBox">
	<div class="classeBox">
		<div class="selectBox">
			<h4>Ta classe :</h4>
			<select class="selectNature" natureType="classe" natureID="">
				<?php
				foreach ($natures as $nature) {
					if ($nature['type'] == 'classe') { ?>
						<option value="<?=$nature['id']?>"><?=$nature['name']?></option>
					<?php
					}
				} ?>
			</select>
		</div>				
		<div class="descriptionBox">				
			<div class="classeDescription"></div>
		</div>
	</div>

	<div class="disciplineBox">
		<div class="selectBox">
			<h4>Ta première discipline :</h4>
			<select class="selectPower selectDiscipline">
			</select>
		</div>				
		<div class="descriptionBox">
			<div class="disciplineDescription-container"></div>
		</div>
	</div>
</div>







</section>

<?php include("_shared_/scripts.php"); ?>
<script type="text/javascript" src="js/tapage.js"></script>

</body>
</html>
