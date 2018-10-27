<?php
include("_shared_/start.php");
include("_shared_/functions.php");
/*include("submits/tapage_submit.php");*/
?>

<?php include("submits/subscribe_submit.php"); ?>

<!DOCTYPE html>
<html>
<head>
	<?php include("_shared_/headconfig.php"); ?>
	<link rel="stylesheet" type="text/css" href="style/subscribe.css">
	<title>Vampire - Inscription</title>
</head>
<body>

<?php include('_shared_/header.php') ?>


<section>

	<?php /*------- IF CLASSIC SUBSCRIBING PAGE -------*/ 
	if (!isset($_GET['subscribed'])) {
		?>

		<h1>INSCRIPTION</h1>

		<form id="subscribeBloc" method="POST" action="">
			<table>
				<tr>
					<td>
						<label for="pseudo">Pseudo :</label>
					</td>
					<td>
						<input type="text" name="pseudo" placeholder="Pseudo">
					</td>
				</tr>
				<tr>
					<td>
						<label for="mail">Mail :</label>
					</td>
					<td>
						<input type="text" name="mail" placeholder="Ton mail">
					</td>
					<td>
						<img id="helpLogo" src="img/global/help.png" onmouseover="showHelp()" onmouseout="hideHelp()">
						<div id="help" hidden>Pour information, je te demande ton mail pour pouvoir vendre tout ce que je sais de toi à des services complètements secrets avides de pouvoir et d'argent. Cordialement. <i>(Non en vrai c'est juste pour être notifié des nouveaux messages si tu le souhaites =P)</i></div>
					</td>
				</tr>
				<tr>
					<td>
						<label for="password">Mot de passe :</label>
					</td>
					<td>
						<input type="password" name="password" placeholder="Mot de passe">
					</td>
				</tr>
				<tr>
					<td>
						<label for="passwordConfirm">Confirmation :</label>
					</td>
					<td>
						<input type="password" name="passwordConfirm" placeholder="Mot de passe">
					</td>
				</tr>
			</table>
			<br/>
			<input type="submit" name="submit" value="Je m'inscris !">
		</form>

	<?php } else { /*------- IF JUST SUBSCRIBED -------*/ ?>

			<div class="test subscribed">
				Inscription réussi !<br><br>
				Tu peux maintenant valider le lien que tu as reçu dans tes mails, puis te connecter et commencer à jouer =)
			</div>

	<?php } ?>


</section>


<?php include("_shared_/scripts.php"); ?>
<script type="text/javascript" src="js/subscribe.js"></script>
</body>
</html> 