<?php
$req = $bdd->query("
	SELECT *
	FROM mas_diceroll
	LEFT JOIN mas_persos ON mas_diceroll.persoID=mas_persos.id
	LEFT JOIN mas_carac ON mas_diceroll.caracID=mas_carac.id
	WHERE msgID = '$msgInfo[0]'");
$diceRoll = $req->fetchall()[0];

?>


<?php

	$perso = $diceRoll['nom'];
	$title = htmlspecialchars_decode($msgInfo['contenu']);
	$caracName = $diceRoll['carac_name'];
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
				<div class="diceRollDigit digit-roll" title="résultat du lancé"><?=$result?></div>
				<div class="diceRollDigit digit-carac" style="background-image: url(img/icones/carac/<?=$caracID?>_color.png);" title="<?=$caracName?> de <?=$perso?>">+<?=$caracVal?></div>
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
