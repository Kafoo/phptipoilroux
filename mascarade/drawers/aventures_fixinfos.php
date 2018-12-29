<?php 
if ($i == 0) {//Seulement pour le 1er post ?>
	<div class="fixInfos desktop">
		<?php
		for ($j=0; $j < count($coterie); $j++) { 
			if ($coterie[$j]['nom']!=='GM') { //On n'affiche pas le GM ?>
				<div class="infoPersoCoterie-logo">
					<img class="logoCoterie" src="img/icones/perso.png" style="width:30px">
					<div class="infoPersoCoterie" hidden>
						<b>LVL : </b><?=$coterie[$j]['lvl']?><br><br>
						<b>Clan : </b><?=ucfirst($coterie[$j]['clan'])?><br>
						<b>Nature : </b><?=$coterie[$j]['nature']?><br>
						<b>Attitude : </b><?=$coterie[$j]['attitude']?><br>
						<b>Concept : </b><?=$coterie[$j]['concept']?><br>
						<b>Défaut : </b><?=$coterie[$j]['defaut']?><br><br>
						<b>Force : </b><?=$coterie[$j]['forc']?><br>
						<b>Dextérité : </b><?=$coterie[$j]['dexterite']?><br>
						<b>Intelligence : </b><?=$coterie[$j]['intelligence']?><br>
						<b>Charisme : </b><?=$coterie[$j]['charisme']?><br>
						<b>Perception : </b><?=$coterie[$j]['perception']?><br><br>
						<b>Discipline : </b><?=ucfirst($coterie[$j]['nom_discipline'])?><br>
					</div>
				</div>
				<?=$coterie[$j]['nom']?><br>
			<?php	
			} ?>
		<?php
		} ?>
	</div>
	<?php	
}else{ ?>
	<div class='<?=$firstMsgOfPost[0]?>'></div>
<?php }?>