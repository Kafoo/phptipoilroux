<div class="fixInfosSlider desktop">
	<div class="fixInfos desktop">
		<div class="coterieLogoContainer">		
			<div class="coterie-logo coterie-pu desktop">
				<div class="puFixInfos"></div>
			</div>
		</div>
		<?php
		for ($j=0; $j < count($coterie); $j++) {  
			if ($coterie[$j]['nom']!=='GM') { //On n'affiche pas le GM ?> 
				<div class="infoPerso"> 
					<?php // Etoiles autour du nom si perso du user 
					if ($coterie[$j]['userID'] === $_SESSION['id']) { ?> 
						<img src="img/icones/monperso.png" style="width: 10px;"> 
						<div class="infoPersoNom">
							<a href="profil.php?persoID=<?=$coterie[$j]['persoID']?>"><?=$coterie[$j]['nom']?></a>
							</div>
						<img src="img/icones/monperso.png" style="width: 10px;"> 
					<?php 
					} else {?> 
						<div class="infoPersoNom"><a href="profil.php?persoID=<?=$coterie[$j]['persoID']?>"><?=$coterie[$j]['nom']?></a></div> 

					<?php 
					} 
					//Calcul du pourcentage vers le nextLVL 
						$xp = $coterie[$j]['xp'];
						$minxp = $coterie[$j]['minxp'];
						$nextLVL = $coterie[$j]['nextlvl']; 
						$pourcent = ($xp-$minxp)*100/($nextLVL-$minxp); 
					?> 

					<div class="infoPersoDropdown"> 
						<img src="img/rpg/pv_<?=$coterie[$j]['pv']?>.png" class="pvBar" data-toggle="tooltip" data-placement="left" title="<?=$coterie[$j]['pv']?>/10 PV"> 
						<br>
						<div class="infoPersoLvl">lvl <?=$coterie[$j]['lvl']?></div> 
						<div class="infoPersoXP-container">
							<div class="infoPersoXP"  
							style="background: linear-gradient(to right, #5154bd <?=$pourcent?>%, rgb(200,200,200) <?=$pourcent?>%);"> 
								<b><?=$xp?></b> / <?=$nextLVL?> XP
							</div> 
						</div>

						<br>

						<?php
						$c1Name = $caracOfUniv['0']['carac_name'];
						$c2Name = $caracOfUniv['1']['carac_name'];
						$c3Name = $caracOfUniv['2']['carac_name'];
						$c4Name = $caracOfUniv['3']['carac_name'];
						$c5Name = $caracOfUniv['4']['carac_name'];
						if ($coterie[$j]['c1Cond'] >= 0) {$c1Cond = '+'.$coterie[$j]['c1Cond'];}	else{$c1Cond = $coterie[$j]['c1Cond'];}		
						if ($coterie[$j]['c2Cond'] >= 0) {$c2Cond = '+'.$coterie[$j]['c2Cond'];}	else{$c2Cond = $coterie[$j]['c2Cond'];}		
						if ($coterie[$j]['c3Cond'] >= 0) {$c3Cond = '+'.$coterie[$j]['c3Cond'];}	else{$c3Cond = $coterie[$j]['c3Cond'];}		
						if ($coterie[$j]['c4Cond'] >= 0) {$c4Cond = '+'.$coterie[$j]['c4Cond'];}	else{$c4Cond = $coterie[$j]['c4Cond'];}		
						if ($coterie[$j]['c5Cond'] >= 0) {$c5Cond = '+'.$coterie[$j]['c5Cond'];}	else{$c5Cond = $coterie[$j]['c5Cond'];}		
						?>
						<div>				
							<div class="infoPersoCarac carac1" data-toggle="tooltip" data-placement="top" title="<?=ucfirst($c1Name)?>"><?=$coterie[$j]['c1']?></div> 
							<div class="infoPersoCarac carac2" data-toggle="tooltip" data-placement="top" title="<?=ucfirst($c2Name)?>"><?=$coterie[$j]['c2']?></div> 
							<div class="infoPersoCarac carac3" data-toggle="tooltip" data-placement="top" title="<?=ucfirst($c3Name)?>"><?=$coterie[$j]['c3']?></div> 
							<div class="infoPersoCarac carac4" data-toggle="tooltip" data-placement="top" title="<?=ucfirst($c4Name)?>"><?=$coterie[$j]['c4']?></div>
							<div class="infoPersoCarac carac5" data-toggle="tooltip" data-placement="top" title="<?=ucfirst($c5Name)?>"><?=$coterie[$j]['c5']?></div>
						</div>
						<div>						
							<div class="infoPersoCond" data-toggle="tooltip" data-placement="top" title="Condition de <?=ucfirst($c1Name)?>"><?=$c1Cond?></div>
							<div class="infoPersoCond" data-toggle="tooltip" data-placement="top" title="Condition de <?=ucfirst($c2Name)?>"><?=$c2Cond?></div>
							<div class="infoPersoCond" data-toggle="tooltip" data-placement="top" title="Condition de <?=ucfirst($c3Name)?>"><?=$c3Cond?></div>
							<div class="infoPersoCond" data-toggle="tooltip" data-placement="top" title="Condition de <?=ucfirst($c4Name)?>"><?=$c4Cond?></div>
							<div class="infoPersoCond" data-toggle="tooltip" data-placement="top" title="Condition de <?=ucfirst($c5Name)?>"><?=$c5Cond?></div>
						</div>
						<div class="infoPersoInventory">
							<?=$coterie[$j]['invent1']?> <br>
							<?=$coterie[$j]['invent2']?> <br>
							<?=$coterie[$j]['invent3']?> <br>
							<?=$coterie[$j]['invent4']?> <br>
							<?=$coterie[$j]['invent5']?> <br>
						</div>
					</div>
					<img src="img/icones/dropdown.png" class="dropdownIcone">
				</div>
				<?php // Séparation uniquement entre chaque perso
				if ($j !== count($coterie)-2) { ?>
					<!-- <div class="separate"></div> -->
				<?php	
				}
			} ?>
		<?php
		} ?>
	</div>
</div>