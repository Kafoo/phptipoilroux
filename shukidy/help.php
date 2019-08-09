<?php
include("_shared_/start.php");
/*include("submits/tapage_submit.php");*/
?>

<!DOCTYPE html>
<html>
<head>
	<?php include("_shared_/headconfig.php"); ?>
	<link rel="stylesheet" type="text/css" href="style/help.css">
	<title>Shukidy - Help</title>
</head>
<body>

<?php include('_shared_/header.php') ?>


<!-- -------- CONTENU -------- -->
<section>


<?php
/*SUBMIT*/

if (isset($_POST['submit'])) {
	if (isset($_POST['pseudo']) AND trim($_POST['pseudo']) !== '') {
		if (isset($_POST['content']) AND trim($_POST['content']) !== '') {
		
		$dat = getRealDate();
		$pseudo = nl2br(htmlspecialchars(($_POST['pseudo']), ENT_QUOTES));
		$content = nl2br(htmlspecialchars(($_POST['content']), ENT_QUOTES));

		$bdd->query("
			INSERT INTO help_chat (content, dat, pseudo) VALUES ('$content', '$dat', '$pseudo')
			");

			$_POST = '';

		}else{
			$error = 'Il faut que tu écrives un message ;-)';
		}
	}else{
		$error = 'Il faut que tu indiques un pseudo ;-)';
	}
}

/*REQUEST*/
$req = $bdd->query("
	SELECT *
	FROM help_chat
	");
$chat = $req->fetchall();

/*PAGINATION*/
$postsParPage = 2;
$nbrPosts = count($chat);
$nbrPages = ceil($nbrPosts/$postsParPage);

//On défini la page courante
if (isset($_GET['p']) AND !empty($_GET['p']) AND $_GET['p'] > 0) {
	$_GET['p']=intval($_GET['p']);
	$currentPage = $_GET['p'];
}else{
	$currentPage = $nbrPages;
}

//On défini où on en est sur cette page
$lastPostOfPage = ($currentPage)*$postsParPage;
$firstPostOfPage = $lastPostOfPage - $postsParPage + 1;


?>

<h1>HELP</h1>

<?php
if (isset($error)) { ?>
	<div class="error"><?=$error?></div>
<?php
}

?>


<!-- PAGINATION -->
<?php
$pageVoid = False;
?>

<div class ="pagination"> Pages :

	<?php
	for ($i=1; $i <= $nbrPages ; $i++) {

		if ($nbrPages > 6) {
			if ($i <= 3 or $i >= $nbrPages-2) {
				if ($i==$currentPage) {
					echo "<span style='color:#c8c8c8'>".$i."</span>";
				}
				else{
					$file = explode('?p', $_SERVER['REQUEST_URI'])[0];
					echo "<a href='".$file."?p=".$i."'>".$i."</a> ";
				}
				if ($i<$nbrPages) {
					echo " - ";
				}					
			}else{
				if ($pageVoid == False) {
					echo "... - ";
					$pageVoid = True;
				}
			}
		}else{
			if ($i==$currentPage) {
				echo "<span style='color:#c8c8c8'>".$i."</span>";
			}
			else{
				$file = explode('?p', $_SERVER['REQUEST_URI'])[0];
				echo "<a href='".$file."?p=".$i."'>".$i."</a> ";
			}
			if ($i<$nbrPages) {
				echo " - ";
			}
		}
	} ?>
</div>

<!-- END PAGINATION -->

<?php

foreach ($chat as $key => $msg) {
	if ($key+1 >= $firstPostOfPage
	AND $key+1 <= $lastPostOfPage) { 

		$date = explode('--', $msg['dat']);
		?>
		<div class="helper_msg">
			<div class="title">
				<?=$msg['pseudo']?>,  le <?=$date[0]?> à <?=$date[1]?>
			</div>
			<div class="content">
				<?=$msg['content']?>
			</div>
		</div>
	<?php
	}
} ?>

<!-- PAGINATION -->
<?php
$pageVoid = False;
?>

<div class ="pagination"> Pages :

	<?php
	for ($i=1; $i <= $nbrPages ; $i++) {

		if ($nbrPages > 6) {
			if ($i <= 3 or $i >= $nbrPages-2) {
				if ($i==$currentPage) {
					echo "<span style='color:#c8c8c8'>".$i."</span>";
				}
				else{
					$file = explode('?p', $_SERVER['REQUEST_URI'])[0];
					echo "<a href='".$file."?p=".$i."'>".$i."</a> ";
				}
				if ($i<$nbrPages) {
					echo " - ";
				}					
			}else{
				if ($pageVoid == False) {
					echo "... - ";
					$pageVoid = True;
				}
			}
		}else{
			if ($i==$currentPage) {
				echo "<span style='color:#c8c8c8'>".$i."</span>";
			}
			else{
				$file = explode('?p', $_SERVER['REQUEST_URI'])[0];
				echo "<a href='".$file."?p=".$i."'>".$i."</a> ";
			}
			if ($i<$nbrPages) {
				echo " - ";
			}
		}
	} ?>
</div>

<!-- END PAGINATION -->

<form method="POST">
	<label>Ton pseudo :</label>
	<input type="text" name="pseudo"
	<?php if (isset($_POST['pseudo'])): ?>
		<?php echo 'value="'.$_POST['pseudo'].'"' ?>
	<?php endif ?>
	>
	<label>Ton message :</label>
	<textarea name="content"><?php
		if (isset($_POST['content'])){
			echo $_POST['content'] ;
		} ?></textarea>
	<input type="submit" name="submit">
</form>


</section>

<?php include("_shared_/scripts.php"); ?>
<script type="text/javascript" src="js/help.js"></script>

</body>
</html>