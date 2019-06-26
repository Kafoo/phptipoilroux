<?php 
if ($i == 0) {//Seulement pour le 1er post ?>
	<div class="fixInfos desktop">
		<div class="coterieLogoContainer">		
			<div class="coterie-logo coterie-pu">
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
					} ?> 
 
 					<div class="infoPersoPU" hidden> 
						<b>LVL : </b><?=$coterie[$j]['lvl']?><br><br> 
						<b>Clan : </b><?=ucfirst($coterie[$j]['clan'])?><br> 
						<b>Nature : </b><?=$coterie[$j]['nature']?><br>
						<b>Attitude : </b><?=$coterie[$j]['attitude']?><br>
						<b>Concept : </b><?=$coterie[$j]['concept']?><br>
						<b>Défaut : </b><?=$coterie[$j]['defaut']?><br><br> 
						<b>Discipline : </b><?=ucfirst($coterie[$j]['nom_discipline'])?><br> 
					</div> 
 
					<?php //Calcul du pourcentage vers le nextLVL 
						$xp = $coterie[$j]['xp'];
						$minxp = $coterie[$j]['minxp'];
						$nextLVL = $coterie[$j]['nextlvl']; 
						$pourcent = ($xp-$minxp)*100/($nextLVL-$minxp); 
					?> 
 
					<div class="infoPersoDropdown"> 
						<img src="img/rpg/pv_<?=$coterie[$j]['pv']?>.png" class="hpBar" data-toggle="tooltip" data-placement="top" title="<?=$coterie[$j]['pv']?>/10 PV"> 
						<div class="infoPersoLvl">lvl <?=$coterie[$j]['lvl']?></div> 
						<div class="infoPersoXP-container">
							<div class="infoPersoXP"  
							style="background: linear-gradient(to right, #5154bd <?=$pourcent?>%, rgb(200,200,200) <?=$pourcent?>%);"> 
								<b><?=$xp?></b> / <?=$nextLVL?> XP
							</div> 
						</div>

						<?php
						$c1Name = $caracOfUniv['0']['carac_name'];
						$c2Name = $caracOfUniv['1']['carac_name'];
						$c3Name = $caracOfUniv['2']['carac_name'];
						$c4Name = $caracOfUniv['3']['carac_name'];
						$c5Name = $caracOfUniv['4']['carac_name'];				
						?>

						<div class="infoPersoCarac carac1" data-toggle="tooltip" data-placement="top" title="<?=ucfirst($c1Name)?>"><?=$coterie[$j]['c1']?></div> 
						<div class="infoPersoCarac carac2" data-toggle="tooltip" data-placement="top" title="<?=ucfirst($c2Name)?>"><?=$coterie[$j]['c2']?></div> 
						<div class="infoPersoCarac carac3" data-toggle="tooltip" data-placement="top" title="<?=ucfirst($c3Name)?>"><?=$coterie[$j]['c3']?></div> 
						<div class="infoPersoCarac carac4" data-toggle="tooltip" data-placement="top" title="<?=ucfirst($c4Name)?>"><?=$coterie[$j]['c4']?></div>
						<div class="infoPersoCarac carac5" data-toggle="tooltip" data-placement="top" title="<?=ucfirst($c5Name)?>"><?=$coterie[$j]['c5']?></div>
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
	<?php	
}else{ ?>
	<div></div>
<?php }?>