<!------ AVATAR ------>
<div class="writerAvatarSlider <?=$info[0]?>">
	<div class="writerAvatar <?php if($info['nom']=='GM'){echo'GM';} ?>" style="background-image: url(img/avatars/<?php
	//Si GM, avatar générique de GM
	if ($info['nom']=='GM'){echo'GM';}
	else{echo $info['persoID'];}
	?>.jpg);">
		<div class="layer desktop">
			<b><u><?=strtoupper($info['nom'])?></u><br><br>
			<?=$info['pseudo']?></b><br>
			<?=$info['nombremsg']?> messages<br>
			(<?=$info['grade']?>)<br><br>
			<?php $date = explode('--', $info['dat']);?>
			<i>le <?=$date[0]?><br>
			à <?=$date[1]?></i>
		</div>
		<div class="layer mobile" hidden>									
			<img src="img/mobile/croix.png" class="croixAvatar">
			<span class="nomPerso">
				<?=strtoupper($info['nom'])?>
			</span><br><br>
				<table class="carac">
					<tr>
						<td>Force :</td><td><?=$info['forc']?></td>
					</tr>
					<tr>
						<td>Dextérité :</td><td><?=$info['dexterite']?></td>
					</tr>
					<tr>
						<td>Intelligence :</td><td><?=$info['intelligence']?></td>
					</tr>
					<tr>
						<td>Charisme :</td><td><?=$info['charisme']?></td>
					</tr>
					<tr>
						<td>Perception :</td><td><?=$info['perception']?></td>
					</tr>
				</table>
				<div class="layerBox">
					<b><?=ucfirst($info['clan'])?></b><br>
					<b>LVL : </b><?=$info['lvl']?><br><br>
					<?=$info['nature']?><br>
					/<?=$info['attitude']?><br><br>
				</div>
				<div class="centering layerBox">
					<b>Concept : </b><br><?=$info['concept']?><br>
					<b>Défaut : </b><br><?=$info['defaut']?><br>
				</div>
				<div class="layerBottom">
					<b>Auteur : </b><?=$info['pseudo']?><br>
					<i><?=$info['nombremsg']?> messages<br>
					(<?=$info['grade']?>)</i><br>
				</div>
				<img class="msg-logo" src="img/icones/msg.png">
		</div>
	</div>
</div>	

<!------ MESSAGE ------>

<div class="msg <?=$info[0]?> <?php if($info['nom']=='GM'){echo'msgGM';} ?>">
	<!-- date -->
	<div class="dateMsg mobile">
		<?=$info['pseudo']?>, 
		<?php
		$date = explode('--', $info['dat']);
		echo 'le '.$date[0].' à '.$date[1]?>
	</div>


	<?php // On compte le nombre de messages dans le post
	$msgCount = 0;
	for ($k=0; $k<6 ; $k++) {
		if (isset($infoAv[floatval($i)+$k]['persoID']) AND $infoAv[floatval($i)+$k]['persoID'] == $info['persoID']) {
			$msgCount ++;
		}
	} // On stock ce nombre pour le Javascript ?>
	<div hidden class="msgCount" msgcount="<?=$msgCount?>"></div>


	<!-- Contenu du message -->

	<!-- Messages du même perso, mis à la suite -->
	<?php
	for ($k=0; $k < $msgCount; $k++) {
		if ($k>0) {
			echo "<div style='height: 10px;''></div>";
		}
		if (isset($infoAv[floatval($i)+$k-1]) 
			AND $infoAv[floatval($i)+$k-1]['type'] == 'RP'
			AND $infoAv[floatval($i)+$k]['type'] == 'RP'
			AND $k > 0) { ?>
			<div class="separate <?php if ($k==$msgCount-1){echo "lastSepOfPost";} ?>"></div>
		<?php
		}
		if ($k>0) {
			echo "<div style='height: 10px;''></div>";
		}
		if ($infoAv[floatval($i)+$k]['type'] == 'diceRoll_player') {
			$info = $infoAv[floatval($i)+$k];
			include ("drawers/aventures_messages_diceroll_player.php");			
		}
		if ($infoAv[floatval($i)+$k]['type'] == 'RP') { ?>
			<span <?php if ($k==$msgCount-1){echo "class='lastMsgOfPost'";} ?> >					
				<?=htmlspecialchars_decode(nl2br($infoAv[floatval($i)+$k]['contenu']))?>
			</span>
		<?php	
		}
		$msgInARow ++;
	}
	$msgInARow --;
	?>
	<!-- Options d'édition et suppression -->

	<?php
	if ($infoAv[$i+$msgInARow][0] == $lastMsgID) { ?>
		<div class="suppMsg desktop button" ajax='?action=suppMsg&msgID=<?=$lastMsgID?>' msgid="<?=$lastMsgID?>">
			x
		</div>
		<div class="editMsg desktop button" msgid="<?=$lastMsgID?>">
			edit
		</div>
		<div class="msgOption mobile button">
			+
		</div>
		<div class="suppMsg mobile button" ajax='?action=suppMsg&msgID=<?=$lastMsgID?>' msgid="<?=$lastMsgID?>" >
			supp
		</div>
		<div class="editMsg mobile button" msgid="<?=$lastMsgID?>">
			edit
		</div>

	<!-- Bloc d'édition -->
	<div class="editMsgBloc" hidden>
		<form method="POST" action="">
			<input type="text" name="msgID" value="<?=$lastMsgID?>" hidden>
			<textarea class="editMsgArea mytextarea" id="<?=$lastMsgID?>" name="editedMsg"></textarea>
			<input type="submit" name="editSubmit" class="editMsgSubmit" msgid="<?=$lastMsgID?>" value="J'édite mon message !">
		</form>
	</div>
	<?php
	} ?>


	<?php if($i==count($infoAv)-2){ ?>
		<div id="pmop"></div>
	<?php
	}?>
</div>

<!------ FIXINFO ------>
<?php include('drawers/aventures_fixinfos.php');?>