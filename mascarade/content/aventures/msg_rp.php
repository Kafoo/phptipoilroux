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
<?php
if ($i == 0) {//Seulement pour le 1er post ?>
	<?php include('drawers/aventures_fixinfos.php');?>
<?php	
}else{ ?>
	<div></div>
<?php }?>