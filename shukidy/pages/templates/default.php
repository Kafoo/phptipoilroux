<?php
include(__DIR__."/../../_shared_/start.php");
/*include(__DIR__."/../../submits/tapage_submit.php");*/
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../style/_shared_/main.css?v=6">
	<link rel="stylesheet" type="text/css" href="../style/_shared_/popups.css">
	<link rel="stylesheet" type="text/css" href="../style/_shared_/elements.css">
	<link rel="stylesheet" type="text/css" href="../style/_shared_/behaviors.css">
	<link rel="stylesheet" type="text/css" href="../style/_shared_/tooltips.css">
	<link rel="stylesheet" type="text/css" href="../style/_shared_/pager.css">
	<link rel="stylesheet" type="text/css" href="../style/_shared_/loading.css">
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