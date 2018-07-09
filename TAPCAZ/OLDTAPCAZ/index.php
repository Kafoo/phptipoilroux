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
	<title>TAPCAZ</title>
</head>
<body>
	<h1 id="titre">
		TAPCAZ
	</h1>


	<div id="blockGen">
		<!--CHOIX DE LA TAILLE-->
		<form method="POST" name="form" action="" onsubmit="return checkForm()">
			<label>Change la taille<br/>de ta grille !</label>
			<br/>
			<input type="text" name="nombreCases" placeholder="cases/côté"/>
		</form>

		<!--TIMER ET SCORE-->
		<div id="blockTimer">
			<span id="spTimer">Timer</span>
			<br/><span id="timer">0</span>
		</div>
		<div id="blockScore">
			<span id="spScore">Score</span>
			<br/><span id="score">0</span>
		</div>

		<!--BOUTON START-->
		<?php
		if (isset($canStart)){
			echo "<button id=\"boutonStart\" onclick=\"startChrono()\">Start !</button>";
		}
		?>

	</div>



	<table>
		<?php
		if (!isset($_POST['nombreCases']) || isset($_POST['nombreCases']) && $_POST['nombreCases']==""){
			echo "<th id=\"emptyTable\"><span id=\"grosPoint\">?</span></th>";
		}


		//ON VERIFIE QUE L'INPUT EST BIEN UN NOMBRE ENTIER > 1 POUR GENERER LE TABLEAU :
		if (isset($_POST['nombreCases']) AND !empty($_POST['nombreCases']) AND (int)$_POST['nombreCases']==$_POST['nombreCases'] AND (int)$_POST['nombreCases']>1)
		{
			$nombreCases=$_POST['nombreCases'];
			$tailleCase=600/$nombreCases-0.22*$nombreCases;
			echo "<tr>";
			for ($i=1; $i <$nombreCases*$nombreCases+1 ; $i++) 
			{ 
				//Place le premier bouton pour un nombreCases impair
				if ($i==round($nombreCases*$nombreCases/2) AND $nombreCases%2!==0){
					echo "<td id=\"case".$i."\" width=\"".$tailleCase."px\" height=\"".$tailleCase."px\"><button hidden onclick=\"clickCase()\" id=\"boutonCase\"></button></td>";
				}
				//Place le premier bouton pour un nombreCases pair
				elseif ($i==round($nombreCases*$nombreCases/2-$nombreCases/2) AND $nombreCases%2==0){
					echo "<td id=\"case".$i."\" width=\"".$tailleCase."px\" height=\"".$tailleCase."px\"><button hidden onclick=\"clickCase()\" id=\"boutonCase\"></button></td>";
				}
				//Case vide
				else{
					echo "<td id=\"case".$i."\" width=\"".$tailleCase."px\" height=\"".$tailleCase."px\"></td>";
				}
				//Changement de row
				if ($i%$nombreCases==0){echo "<tr></tr>";}
			}
			echo "</tr>";
			$canStart=True;
		}

		//SI INPUT PAS BON, DIFFERENTS MESSAGES D'ERREUR EN FONCTION DES SITUATIONS :
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

	<div id="blockStart">
		<?php
		if (isset($canStart)){
			echo "<button id=\"boutonStart\" onclick=\"startChrono()\">Start !</button>";
		}
		?>
	</div>



	<!--ON STOCK CE QU'IL FAUT POUR LE JAVASCRIPT-->
	<p hidden id="stockCases"><?php if (isset($nombreCases)) {echo $nombreCases*$nombreCases;}?></p>
	<!--Défini un premier random égal à la position du premier bouton-->
	<p hidden id="stockRandom">
		<?php
		if (isset($canStart) AND $nombreCases%2!==0){
			echo round($nombreCases*$nombreCases/2);}
		elseif (isset($canStart) AND $nombreCases%2==0){
			echo $nombreCases*$nombreCases/2-$nombreCases/2;}
		?>
	</p>

	<script type="text/javascript" src="js.js"></script>
</body>
</html>