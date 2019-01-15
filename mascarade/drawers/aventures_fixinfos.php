<?php 
if ($i == 0) {//Seulement pour le 1er post ?>
	<div class="fixInfos desktop">
		<?php
		for ($j=0; $j < count($coterie); $j++) { 
			if ($coterie[$j]['nom']!=='GM') { //On n'affiche pas le GM ?>
				<div class="infoPersoNom">
					<div class="infoPersoLvl" >
						<?=$coterie[$j]['lvl']?>
					</div>
					<b><?=$coterie[$j]['nom']?></b>
					<div class="infoPersoPU" hidden>
						<b>LVL : </b><?=$coterie[$j]['lvl']?><br><br>
						<b>Clan : </b><?=ucfirst($coterie[$j]['clan'])?><br>
						<b>Nature : </b><?=$coterie[$j]['nature']?><br>
						<b>Attitude : </b><?=$coterie[$j]['attitude']?><br>
						<b>Concept : </b><?=$coterie[$j]['concept']?><br>
						<b>Défaut : </b><?=$coterie[$j]['defaut']?><br><br>
						<b>Discipline : </b><?=ucfirst($coterie[$j]['nom_discipline'])?><br>
					</div>
				</div>
				<br>
				<img src="img/rpg/pv_<?=$coterie[$j]['pv']?>" class="hpBar">
				<div class="infoPersoCarac logo-carac1"><?=$coterie[$j]['forc']?></div>
				<div class="infoPersoCarac logo-carac2"><?=$coterie[$j]['dexterite']?></div>
				<div class="infoPersoCarac logo-carac3"><?=$coterie[$j]['intelligence']?></div>
				<div class="infoPersoCarac logo-carac4"><?=$coterie[$j]['charisme']?></div>
				<div class="infoPersoCarac logo-carac5"><?=$coterie[$j]['perception']?></div>
				<?php // Séparation uniquement entre chaque perso
				if ($j !== count($coterie)-2) { ?>
					<div class="separate"></div>
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