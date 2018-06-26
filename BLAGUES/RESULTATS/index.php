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
		<link rel="stylesheet" href="css/style.css">
		<meta charset="utf-8">
	</head>

	<body>

		<?php

			$base = fopen('fichier.txt', 'a+');

			//REMPLACER LES EVENTUELLES NEWLINE PAR DES ESPACES
			if (isset($_POST['newblague']) AND strpos($_POST['newblague'], "\r\n")!==false)
			{
				$_POST['newblague']=str_replace("\r\n", ' ', $_POST['newblague']);
			}

			//AJOUTE LA NEWBLAGUE A LA BASE
			if (isset($_POST['newblague']) AND !empty($_POST['newblague']))
			{
				fwrite($base, "\r\n".$_POST['newblague']);
			}	

			//CREER LE TABLEAU $blagues ET Y AJOUTER CHAQUE LIGNE DE LA BASE
			$blagues = array();
			$read = file('fichier.txt');
			foreach ($read as $line) 
			{
				array_push($blagues, $line);
			}
			
			fclose($base)
		?>



		<h1>TOUTES LES BLAGUES...</h1>

		<table>
			<tr id="titres">
				<th>Position</th>
				<th id="centralrow">Blagues</th>
				<th>Votes</th>
			</tr>

			<?php

			for ($i=0; $i < count($blagues); $i++) 
			{ 
				echo "

			<tr>
				<td>#".$i."</td>
				<td class='lesblagues'>".$blagues[$i]."</td>
				<td>X votes</td>
				<td>
					<input type='checkbox' name='vote' id='vote'/>
					<label for='vote'>Je vote !</label>
				</td>
			</tr>";
			}
			?>




		</table>

		<hr color="black" width="50%"/>

		<form action="../ACCUEIL/index.php">
			<input type="submit" value="Balance une autre blague de merde !" id="submit">
		</form>
		<h2>OU</h2>
		<form action="https://repl.it/repls/FractalAmusingEquation">
			<input type="submit" value="Joue avec une intelligence artificielle dernière génération !!" id="submitIA">
		</form>






		<script src="js/javascriptsamere.js"></script>
	</body>

</html>