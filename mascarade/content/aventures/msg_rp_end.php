	<!-- Options d'édition et suppression -->

	<?php
	if ($lastMsgID == $msg['id'] AND $lastIsUser == True) { ?>

		<div class="editMsg button" msgid="<?=$msg['id']?>">
			edit
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
