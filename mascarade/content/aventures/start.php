<?php

//On check si un perso du user est déjà dans l'aventure
			$avID = $_GET['avID'];
			$userID = $_SESSION['id'];
			$req = $bdd->query("
				SELECT *
				FROM mas_relation_perso2aventure
				JOIN mas_persos
				ON mas_relation_perso2aventure.persoID=mas_persos.id
				WHERE mas_persos.userID='$userID'
				AND mas_relation_perso2aventure.avID='$avID'");
			$res = $req->fetchall();
			//Si non et qu'il rejoint, on l'ajoute :
			if (count($res)==0 
				AND isset($_GET['persoID'])){
				$persoID = $_GET['persoID'];
				$bdd->query("
					INSERT INTO mas_relation_perso2aventure (persoID, avID)
					VALUES ('$persoID','$avID') ");
			//Si oui, on défini quand même le $persoID
			}else{
				$persoID = $res[0]['persoID'];
			}

			$avID = $_GET['avID'];

			//PAGINATION
			$postsParPage = 6;
			$req = $bdd->query("SELECT DISTINCT postID FROM mas_messages_aventure WHERE avID='$avID'");
			$NbrMessages = $req->rowCount();
			$NbrPages = ceil($NbrMessages/$postsParPage);
			//On défini la page courante
			if (isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page'] > 0) {
				$_GET['page']=intval($_GET['page']);
				$currentPage = $_GET['page'];
			}else{
				$currentPage = $NbrPages;
			}
			//On défini où on en est sur cette page
			$start = ($currentPage-1)*$postsParPage;

			//On met toutes les infos de chaque message de la page dans $msgS
			$req = $bdd->query("
				SELECT DISTINCT postID 
				from mas_messages_aventure 
				ORDER BY postID 
				LIMIT ".$start.",".$postsParPage."
				");
			$postArray = $req->fetchall(PDO::FETCH_COLUMN, 0);
			$postString = implode("', '", $postArray);

			$req = $bdd->query("
				SELECT *
				FROM mas_messages_aventure
				LEFT JOIN mas_persos ON mas_messages_aventure.persoID = mas_persos.id
				LEFT JOIN mas_membres ON mas_persos.userID=mas_membres.id
				LEFT JOIN mas_aventures ON mas_messages_aventure.avID = mas_aventures.id
				WHERE avID= '$avID'
				AND postID IN ('$postString')
				ORDER BY postID
				");
			$msgS = $req->fetchall();

			//On cherche si le user est le GM
			if ($msgS[0]['gmID'] == $userID) {
				$_SESSION['GM'] = "1";
			} else {
				$_SESSION['GM'] = "0";
			}

			//On récupère le dernier message du joueur, pour l'édition/suppression
			$req = $bdd->query("
				SELECT *
				FROM mas_messages_aventure
				WHERE avID= '$avID' AND auteurID='$userID'
				ORDER BY mas_messages_aventure.id DESC ");
			$lastMsgID = $req->fetch()[0];

			//On vérifie si le dernier message posté est celui du user actif

			$req = $bdd->query("
				SELECT *
				FROM mas_messages_aventure
				WHERE avID= '$avID'
				ORDER BY mas_messages_aventure.id DESC ");
			$res = $req->fetch();
			if ($res['auteurID'] == $userID) {
				$lastIsUser = True;
			}else{
				$lastIsUser = False;
			}

			//On met les différentes caractéristique dans $caracOfUniv
			$req = $bdd->query("
				SELECT *
				FROM mas_carac
				ORDER BY id");
			$caracOfUniv = $req->fetchall();

			//On met tous les persos présents et leurs infos dans $coterie
			$req = $bdd->query("
				SELECT * 
				FROM mas_persos
				JOIN mas_relation_perso2aventure
				ON mas_persos.id=mas_relation_perso2aventure.persoID
				LEFT JOIN mas_disciplines
				ON mas_persos.discID=mas_disciplines.id
				LEFT JOIN mas_leveling
				ON mas_persos.lvl=mas_leveling.id
				WHERE mas_relation_perso2aventure.avID = 25
				");
			$coterie = $req->fetchall();

			//PERSOS OBJETS

			setObjectPersos();
			
			//On identifie le GM de cette coterie et on le met dans $GMID
			foreach ($coterie as $perso) {
				if ($perso['nom'] == 'GM') {
					$GMID = $perso['userID'];
				}
			}

			?>