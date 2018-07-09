<?php

// Inutile d'expliquer la présence du session_start().
session_start();

// { Début - Première partie
if(!empty($_POST) OR !empty($_FILES))
{
    $_SESSION['sauvegarde'] = $_POST ;
    $_SESSION['sauvegardeFILES'] = $_FILES ;
    
    $fichierActuel = $_SERVER['PHP_SELF'] ;
    if(!empty($_SERVER['QUERY_STRING']))
    {
        $fichierActuel .= '?' . $_SERVER['QUERY_STRING'] ; 
    }
    
    header('Location: ' . $fichierActuel);
    exit;
}
// } Fin - Première partie

// { Début - Seconde partie
if(isset($_SESSION['sauvegarde']))
{
    $_POST = $_SESSION['sauvegarde'] ;
    $_FILES = $_SESSION['sauvegardeFILES'] ;
    
    unset($_SESSION['sauvegarde'], $_SESSION['sauvegardeFILES']);
}
// } Fin - Seconde partie

?>

<!DOCTYPE html>
<html>
<head>
	<title>Test MySQL</title>
</head>
<body>


<form method="POST" action="">
	<input type="text" name="pseudo" placeholder="pseudo">
	<input type="text" name="grille" placeholder="grille">
	<input type="text" name="score" placeholder="score">
	<input type="submit" name="submit">
</form>

<?php


$bdd = new mysqli("127.0.0.1","root", "lqsym", "kfu_corp");

if (isset($_POST['pseudo'])){
	$pseudo = $_POST['pseudo'];
	$grille = $_POST['grille'];
	$score = $_POST['score'];
	$bdd->query("INSERT INTO tapcaz_scores (pseudo, grille, score) VALUES ('$pseudo','$grille','$score')");
}



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

</body>
</html>