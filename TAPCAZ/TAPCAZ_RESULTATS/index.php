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


//LOG_INITIALISATION

$log= fopen("fichier.txt", "a+");

fwrite($log, "------------\r\nPage ouverte à ".(int)(getdate()['hours']+2).":".getdate()['minutes'].":".getdate()['seconds']."\r\n");

// ON RENTRE LE NOUVEAU SCORE DANS LA BDD
$bdd = new mysqli("eu-cdbr-west-02.cleardb.net","b2e27d049f1274","0ffbbb07","heroku_3ca6f2b572bf369");
if (isset($_POST['pseudo'])){
	$pseudo = $_POST['pseudo'];
	fwrite($log, "Pseudo : ".$pseudo."\r\n");
}
if (isset($_SESSION['grille'])){
	$grille = $_SESSION['grille'];
	fwrite($log, "Grille : ".$grille."\r\n");
}
if (isset($_POST['score'])){
	$score = $_POST['score'];
	fwrite($log, "Score : ".$score."\r\n");
}

if (isset($_POST['score']) AND isset($_POST['score']) AND isset($_POST['score'])){
	$bdd->query("INSERT INTO tapcaz_scores (pseudo, grille, score) VALUES ('$pseudo','$grille','$score')");
	fwrite($log, "Nouvelle entrée réussie !"."\r\n");
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
					<li><a href="../../INPROGRESS">HOME</a></li>
					<li><a href="../TAPCAZ_HOME" class="current">TAPCAZ</a></li>
					<li><a href="../../INPROGRESS">SOON1</a></li>
					<li><a href="../../INPROGRESS">SOON2</a></li>
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
			if (isset($_POST['pseudo'])){
				echo "
				<div class=\"scoreContainer\" id=\"mainPlayed\">
				<h2>TAPCAZ</h2>
				<h2>HIGHSCORES</h2>
				<div id='mainText'>Bien joué ! <br/>Si ton nom ne s'affiche nul part, c'est qu'il faut retenter le coup...;-)<br/></div>
				<form method='POST' action='../TAPCAZ_HOME'>
					<img src='img/gauche.gif'/><input type='submit' name='submit' value='Rejouer !'><img src='img/droite.gif'/>
				</form>
				</div>
				";
			}
			else{
				echo "
				<div class=\"scoreContainer\" id=\"mainUnplayed\">
				<h2>TAPCAZ</h2>
				<h2>HIGHSCORES</h2>
				<div id='mainText'>Hello ! <br/>Voilà les plus gros scores de TAPCAZ. Tente le coup pour que ton pseudo s'y affiche =)<br/></div>
				<form method='POST' action='../TAPCAZ_HOME'>
					<img src='img/gauche.gif'/><input type='submit' name='submit' value='Jouer'><img src='img/droite.gif'/>
				</form>
				</div>
				";
			}
		}

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
		$hs = $bdd->query("SELECT * FROM tapcaz_scores WHERE grille='$I' ORDER BY score DESC");
		$i=1;
		while ($i<=5) {
			//CAS PARTICULIER POUR LE 1ER
			if ($i==1){
				if ($resultatHS2 = $hs->fetch_assoc()){
					echo "
					<tr class=\"pos1\">
						<td class=\"pseudo\"><img id='confetti' src='img/etoile.png'> ".$resultatHS2['pseudo']." <img id='confetti' src='img/etoile.png'></td>
						<td class=\"score\">".$resultatHS2['score']."</td>
						<td class=\"pos\">1er</td>
					</tr>
					";}
				else{
					echo "
					<tr class=\"pos".$i."\">
						<td class=\"pseudo\">---</td>
						<td class=\"score\">---</td>
						<td class=\"pos\">".$i."er</td>
					</tr>
					";}
			}
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