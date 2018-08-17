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
	<link rel="stylesheet" type="text/css" href="css/histoire.css">
	<title>SANS SOUCI</title>
</head>
<body>

	<div class="mainGrid">

	<!--HEADER-->
		<?php include("shared/view/header.php") ?>

	<!--SECTION-->
		<section id="sectionGrid">
			<div class="mobileInfo" hidden></div>
			<div class="msgInfo"></div>
			<div class="msg">Coucou c'est moi le first content</div>
			<div class="userInfo"></div>
		</section>



	<!--FOOTER-->
		<?php include("shared/view/footer.php") ?>

	</div>



</body>
</html> 