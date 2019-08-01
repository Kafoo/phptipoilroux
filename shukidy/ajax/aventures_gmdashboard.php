<div class="persoID-stock" hidden><?=$perso->id?></div>
<h3><?=$perso->nom?></h3>
<h4>PV :</h4>
<div class="button operate_update update_lessPV">-</div>
<img src="img/rpg/pv_<?=$perso->pv?>.png" pv_val="<?=$perso->pv?>" class="pvBar" data-toggle="tooltip" data-placement="bottom" title="<?=$perso->pv?>/10 PV">
<div class="button operate_update update_morePV">+</div>
<div> 
	<div class="inventBlock">
		<h4>Inventaire :</h4>
		<table>
			<tr><td><textarea class="inventTextArea invent1_val" placeholder="item 1"><?php if ($perso->invent1 !== '-') {echo $perso->invent1;} ?></textarea></td></tr>
			<tr><td><textarea class="inventTextArea invent2_val" placeholder="item 2"><?php if ($perso->invent2 !== '-') {echo $perso->invent2;} ?></textarea></td></tr>
			<tr><td><textarea class="inventTextArea invent3_val" placeholder="item 3"><?php if ($perso->invent3 !== '-') {echo $perso->invent3;} ?></textarea></td></tr>
			<tr><td><textarea class="inventTextArea invent4_val" placeholder="item 4"><?php if ($perso->invent4 !== '-') {echo $perso->invent4;} ?></textarea></td></tr>
			<tr><td><textarea class="inventTextArea invent5_val" placeholder="item 5"><?php if ($perso->invent5 !== '-') {echo $perso->invent5;} ?></textarea></td></tr>
		</table>
	</div>
	<div class="condBlock">
		<h4>Conditions :</h4>
		<table>
			<tr>
				<td>Force : </td>
				<td><textarea class="condTextArea c1Cond_val"><?php if ($perso->c1Cond >= 0) {echo '+'.$perso->c1Cond;}else{echo $perso->c1Cond;}?></textarea></td>
			</tr>
			<tr>
				<td>Dextérité : </td>
				<td><textarea class="condTextArea c2Cond_val"><?php if ($perso->c2Cond >= 0) {echo '+'.$perso->c2Cond;}else{echo $perso->c2Cond;}?></textarea></td>
			</tr>
			<tr>
				<td>Intelligence : </td>
				<td><textarea class="condTextArea c3Cond_val"><?php if ($perso->c3Cond >= 0) {echo '+'.$perso->c3Cond;}else{echo $perso->c3Cond;}?></textarea></td>
			</tr>
			<tr>
				<td>Charisme : </td>
				<td><textarea class="condTextArea c4Cond_val"><?php if ($perso->c4Cond >= 0) {echo '+'.$perso->c4Cond;}else{echo $perso->c4Cond;}?></textarea></td>
			</tr>
			<tr>
				<td>Perception : </td>
				<td><textarea class="condTextArea c5Cond_val"><?php if ($perso->c5Cond >= 0) {echo '+'.$perso->c5Cond;}else{echo $perso->c15Cond;}?></textarea></td>
			</tr>
		</table>
	</div>
</div>

<table class="xpBlock">
	<tr>
		<td>+ <textarea class="xpTextArea">0</textarea></td>
		<td> XP</td>
	</tr>
</table>


<div class="updatePerso_submit button">Enregistrer<span class="updatePerso_loading"></span></div>