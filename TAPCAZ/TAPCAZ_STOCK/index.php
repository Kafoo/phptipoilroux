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

// ON RENTRE LE NOUVEAU SCORE DANS LA BDD

$bdd = new mysqli("127.0.0.1","root","lqsym","kfu_corp");
if (isset($_POST['pseudo'])){
	$pseudo = $_POST['pseudo'];
	$grille = $_SESSION['grille'];
	$score = $_POST['score'];
	$bdd->query("INSERT INTO tapcaz_scores (pseudo, grille, score) VALUES ('$pseudo','$grille','$score')");
}


?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css/style.css">
<title>Résultats TAPCAZ</title>


</head>
<body>
	<header>
		<div class="container">
			<div id="branding">
				<h1>Kfu Corp<img src="img/smiley.png" width="30px"></h1>
			</div>
			<nav>
				<ul>
					<li><a href="./HOME.design">HOME</a></li>
					<li><a href="../TAPCAZ_HOME" class="current">TAPCAZ</a></li>
					<li><a href="../../BLAGUES/ACCUEIL">BLAGUES</a></li>
					<li><a href="">BUTTON TESTS</a></li>
				</ul>
			</nav>
		</div>
	</header>

	<section class="scoreSection">

	<?php
	$I=2;
	while ($I <= 10) {
		//MAIN BLOCK
		if ($I==4){
			echo "
			<div class=\"mainContainer\" id=\"title\">
			<h2>TAPCAZ</h2>
			<h2>HIGHSCORES</h2>
			<div id='mainText'>Blabla ! <br/>Blablablablablabla blabalbla blablablablabla blablabla.<br/></div>
			<form method='POST' action='../TAPCAZ_HOME'>
				<input type='submit' name='submit' value='Rejouer !'>
			</form>
			</div>
			";}
		//CHANGEMENT DE LIGNE
		if ($I==6){
			echo "
			</section>
			<section class=\"scoreSection\">
			";}

		//BLOCKS CLASSIQUES
		echo "
		<div class=\"scoreContainer\" id=\"x".$I."\">
			<table>
				<tr class=\"ttitle\">
					<th colspan=\"3\">GRILLE ".$I."X".$I."</th>
				</tr>
				<tr class=\"thead\">
					<td class=\"pseudo\">Pseudo
					</td>
					<td class=\"score\">Score
					</td>
					<td class=\"pos\">Pos.
					</td>
				</tr>
		";
		$hs = $bdd->query("SELECT * FROM tapcaz_scores WHERE grille='$I' ORDER BY score");
		$i=1;
		while ($i<=5) {
			//CAS PARTICULIER POUR LE 1ER
			if ($resultatHS2 = $hs->fetch_assoc() AND $i==1){
				echo "
				<tr class=\"pos1\">
					<td class=\"pseudo\">".$resultatHS2['pseudo']."</td>
					<td class=\"score\">".$resultatHS2['score']."</td>
					<td class=\"pos\">1er</td>
				</tr>
				";}
			//POUR TOUS LES AUTRES
			elseif ($resultatHS2 = $hs->fetch_assoc()){
				echo "
				<tr class=\"pos".$i."\">
					<td class=\"pseudo\">".$resultatHS2['pseudo']."</td>
					<td class=\"score\">".$resultatHS2['score']."</td>
					<td class=\"pos\">".$i."e</td>
				</tr>
				";}
			//ENTREES VIDES SI PAS ASSEZ DE SCORES
			else{
				echo "
				<tr class=\"pos".$i."\">
					<td class=\"pseudo\">---</td>
					<td class=\"score\">---</td>
					<td class=\"pos\">".$i."e</td>
				</tr>
				";}
			$i++;
		}
		echo "</table></div>";
		$I++;
	}
	?>

	</section>





		<script type="text/javascript" src="script/script.js"></script>
</body>
</html>