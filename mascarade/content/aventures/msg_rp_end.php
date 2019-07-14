	<!-- Options d'édition et suppression -->

	<?php
	if ($lastMsgID == $msg['id'] AND $lastIsUser == True) { ?>

		<div class="editMsg desktop button" msgid="<?=$msg['id']?>">
			edit
		</div>
		<div class="msgOption mobile button">
			+
		</div>
		<div class="suppMsg mobile button" ajax='?action=suppMsg&msgID=<?=$msg['id']?>' msgid="<?=$msg['id']?>" >
			supp
		</div>
		<div class="editMsg mobile button" msgid="<?=$msg['id']?>">
			edit
		</div>

		<!-- Bloc d'édition -->
		<div class="editMsgBloc" hidden>
			<form method="POST" action="">
				<input type="text" name="msgID" value="<?=$msg['id']?>" hidden>
				<textarea class="editMsgArea mytextarea" id="<?=$msg['id']?>" name="editedMsg"></textarea>
				<input type="submit" name="editSubmit" class="editMsgSubmit" msgid="<?=$msg['id']?>" value="J'édite mon message !">
			</form>
		</div>

	<?php
	}
	?>

</div>
