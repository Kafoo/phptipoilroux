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
<title>Test Responsive Sommaire</title>
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
					<li><a href="" class="current">TAPCAZ</a></li>
					<li><a href="../../INPROGRESS">SOON1</a></li>
					<li><a href="../../INPROGRESS">SOON2</a></li>
				</ul>
			</nav>
		</div>
	</header>
	

	<section id="main">
<!--LEFT BLOCK-->
		<div id="leftBlock">
			<div id="tailleBlock">
				<form id="changeTaille" method="POST" name="changetaille" action="" onsubmit="return checkForm()">
					<label>Change la taille<br/>de ta grille !</label>
					<br/>
					<input type="text" name="nombreCases" placeholder="cases/côté"/>
				</form>
			</div>
			<div id="timerBlock">
				<span class="compteurs">Timer</span><br/><span id="timer">0</span>
			</div>
		</div>

<!--MAIN BLOCK-->
		<div id="mainBlock">
			<table id='table'>
				<?php
				if (!isset($_POST['nombreCases']) || isset($_POST['nombreCases']) && $_POST['nombreCases']==""){
					echo "<th id=\"emptyTable\"><img id=\"logo\" src=\"img/logoTapcaz.png\"></th>";
				}


				//ON VERIFIE QUE L'INPUT EST BIEN UN NOMBRE ENTIER ENTRE 2 ET 10 POUR GENERER LE TABLEAU :
				if (isset($_POST['nombreCases']) AND !empty($_POST['nombreCases']) AND (int)$_POST['nombreCases']==$_POST['nombreCases'] AND (int)$_POST['nombreCases']>1 AND (int)$_POST['nombreCases']<11)
				{
					$nombreCases=$_POST['nombreCases'];
					echo "<tr>";
					for ($i=1; $i <$nombreCases*$nombreCases+1 ; $i++) 
					{ 
						//Place le premier bouton pour un nombreCases impair
						if ($i==round($nombreCases*$nombreCases/2) AND $nombreCases%2!==0){
							echo "<td id=\"case".$i."\" ><button hidden onclick=\"clickCase()\" id=\"boutonCase\"></button></td>";
						}
						//Place le premier bouton pour un nombreCases pair
						elseif ($i==round($nombreCases*$nombreCases/2-$nombreCases/2) AND $nombreCases%2==0){
							echo "<td id=\"case".$i."\" ><button hidden onclick=\"clickCase()\" id=\"boutonCase\"></button></td>";
						}
						//Case vide
						else{
							echo "<td id=\"case".$i."\" width=\"". 100/$nombreCases."%\" height=\"". 100/$nombreCases."%\"></td>";
						}
						//Changement de row
						if ($i%$nombreCases==0){echo "</tr>";}
					}
					echo "</tr>";
					$canStart=True;
				}

				//SI INPUT PAS BON, DIFFERENTS MESSAGES D'ERREUR EN FONCTION DES SITUATIONS :
				elseif (isset($_POST['nombreCases']) AND !empty($_POST['nombreCases']) AND (int)$_POST['nombreCases']==$_POST['nombreCases'] AND (int)$_POST['nombreCases']>10){
					echo "<th id=\"emptyTable\">Restons raisonnable...;-) <br/> (Max = 10)</th>";
				}
				elseif (isset($_POST['nombreCases']) AND (int)$_POST['nombreCases']==$_POST['nombreCases'] AND ($_POST['nombreCases']=="1" OR $_POST['nombreCases']=="0")){
					echo "<th id=\"emptyTable\">Tricheur =P</th>";
				}
				elseif (isset($_POST['nombreCases']) AND !empty($_POST['nombreCases']) AND (int)$_POST['nombreCases']==$_POST['nombreCases'] AND (int)$_POST['nombreCases']<0){
					echo "<th id=\"emptyTable\">Essaye pas de m'avoir,<br/>rentre un nombre positif =P</th>";
				}
				elseif (isset($_POST['nombreCases']) AND !empty($_POST['nombreCases'])){
					echo "<th id=\"emptyTable\">C'est pas un nombre, ça ;-)</th>";
				}
				?>
			</table>
			<div id="goToRes">
				<form id="goToResForm" method="POST" action="../TAPCAZ_RESULTATS">
					<button type="submit" name="goToResButton">HighScores</button>
				</form>
				<button onclick="showRules()">Règles du jeu</span>
			</div>
		</div>

<!--RIGHT BLOCK-->
		<div id="rightBlock">
			<div id="startBlock">
			<?php
			if (isset($canStart)){
				echo "<button id=\"boutonStart\" onclick=\"startChrono()\">Start !</button>";
			}
			?>
			</div>
			<div id="scoreBlock">
				<span class="compteurs">Score</span><br><span id="score">0</span>
			</div>
		</div>

	</section>

	<!--ON STOCK CE QU'IL FAUT POUR LE JAVASCRIPT-->
	<p hidden id="stockCases"><?php if (isset($nombreCases)) {echo $nombreCases*$nombreCases;$_SESSION['grille']=$nombreCases;}?></p>
	<!--Défini un premier random égal à la position du premier bouton-->
	<p hidden id="stockRandom">
		<?php
		if (isset($canStart) AND $nombreCases%2!==0){
			echo round($nombreCases*$nombreCases/2);}
		elseif (isset($canStart) AND $nombreCases%2==0){
			echo $nombreCases*$nombreCases/2-$nombreCases/2;}
		?>
	</p>

	<div id="pseudoForm" hidden>
		<form method="POST" action="../TAPCAZ_RESULTATS/index.php">
			Bien joué !<br/><br/>Rentre ton pseudo pour<br/>apparaître dans les HighScores<br/><br/>
			<input type="text" name="pseudo" placeholder="Pseudo (max 10 caract.)" maxlength="10" /><br/>
			<input id="stockScore" type="text" name="score" hidden/>
			<input type="submit" name="submit">
		</form>
	</div>

	<script type="text/javascript" src="script/script.js"></script>
</body>
</html>