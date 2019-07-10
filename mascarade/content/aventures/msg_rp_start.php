<!------ AVATAR ------>
<div class="writerAvatarSlider <?=$msg[0]?>">
	<div class="writerAvatar <?php if($msg['nom']=='GM'){echo'GM';} ?>" style="background-image: url(img/avatars/<?php
	//Si GM, avatar générique de GM
	if ($msg['nom']=='GM'){echo'GM';}
	else{echo $msg['persoID'];}
	?>.jpg);">
		<div class="layer desktop">
			<b><u><?=strtoupper($msg['nom'])?></u><br><br>
			<?=$msg['pseudo']?></b><br>
			<?=$msg['nombremsg']?> messages<br>
			(<?=$msg['grade']?>)<br><br>
			<?php $date = explode('--', $msg['dat']);?>
			<i>le <?=$date[0]?><br>
			à <?=$date[1]?></i>
		</div>
		<div class="layer mobile" hidden>									
			<img src="img/mobile/croix.png" class="croixAvatar">
			<span class="nomPerso">
				<?=strtoupper($msg['nom'])?>
			</span><br><br>
				<table class="carac">
					<tr>
						<td>Force :</td><td><?=$msg['c1']?></td>
					</tr>
					<tr>
						<td>Dextérité :</td><td><?=$msg['c2']?></td>
					</tr>
					<tr>
						<td>Intelligence :</td><td><?=$msg['c3']?></td>
					</tr>
					<tr>
						<td>Charisme :</td><td><?=$msg['c4']?></td>
					</tr>
					<tr>
						<td>Perception :</td><td><?=$msg['c5']?></td>
					</tr>
				</table>
				<div class="layerBox">
					<b><?=ucfirst($msg['clan'])?></b><br>
					<b>LVL : </b><?=$msg['lvl']?><br><br>
					<?=$msg['nature']?><br>
					/<?=$msg['attitude']?><br><br>
				</div>
				<div class="centering layerBox">
					<b>Concept : </b><br><?=$msg['concept']?><br>
					<b>Défaut : </b><br><?=$msg['defaut']?><br>
				</div>
				<div class="layerBottom">
					<b>Auteur : </b><?=$msg['pseudo']?><br>
					<i><?=$msg['nombremsg']?> messages<br>
					(<?=$msg['grade']?>)</i><br>
				</div>
				<img class="msg-logo" src="img/icones/msg.png">
		</div>
	</div>
</div>	

<!------ MESSAGE ------>

<div class="msg <?=$msg[0]?> <?php if($msg['nom']=='GM'){echo'msgGM';} ?>">
	<!-- date -->
	<div class="dateMsg mobile">
		<?=$msg['pseudo']?>, 
		<?php
		$date = explode('--', $msg['dat']);
		echo 'le '.$date[0].' à '.$date[1]?>
	</div>