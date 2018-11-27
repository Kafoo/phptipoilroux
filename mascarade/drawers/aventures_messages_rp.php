<?php
if ($info['type'] === 'RP'){ ?>

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
		<!-- Options d'édition et suppression -->
		<?php if ($info[0] == $lastMsgID) { ?>
			<div class="suppMsg desktop button" ajax='?action=suppMsg&msgID=<?=$info[0]?>' msgid="<?=$info[0]?>">
				x
			</div>
			<div class="editMsg desktop button" msgid="<?=$info[0]?>">
				edit
			</div>
			<div class="msgOption mobile button">
				+
			</div>
			<div class="suppMsg mobile button" ajax='?action=suppMsg&msgID=<?=$info[0]?>' msgid="<?=$info[0]?>" >
				supp
			</div>
			<div class="editMsg mobile button" msgid="<?=$info[0]?>">
				edit
			</div>
		<?php
		} ?>
		<!-- Contenu du message -->
		<span class="contenuMsg">
			<?=htmlspecialchars_decode(nl2br($info['contenu']))?>
		</span>
		<!-- Bloc d'édition -->
		<div class="editMsgBloc" hidden>
			<form method="POST" action="">
				<input type="text" name="msgID" value="<?=$info[0]?>" hidden>
				<textarea class="editMsgArea mytextarea" id="<?=$info[0]?>" name="editedMsg"></textarea>
				<input type="submit" name="editSubmit" class="editMsgSubmit" msgid="<?=$info[0]?>" value="J'édite mon message !">
			</form>
		</div>
		<?php if($i==count($infoAv)-2){ ?>
			<div id="pmop"></div>
		<?php
		}?>
	</div>

	<!------ FIXINFO ------>
	<?php include('drawers/aventures_fixinfos.php');?>

<?php
} ?>