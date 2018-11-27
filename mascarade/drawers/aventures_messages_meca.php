<?php
// ----- IF DICE ROLL FROM GM -----
if ($info['type'] === 'diceRoll_GM') { 

	$req = $bdd->query("
		SELECT *
		FROM mas_diceroll
		LEFT JOIN mas_persos
		ON mas_diceroll.persoID=mas_persos.id
		WHERE msgID = '$info[0]'");
	$diceRolls = $req->fetchall(); ?>

	<div >
		<img src="img/icones/jet_white.png"
		class="diceRoll_icone desktop">
	</div>
	<div class="diceRollBloc">

		<div class="diceRollTitle centering">
			Lancé de dés !<br>
			<span class="diceRollContent">- <?=$info['contenu']?> -</span>
		</div>

		<?php 
		for ($j=0; $j < count($diceRolls); $j++) {

			$diceRoll = $diceRolls[$j];
			$perso = $diceRoll['nom'];
			$carac = $diceRoll['carac'];
			$valCarac = $diceRoll[$carac];
			$result = $diceRoll['result'];
			$bonus = $diceRoll['bonus'];
			$malus = $diceRoll['malus'];
			$difficulty = $diceRoll['difficulty'];
			$resultFinal = floatval($result)+floatval($valCarac)+floatval($bonus)-floatval($malus);

			if ($difficulty<$resultFinal) {$success = 1;}
			elseif ($difficulty>=$resultFinal) {$success = 0;}

			?>
			
			<div class="diceRollBox">
				<div class="diceRollPerso">
					<div class="box">						
						<b><u><?=$perso?></u></b>
					</div>
					<div class="box">
						<i>(<?=ucfirst($carac)?>)</i>
					</div>

					<?php
					if ($diceRoll['persoID'] == $persoID) {
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
						<div class="diceRollDigit digit-roll"><?=$result?></div>
						<div class="diceRollDigit digit-carac">+<?=$valCarac?></div>
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
	</div>
	<!------ FIXINFO ------>
	<?php include('drawers/aventures_fixinfos.php');

} //endif diceroll from GM
// ----- IF DICE ROLL FROM PLAYER -----
if ($info['type'] === 'diceRoll_player') { 

	$req = $bdd->query("
		SELECT *
		FROM mas_diceroll
		LEFT JOIN mas_persos
		ON mas_diceroll.persoID=mas_persos.id
		WHERE msgID = '$info[0]'");
	$diceRolls = $req->fetchall(); ?>

	<div >
		<img src="img/icones/jet_white.png"
		class="diceRoll_icone desktop">
	</div>
	<div class="diceRollBloc">

		<div class="diceRollTitle centering">
			Lancé de dés !<br>
			<span class="diceRollContent">- <?=$info['contenu']?> -</span>
		</div>

		<?php 
		for ($j=0; $j < count($diceRolls); $j++) {

			$diceRoll = $diceRolls[$j];
			$perso = $diceRoll['nom'];
			$carac = $diceRoll['carac'];
			$valCarac = $diceRoll[$carac];
			$result = $diceRoll['result'];
			$bonus = $diceRoll['bonus'];
			$malus = $diceRoll['malus'];
			$difficulty = $diceRoll['difficulty'];
			$resultFinal = floatval($result)+floatval($valCarac)+floatval($bonus)-floatval($malus);

			if ($difficulty<$resultFinal) {$success = 1;}
			elseif ($difficulty>=$resultFinal) {$success = 0;}

			?>
			
			<div class="diceRollBox">
				<div class="diceRollPerso">
					<div class="box">						
						<b><u><?=$perso?></u></b>
					</div>
					<div class="box">
						<i>(<?=ucfirst($carac)?>)</i>
					</div>

					<?php
					if ($diceRoll['persoID'] == $persoID) {
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
						<div class="diceRollDigit digit-roll"><?=$result?></div>
						<div class="diceRollDigit digit-carac">+<?=$valCarac?></div>
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
	</div>
	<!------ FIXINFO ------>
	<?php include('drawers/aventures_fixinfos.php');

} //endif diceroll from user ?>