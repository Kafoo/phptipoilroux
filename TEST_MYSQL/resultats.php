<!DOCTYPE html>
<html>
<head>
	<title>resultat test</title>
</head>
<body>

<?php


$bdd = new mysqli("127.0.0.1","root", "", "kfu_corp");



$requete = $bdd->query('SELECT * FROM tapcaz_scores ORDER BY score');

?>

<table border="1">
	<tr><td>Pseudo</td><td>Grille</td><td>Score</td></tr>
	<?php


	while ($resultat = $requete->fetch_assoc()) {
		echo "<tr><td>" . $resultat['pseudo'] . "</td><td>" . $resultat['grille'] . "</td><td>" . $resultat['score'] . "</td></tr>";
	}



	?>

</table>


<a href="index.php">Retour</a>


</body>
</html>