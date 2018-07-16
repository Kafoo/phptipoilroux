<!--REFRESH PHP-->
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
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title>Test KeyDown</title>
</head>
<body onkeydown="move()">

<form method="POST" action="">
	<input type="text" name="grille" placeholder="grille ?"/>
</form>

<table>

	<?php
	if (isset($_POST['grille'])){
		$xMax = 10;
		$yMax = 10;
		$y=1;
		while ($y<=$_POST['grille']) {
			$x=1;
			echo "<tr>";
			while ($x<=$_POST['grille']) {
				echo "<td id='C".$x.".".$y."'></td>";
				$x=$x+1;
			}
			echo"</tr>";
			
			$y=$y+1;
		}	
	}
	?>
</table>

<div hidden id="max">
	<?php 
	if (isset($_POST['grille'])){
		echo $_POST['grille'];
	}
	?>
</div>



<script type="text/javascript" src="script/script.js"></script>
</body>
</html>