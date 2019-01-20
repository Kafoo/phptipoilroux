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
						<div class="infoPersoNom"><?=$coterie[$j]['nom']?></div> 
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
						$nextLVL = $coterie[$j]['nextLVL']; 
						$pourcent = $xp*100/$nextLVL; 
					?> 
 
					<div class="infoPersoDropdown"> 
						<img src="img/rpg/pv_<?=$coterie[$j]['pv']?>.png" class="hpBar" pv="<?=$coterie[$j]['pv']?>"> 
						<div class="infoPersoLvl">lvl <?=$coterie[$j]['lvl']?></div> 
						<div class="infoPersoXP"  
						style="background: linear-gradient(to right, #5154bd <?=$pourcent?>%, rgb(200,200,200) <?=$pourcent?>%);"> 
							<b><?=$xp?></b> / <?=$nextLVL?> XP 
						</div> 
						<div class="infoPersoCarac carac1" carac="force"><?=$coterie[$j]['forc']?></div> 
						<div class="infoPersoCarac carac2" carac="dextérité"><?=$coterie[$j]['dexterite']?></div> 
						<div class="infoPersoCarac carac3" carac="intelligence"><?=$coterie[$j]['intelligence']?></div> 
						<div class="infoPersoCarac carac4" carac="charisme"><?=$coterie[$j]['charisme']?></div>
						<div class="infoPersoCarac carac5" carac="perception"><?=$coterie[$j]['perception']?></div>
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
	<div class='<?=$firstMsgOfPost[0]?>'></div>
<?php }?>