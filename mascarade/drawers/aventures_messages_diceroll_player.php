<?php
$req = $bdd->query("
	SELECT *
	FROM mas_diceroll
	LEFT JOIN mas_persos
	ON mas_diceroll.persoID=mas_persos.id
	WHERE msgID = '$msgInfo[0]'");
$diceRolls = $req->fetchall(); ?>



<?php 
for ($j=0; $j < count($diceRolls); $j++) {

	$diceRoll = $diceRolls[$j];
	$perso = $diceRoll['nom'];
	$title = htmlspecialchars_decode($msgInfo['contenu']);
	$caracID = $diceRoll['caracID'];
	$caracVal = $diceRoll['c'.$caracID];
	$result = $diceRoll['result'];
	$bonus = $diceRoll['bonus'];
	$malus = $diceRoll['malus'];
	$difficulty = $diceRoll['difficulty'];
	$resultFinal = floatval($result)+floatval($caracVal)+floatval($bonus)-floatval($malus);

	if ($difficulty<$resultFinal) {$success = 1;}
	elseif ($difficulty>=$resultFinal) {$success = 0;}

	?>
	
	<div class="diceRollTitle-player">- <?=$title?> -</div>
	<div class="diceRollBox">
		<div class="centering">
			<div class="diceRollDigits">
				<div class="diceRollDigit digit-roll"><?=$result?></div>
				<div class="diceRollDigit digit-carac" style="background-image: url(img/icones/carac/<?=$caracID?>_color.png);">+<?=$caracVal?></div>
				<div class="diceRollDigit digit-bonus">+<?=$bonus?></div>
				<div class="diceRollDigit digit-malus">-<?=$malus?></div>
				<div class="inline">
					<span style="font-weight: bolder">=</span>	
					<div class="diceRollDigit digit-resultFinal">
						<?=$resultFinal?>
						<span class="digit-difficulty"> /<?=$difficulty?></span>
						<?php
						if ($resultFinal>=$difficulty) {
							echo '<img src="./img/icones/tic_yes.png" class="diceRoll-tic">';
						}else{
							echo '<img src="./img/icones/tic_no.png" class="diceRoll-tic">';
						}?>
					</div>
				</div>
				<div class="resultText">
					<?php
					if ($resultFinal>=$difficulty) {echo '<div class="yes">Réussi !</div>';}
					else{echo '<div class="no">Raté !</div>';}
					?>
				</div>
			</div>
		</div>
	</div>
<?php
} ?>