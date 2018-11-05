<?php

include("_shared_/start.php");
include("_shared_/functions.php");
/*include("submits/tapage_submit.php");*/
?>

<!DOCTYPE html>
<html>
<head>
	<?php include("_shared_/headconfig.php"); ?>

	<script src='https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=fqt2ki9s4j252fq1ttq1lqvmkpegi0vltirbxqsvjvezla8g'></script>
	<link rel="stylesheet" type="text/css" href="style/pouf.css">
	<title>Vampire - Ta Page</title>

</head>
<body>

<?php include('_shared_/header.php') ?>


<!---------- CONTENU ---------->
<section>

	<h1>TITRE</h1>

	<div class="container">

		<div id="mceMainContainer">			
			<textarea id="mytextarea"></textarea>
		</div>


	</div>


</section>

<?php include("_shared_/scripts.php"); ?>

<!-- <script src="node_modules/trumbowyg/dist/trumbowyg.js"></script> -->
<script type="text/javascript" src="js/pouf.js"></script>

</body>
</html>