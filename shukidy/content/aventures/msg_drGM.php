<div>
<?php

	$perso = $msg['nom'];
	$caracID = $msg['caracID'];
	$caracVal = $msg['caracVal'];
	$caracName = $caracOfAv['c'.$caracID.'_name'];
	$result = $msg['result'];
	$caracCond = $msg['caracCond'];
	$difficulty = $msg['difficulty'];
	$resultFinal = floatval($result)+floatval($caracVal)+floatval($caracCond);

	if ($difficulty<$resultFinal) {$success = 1;}
	elseif ($difficulty>=$resultFinal) {$success = 0;}

	?>
	
	<div class="diceRollBox">
		<div class="diceRollPerso">
			<div class="box">
				<b><u><?=$perso?></u></b>
			</div>
			<div class="box">
				<i>(<?=ucfirst($caracName)?>)</i>
			</div>

			<?php
			if ($msg['persoID'] == $persoID) {
			// IF CURRENT USER
			if ($result == 0) { ?>
				<!-- Not Rolled -->
				<div class="box rollBox rollTheDie button"
				ajax="?action=rollTheDie&rollID=<?=$diceRoll[0]?>"
				>Lance le dé !</div>
			<?php
			}else{ ?>
				<!-- Rolled -->
				<div class="box rollBox dieRolled">
					Résultat du jet : <?=$result?>
				</div>
			<?php
			}
		}else{
			// IF OTHER USER
			if ($result == 0) { ?>
				<!-- Not Rolled -->
				<div class="box rollBox">En attente</div>
			<?php
			}else{ ?>
				<!-- Rolled -->
				<div class="box rollBox dieRolled">
					Résultat : <?=$result?>			
				</div>
			<?php
			} ?>
		<?php
		} ?>

		</div>
		<div class="centering">
			<div class="diceRollDigits">
				<div class="diceRollDigit digit-roll" data-toggle="tooltip" data-placement="top" title="Résultat du lancé"><?=$result?></div>
				<div class="diceRollDigit digit-carac" style="background-image: url(img/icones/carac/<?=$caracID?>_color.png);" data-toggle="tooltip" data-placement="top" title="<?=ucfirst($caracName)?> de <?=$perso?>">+<?=$caracVal?></div>
			<div class="diceRollDigit digit-cond <?php if($caracCond>=0){echo'digit-cond-pos';}else{echo'digit-cond-neg';}?>" data-toggle="tooltip" data-placement="top" title="Condition">+<?=$caracCond?></div>
				<div class="inline">
					<span style="font-weight: bolder">=</span>	
					<div class="diceRollDigit digit-resultFinal" data-toggle="tooltip" data-placement="top" title="Résultat final">
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

	
</div>
<div></div>
