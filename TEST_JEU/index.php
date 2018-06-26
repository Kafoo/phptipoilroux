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
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title>Test Mini Jeu</title>
</head>
<body>
	<form method="POST" action="">
		<label>Jouer sur une grille de combien de carrés par côté ?</label><br/>
		<label id="petit">Note : au-delà de 20, le jeu peut mal s'afficher ;-)</label>
		<br/>
		>>>>  <input type="text" name="nombreCases" placeholder="cases/côté ?">  <<<<
	</form>
	<br/>
	<br/>

	<table>
		<?php
		if (!isset($_POST['nombreCases']) OR empty($_POST['nombreCases']) AND (int)$_POST['nombreCases']!==0){
			echo "<th id=\"emptyTable\">?</th>";
		}

		//ON VERIFIE QUE L'INPUT EST BIEN UN NOMBRE ENTIER > 1 POUR GENERER LE TABLEAU :
		if (isset($_POST['nombreCases']) AND !empty($_POST['nombreCases']) AND (int)$_POST['nombreCases']==$_POST['nombreCases'] AND (int)$_POST['nombreCases']>1)
		{
			$nombreCases=$_POST['nombreCases'];
			$tailleCase=400/$nombreCases;
			for ($i=1; $i <$nombreCases*$nombreCases+1 ; $i++) 
			{ 
				if ($i==round($nombreCases*$nombreCases/2) AND $nombreCases%2!==0){
					echo "<td id=\"case".$i."\" width=\"".$tailleCase."px\" height=\"".$tailleCase."px\"><button hidden onclick=\"clickCase()\" id=\"bouton\"></button></td>";
				}
				elseif ($i==round($nombreCases*$nombreCases/2-$nombreCases/2) AND $nombreCases%2==0){
					echo "<td id=\"case".$i."\" width=\"".$tailleCase."px\" height=\"".$tailleCase."px\"><button hidden onclick=\"clickCase()\" id=\"bouton\"></button></td>";
				}
				else{
					echo "<td id=\"case".$i."\" width=\"".$tailleCase."px\" height=\"".$tailleCase."px\"></td>";
				}
				if ($i%$nombreCases==0){echo "<tr></tr>";}
			}
			$displayStart=True;
		}

		//SINON, DIFFERENTS MESSAGES D'ERREUR EN FONCTION DES SITUATIONS :
		elseif (isset($_POST['nombreCases']) AND (int)$_POST['nombreCases']==$_POST['nombreCases'] AND ($_POST['nombreCases']=="1" OR $_POST['nombreCases']=="0")){
			echo "<th id=\"emptyTable\">Tricheur =P</th>";
		}
		elseif (isset($_POST['nombreCases']) AND !empty($_POST['nombreCases']) AND (int)$_POST['nombreCases']==$_POST['nombreCases'] AND (int)$_POST['nombreCases']<0){
			echo "<th id=\"emptyTable\">Essaye pas de m'avoir, petit malin, rentre un nombre positif =P</th>";
		}
		elseif (isset($_POST['nombreCases']) AND !empty($_POST['nombreCases'])){
			echo "<th id=\"emptyTable\">C'est pas un nombre, ça ;-)</th>";
		}
		?>
	</table>
	<br/>
	<span id="start">
		<?php
		if (isset($displayStart)){
			echo "<button id=\"boutonChrono\" onclick=\"startChrono()\">Commencer !</button>";
		}
		?>
	</span>
	<br/>
	<div id="blockTimer"><span>Timer : </span><span id="timer">0</span></div>
	<br/>
	<p hidden id="stockCases"><?php if (isset($nombreCases)) {echo $nombreCases*$nombreCases;}?></p>
	<p hidden id="stockRandom">0</p>
	<span>Score : </span><span id="stockScore">0</span>
	<div id="monId"></div>

	<script type="text/javascript" src="js.js"></script>
</body>
</html>