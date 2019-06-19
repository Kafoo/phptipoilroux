<!------ AVATAR ------>
<div class="writerAvatarSlider <?=$firstMsgOfPost[0]?>">
	<div class="writerAvatar <?php if($firstMsgOfPost['nom']=='GM'){echo'GM';} ?>" style="background-image: url(img/avatars/<?php
	//Si GM, avatar générique de GM
	if ($firstMsgOfPost['nom']=='GM'){echo'GM';}
	else{echo $firstMsgOfPost['persoID'];}
	?>.jpg);">
		<div class="layer desktop">
			<b><u><?=strtoupper($firstMsgOfPost['nom'])?></u><br><br>
			<?=$firstMsgOfPost['pseudo']?></b><br>
			<?=$firstMsgOfPost['nombremsg']?> messages<br>
			(<?=$firstMsgOfPost['grade']?>)<br><br>
			<?php $date = explode('--', $firstMsgOfPost['dat']);?>
			<i>le <?=$date[0]?><br>
			à <?=$date[1]?></i>
		</div>
		<div class="layer mobile" hidden>									
			<img src="img/mobile/croix.png" class="croixAvatar">
			<span class="nomPerso">
				<?=strtoupper($firstMsgOfPost['nom'])?>
			</span><br><br>
				<table class="carac">
					<tr>
						<td>Force :</td><td><?=$firstMsgOfPost['c1']?></td>
					</tr>
					<tr>
						<td>Dextérité :</td><td><?=$firstMsgOfPost['c2']?></td>
					</tr>
					<tr>
						<td>Intelligence :</td><td><?=$firstMsgOfPost['c3']?></td>
					</tr>
					<tr>
						<td>Charisme :</td><td><?=$firstMsgOfPost['c4']?></td>
					</tr>
					<tr>
						<td>Perception :</td><td><?=$firstMsgOfPost['c5']?></td>
					</tr>
				</table>
				<div class="layerBox">
					<b><?=ucfirst($firstMsgOfPost['clan'])?></b><br>
					<b>LVL : </b><?=$firstMsgOfPost['lvl']?><br><br>
					<?=$firstMsgOfPost['nature']?><br>
					/<?=$firstMsgOfPost['attitude']?><br><br>
				</div>
				<div class="centering layerBox">
					<b>Concept : </b><br><?=$firstMsgOfPost['concept']?><br>
					<b>Défaut : </b><br><?=$firstMsgOfPost['defaut']?><br>
				</div>
				<div class="layerBottom">
					<b>Auteur : </b><?=$firstMsgOfPost['pseudo']?><br>
					<i><?=$firstMsgOfPost['nombremsg']?> messages<br>
					(<?=$firstMsgOfPost['grade']?>)</i><br>
				</div>
				<img class="msg-logo" src="img/icones/msg.png">
		</div>
	</div>
</div>	

<!------ MESSAGE ------>

<div class="msg <?=$firstMsgOfPost[0]?> <?php if($firstMsgOfPost['nom']=='GM'){echo'msgGM';} ?>">
	<!-- date -->
	<div class="dateMsg mobile">
		<?=$firstMsgOfPost['pseudo']?>, 
		<?php
		$date = explode('--', $firstMsgOfPost['dat']);
		echo 'le '.$date[0].' à '.$date[1]?>
	</div>


	<?php // On compte le nombre de messages dans le post
	$msgCount = count($msgOfPost);
	 // On stock ce nombre pour le Javascript ?>
	<div hidden class="msgCount" msgcount="<?=$msgCount?>"></div>


	<!-- Contenu du message -->

	<!-- Messages du même perso, mis à la suite -->
	<?php

	$k = 0;
	foreach ($msgOfPost as $msgOfPostID) {
		$msgInfo = $msgS[$msgOfPostID];
		//Check si lastMsgOfPost
		if ($k==$msgCount-1) {$last=True;}
		else {$last=False;}

		//Si on est entre 2 messages et qu'aucun des 2 n'est un jet de dés, on met un séparateur
		if ($k>0
			AND $msgInfo['type']!=='diceRoll_player'
			AND $msgS[$msgOfPostID-1]['type']!=='diceRoll_player') { ?>
			<div class="separate <?php if ($last==True){echo "lastSepOfPost";} ?>"></div>
		<?php
		}

		if ($msgInfo['type'] == 'diceRoll_player') {
			include ("drawers/aventures_messages_diceroll_player.php");			
		}
		if ($msgInfo['type'] == 'RP') { ?>
			<span <?php if ($last==True){echo "class='lastMsgOfPost'";} ?> >
				<?=htmlspecialchars_decode(nl2br($msgInfo['contenu']))?>
			</span>

		<?php
		}
		$k++;
	}
	?>
	<!-- Options d'édition et suppression -->

	<?php
	if ($msgInfo[0] == $lastMsgID AND $msgInfo['type'] == 'RP') { ?>
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


	<?php if($i==count($postArray)-2){ ?>
		<div id="pmop"></div>
	<?php
	}?>
</div>

<!------ FIXINFO ------>
<?php include('drawers/aventures_fixinfos.php');?>