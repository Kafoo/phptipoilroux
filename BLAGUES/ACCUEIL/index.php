<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="css/style.css">
		<meta charset="utf-8">
	</head>

	<body>

		<h1>
			Coucou !
			
			<br/>Raconte moi une blague de merde...
		</h1>

		<form method="POST" action="..\RESULTATS\index.php">

			<p class="formu">

			<label for="newblague" id="tablague">Ta pire blague :</label>
			<br/>
			<img src="img/gauche.gif"/><textarea name="newblague" class="newblague"></textarea><img src="img/droite.gif"/>
			<br/><input id="submit" type="submit" value="Propose ta blague toute pourrie et note celles des autres !"/>
			<br/>

			</p>

		</form>

		<img src="img/minion.gif" height="150px" width="150px"/>

		<script src="js/javascriptsamere.js"></script>
	</body>

</html>