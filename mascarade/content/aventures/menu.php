<h1>AVENTURES</h1>

<div class="container">

	<?php
	$reqAv = $bdd->query("
		SELECT 
		av.id as avID, av.nom_aventure, av.gmID,
		univ.name, univ.id as univID
		FROM mas_aventures as av
		INNER JOIN mas_univers as univ
		ON av.univID = univ.id
		ORDER BY av.id");

	//~~~ WHILE AVENTURES ~~~
	while ($row = $reqAv->fetch()) {
		$avID = $row['avID'];
		$univID = $row['univID'];
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
				<a href="aventures.php?avID=<?=$avID?>#lpop" class="goAv">
					Continuer avec <?=$persoOfAv?>
				</a>
			<?php
			}else{ ?>
				<div class="goAv joinAv">
					<a>
						Rejoindre l'aventure !
					</a>
				</div>
				<div class="joinPerso" hidden>


					<?php
					$userID = $_SESSION['id'];
					$req = $bdd->query("
						SELECT nom, id 
						FROM mas_persos 
						WHERE userID='$userID'
						AND univID='$univID'
						");
					$persos = $req->fetchall();

					if (count($persos) > 0) {
						echo "<h4>Rejoindre l'aventure avec :</h4><br>";
						foreach ($persos as $perso) { ?>
							<a href="aventures.php?avID=<?=$avID?>&persoID=<?=$perso['id']?>">
								<?=$perso['nom']?>
							</a>
							<br>
						<?php
						} 
					}else{
						echo "Tu n'as pas encore de perso correspondant à cet univers<br><br>";
					} ?>
					<br>
					<a href="creaperso.php?avID=<?=$avID?>&userID=<?=$userID?>">Créer un nouveau perso</a>



				</div>
			<?php }?>
			<div style="font-size: 15px; margin-top: 5px;">Univers : <?=$row['name']?></div>
		</div>
	<?php }?>
</div>		