
<div class="ventreBox">
	<h3>Informations générales</h3>
	<table id="formBases">
		<tr>
			<td><label for="persoNom"><b>Nom :</b></label></td>
			<td><input type="text" name="persoNom" placeholder="Nom du perso" maxlength="20" value="<?php if (isset($_POST['persoNom'])){echo $_POST['persoNom'];}else{echo'';}?>"></td>
			<td></td>
		</tr>
		<tr>
			<td><label for="persoNature">Nature :</label></td>
			<td><input type="text" name="persoNature" placeholder="1 adjectif" maxlength="20" value="<?php if (isset($_POST['persoNature'])){echo $_POST['persoNature'];}else{echo'';}?>"></td>
			<td>
				<div class="helpDiv" id="helpNature" hidden>La nature d'un personnage est sa véritable personnalité, ce qu'il est fondamentalement. <br/><i>Exemples : simplet, démoniaque, passionné, intéressé, altruiste, pervers...</i></div>
			</td>
		</tr>
		<tr>
			<td><label for="persoAttitude">Attitude :</label></td>
			<td><input type="text" name="persoAttitude" placeholder="1 adjectif" maxlength="20" value="<?php if (isset($_POST['persoAttitude'])){echo $_POST['persoAttitude'];}else{echo'';}?>"></td>
			<td>
				<div class="helpDiv" id="helpAttitude" hidden>L'attitude d'un personnage est ce qu'il montre de sa personnalité. Plus elle est contraire à sa nature, plus le personnage cache son jeu.<br/><i>Exemples : simplet, démoniaque, passionné, intéressé, altruiste, pervers...</i></div>
			</td>
		</tr>
		<tr>
			<td><label for="persoConcept">Concept :</label></td>
			<td><input type="text" name="persoConcept" placeholder="1 concept" maxlength="20" value="<?php if (isset($_POST['persoConcept'])){echo $_POST['persoConcept'];}else{echo'';}?>"></td>
			<td>
				<div class="helpDiv" id="helpConcept" hidden>Le concept d'un personnage est ce qui prépondère le plus dans sa vie d'humain (avant l'Etreinte) : son métier, sa passion, ou encore sa position sociale.<br/><i>Exemples : drogue addict, charpentier, boxer, hermite...</i></div>
			</td>
		</tr>
		<tr>
			<td><label for="persoDefaut">Défaut :</label></td>
			<td><input type="text" name="persoDefaut" placeholder="Ton défaut" maxlength="30" value="<?php if (isset($_POST['persoDefaut'])){echo $_POST['persoDefaut'];}else{echo'';}?>"></td>

			<td>
				<div class="helpDiv" id="helpDefaut" hidden>Un petit défaut de ton choix, pour donner un peu de réalisme à ton perso !</i></div>
			</td>
		</tr>
	</table>
</div>

<div class="ventreBox">
	<h3>QUEL EST TON HISTOIRE ?</h3>
	<div class="helper">
		<b>C'est ici que tu vas décrire librement ton personnage, ce qu'il a vécu, ce qui fait ce qu'il est aujourd'hui, son physique.</b><br><br>Quel âge a-t-il ? A-t-il un travail, de la famille, des amis ? Est-qu'une cicatrice lui fend le visage, aime-t-il rester seul plutôt qu'entouré ?<br><br>Libre à toi d'écrire 3 lignes, ou un bouquin ;-)
	</div>
	<textarea name="persoLore" placeholder="Allez, raconte-nous tout."><?php if (isset($_POST['persoLore'])){echo $_POST['persoLore'];}else{echo'';}?></textarea>
</div>