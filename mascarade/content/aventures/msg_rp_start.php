<!------ AVATAR ------>
<?php
foreach ($coterie as $key => $perso) {
	if ($perso[0] == $msg['persoID']) {
		$persoKey = $key;
	}
}
$perso = $coterie[$persoKey];
?>
<div class="writerAvatarSlider <?=$msg[0]?>"
	<?php if($LPOP==True){echo'id = "lpop"';}?>>
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
			<a href="profil.php?persoID=<?=$perso['nom']?>" class="nomPerso">
				<?=strtoupper($perso['nom'])?>
			</a><br><br>
				<table class="carac">
					<tr>
						<td>Force :</td><td><?=$perso['c1']?></td>
					</tr>
					<tr>
						<td>Dextérité :</td><td><?=$perso['c2']?></td>
					</tr>
					<tr>
						<td>Intelligence :</td><td><?=$perso['c3']?></td>
					</tr>
					<tr>
						<td>Charisme :</td><td><?=$perso['c4']?></td>
					</tr>
					<tr>
						<td>Perception :</td><td><?=$perso['c5']?></td>
					</tr>
				</table>
				<div class="layerBox">
					<b><?=ucfirst($perso['clan'])?></b><br>
					<b>LVL : </b><?=$perso['lvl']?><br><br>
					<?=$perso['nature']?><br>
					/<?=$perso['attitude']?><br><br>
				</div>
				<div class="centering layerBox">
					<b>Concept : </b><br><?=$perso['concept']?><br>
					<b>Défaut : </b><br><?=$perso['defaut']?><br>
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