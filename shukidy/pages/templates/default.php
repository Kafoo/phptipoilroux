<?php
include(__DIR__."/../../_shared_/start.php");
/*include(__DIR__."/../../submits/tapage_submit.php");*/
?>

<!DOCTYPE html>
<html>
<head>
 	<?php include(__DIR__."/../../_shared_/headconfig.php"); ?>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
	<title>Shukidy</title>
</head>
<body>

<?php 
include(__DIR__.'/../../_shared_/header.php');
?>


<!-- -------- CONTENU -------- -->
<section>

<?=$content?>
<?php
	
	var_dump(__DIR__);

?>

</section>

<?php /*include(__DIR__."/../../_shared_/scripts.php");*/ ?>
<!-- <script type="text/javascript" src=__DIR__."/../../js/accueil.js"></script> -->

</body>
</html>