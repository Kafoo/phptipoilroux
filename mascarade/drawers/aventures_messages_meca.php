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
		<img src="img/icones/jet_white"
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
					<b><u><?=$perso?></u></b><br>
					<i>(<?=ucfirst($carac)?>)</i><br>

					<?php
					if ($diceRoll['persoID'] == $persoID) {
					// IF CURRENT USER
					if ($result == 0) { ?>
						<!-- Not Rolled -->
						<div class="rollBox rollTheDie button"
						ajax="?action=rollTheDie&rollID=<?=$diceRoll[0]?>"
						>Lance le dé !</div>
					<?php
					}else{ ?>
						<!-- Rolled -->
						<div class="rollBox dieRolled">
							Résultat du jet : <?=$result?>
						</div>
					<?php
					}
				}else{
					// IF OTHER USER
					if ($result == 0) { ?>
						<!-- Not Rolled -->
						<div class="rollBox">En attente</div>
					<?php
					}else{ ?>
						<!-- Rolled -->
						<div class="rollBox dieRolled">
							Résultat : <?=$result?>			
						</div>
					<?php
					} ?>
				<?php
				} ?>

				</div>
				<div class="centering">
					<div class="diceRollDigits">
						<div class="diceRollDigit digit-roll">9</div>
						<div class="diceRollDigit digit-carac">+2</div>
						<div class="diceRollDigit digit-bonus">+3</div>
						<div class="diceRollDigit digit-malus">-1</div>
						<span style="font-weight: bolder">=</span>	
						<div class="diceRollDigit digit-resultFinal">
							13
							<span class="digit-difficulty"> /12</span>
							<img src="./img/icones/tic_no.png" class="diceRoll-tic">
						</div>
					</div>
				</div>



				<?php /*
				if ($diceRoll['persoID'] == $persoID) {
					// IF CURRENT USER
					if ($result == 0) { ?>
						<!-- Not Rolled -->
						<div class="rollBox rollTheDie button"
						ajax="?action=rollTheDie&rollID=<?=$diceRoll[0]?>"
						>Lance le dé !</div>
					<?php
					}else{ ?>
						<!-- Rolled -->
						<div class="rollBox dieRolled">
							Résultat du jet : <?=$result?>
						</div>
					<?php
					}
				}else{
					// IF OTHER USER
					if ($result == 0) { ?>
						<!-- Not Rolled -->
						<div class="rollBox">En attente</div>
					<?php
					}else{ ?>
						<!-- Rolled -->
						<div class="rollBox dieRolled">
							Résultat du jet : <?=$result?>			
						</div>
					<?php
					}
				}//endif other user ?> 

				<div class="rollBox">
					<?php
					echo $result." + ".$valCarac." + ".$bonus." - ".$malus." = ".$resultFinal."/".$difficulty." - ";
					if ($resultFinal >= $difficulty) {
						echo "Lancé Réussi !";
					}else{
						echo "Lancé raté !";
					}
					?>
				</div> <?php */ ?>



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
		<img src="img/icones/jet_white"
		class="diceRoll_icone">
	</div>
	<div class="diceRollBloc centering">

		<div class="diceRollTitle">
			Lancé de dés !<br>
			<span class="diceRollContent">- <?=$info['contenu']?> -</span>
		</div>

		<?php 
		for ($j=0; $j < count($diceRolls); $j++) {

			$diceRoll = $diceRolls[$j];
			$perso = $diceRoll['nom'];
			$carac = $diceRoll['carac'];
			$goal = $diceRoll[$carac];
			$result = $diceRoll['result'];
			$bonus = $diceRoll['bonus'];
			$malus = $diceRoll['malus'];
			$resultFinal = floatval($result)-floatval($bonus)+floatval($malus);

			if ($goal<$resultFinal) {$success = 1;}
			elseif ($goal>=$resultFinal) {$success = 0;}

			?>
			
			<div class="diceRollBox">
				<u><?=$perso?></u> <i>(<?=ucfirst($carac)?>)</i>

				<?php
				if ($diceRoll['persoID'] == $persoID) {
					if ($result == 0) { ?>
						<div class="rollBox rollTheDie button"
						ajax="?action=rollTheDie&rollID=<?=$diceRoll[0]?>"
						>Lance le dé !</div>
					<?php
					}else{ ?>
						<div class="rollBox dieRolled">
							<?php 
							echo $result;
							if ($bonus > 0) {echo " - ".$bonus;}
							if ($malus > 0) {echo " + ".$malus;}
							if ($bonus > 0 OR $malus > 0) {echo " = ".$result;}
							?>													
						</div>
					<?php
					}
				}else{
					if ($result == 0) { ?>
						<div class="rollBox">En attente</div>
					<?php
					}else{ ?>
						<div class="rollBox dieRolled">
							<?php
							echo $result;
							if ($bonus > 0) {echo " - ".$bonus;}
							if ($malus > 0) {echo " + ".$malus;}
							if ($bonus > 0 OR $malus > 0) {echo " = ".$resultFinal;}
							?>			
						</div>
					<?php
					}
				}?>
			</div>
		<?php
		} ?>
	</div>
	<!------ FIXINFO ------>
	<?php include('drawers/aventures_fixinfos.php');?>
<?php
} ?>