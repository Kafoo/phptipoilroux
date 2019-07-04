<h1>AVENTURES</h1>

<div class="container">

	<?php
	$reqAv = $bdd->query("
		SELECT * 
		FROM mas_aventures 
		ORDER BY id");

	//~~~ WHILE AVENTURES ~~~
	while ($row = $reqAv->fetch()) {
		$avID = $row['id'];
		$userID = $_SESSION['id'];
		//On cherche si un personnage du user est dans l'aventure
		$req = $bdd->query("
			SELECT mas_persos.nom
			FROM mas_persos
			JOIN mas_relation_perso2aventure 
			ON mas_persos.id=mas_relation_perso2aventure.persoID
			WHERE mas_relation_perso2aventure.avID='$avID'
			AND mas_persos.userID='$userID';
			");
		//Si oui, $persoOfAv sera défini par le nom de ce perso
		
		$persoOfAv = $req->fetch()['nom']; ?>

		<!-- On affiche l'aventure -->
		<div class="choixAv">
			<span>
				<?=strtoupper($row['nom_aventure'])?>
			</span>
			<?php
			if (isset($persoOfAv)) { ?>
				<a href="aventures.php?avID=<?=$avID?>#pmop" class="goAv">
					Continuer avec <?=$persoOfAv?>
				</a>
			<?php
			}else{ ?>
				<div class="joinPerso">
					Tu veux rejoindre cette aventure avec quel personnage ?<br><br>
					<?php
					$userID = $_SESSION['id'];
					$reqPersos = $bdd->query("
						SELECT nom, id 
						FROM mas_persos 
						WHERE userID='$userID'");
					$persos = $reqPersos->fetchall();
					for ($i=0; $i < count($persos); $i++) { ?> 
						<a href="aventures.php?avID=<?=$avID?>&persoID=<?=$persos[$i]['id']?>">
							<?=$persos[$i]['nom']?>
						</a>
					<?php 
					} ?>
				</div>
				<div class="goAv joinAv">
					<a>
						Rejoindre l'aventure !
					</a>
				</div>
			<?php }?>
		</div>
	<?php }?>
</div>		