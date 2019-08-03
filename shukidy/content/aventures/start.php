<?php

$avID = $_GET['avID'];

//-------------- INFOS PERSONNAGES & USERS --------------

//On met tous les persos présents et leurs infos dans $coterie
$req = $bdd->query("
	SELECT *
	FROM mas_persos
	JOIN mas_relation_perso2aventure
	ON mas_persos.id=mas_relation_perso2aventure.persoID
	LEFT JOIN mas_leveling
	ON mas_persos.lvl=mas_leveling.id
	JOIN mas_users
	ON mas_persos.userID = mas_users.id
	WHERE mas_relation_perso2aventure.avID = '$avID'
	");
$coterie = $req->fetchall();

//PERSOS OBJETS

setObjectPersos($avID);


//On identifie le GM de cette coterie et on le met dans $GMID
foreach ($coterie as $perso) {
	if ($perso['nom'] == 'GM') {
		$GMID = $perso['userID'];
	}
}

//On check si le perso du user est déjà dans l'aventure
$userID = $_SESSION['id'];
$userInAv = False;
foreach ($coterie as $perso) {
	if ($perso['userID'] == $userID) {
		$userInAv = True;
		$persoID = $perso[0];
	}
}


//Si non et qu'il rejoint, on l'ajoute :
if ($userInAv == False){
	$persoID = $_GET['persoID'];
	$bdd->query("
		INSERT INTO mas_relation_perso2aventure (persoID, avID)
		VALUES ('$persoID','$avID') ");
}


//--------------INFOS AVENTURE&UNIVERS--------------

$req = $bdd->query("
	SELECT
	av.nom_aventure, av.gmID, av.writerID,
	univ.name, univ.c1_name, univ.c2_name, univ.c3_name, univ.c4_name, univ.c5_name
	FROM mas_aventures as av
	INNER JOIN mas_univers as univ
	ON av.univID = univ.id
	WHERE av.id = '$avID'
	");
$avInfos = $req->fetch();

//--------------INFOS MESSAGES--------------


$req = $bdd->query("
	SELECT 
	ent.id, ent.type, ent.dat, ent.persoID, ent.postID,
	av.nom_aventure, av.gmID,
	perso.nom, perso.c1, perso.c2, perso.c3, perso.c4, perso.c5,
	perso.c1Cond, perso.c2Cond, perso.c3Cond, perso.c4Cond, perso.c5Cond,
	user.pseudo, user.grade, user.nombremsg, user.id as userID,
	rp.content as content_rp,
	dr.title, dr.caracID, dr.caracVal, dr.caracCond, dr.difficulty, dr.result, dr.GM,
	log.content as content_log
	FROM mas_av_entries as ent
	LEFT JOIN mas_aventures as av
	ON ent.avID = av.id
	LEFT JOIN mas_persos as perso
	ON ent.persoID = perso.id
	LEFT JOIN mas_users as user
	ON perso.userID = user.id
	LEFT JOIN mas_av_rp as rp
	ON ent.id = rp.entryID
	LEFT JOIN mas_av_dicerolls as dr
	ON ent.id = dr.entryID
	LEFT JOIN mas_av_log as log
	ON ent.id = log.entryID
	WHERE ent.avID = '$avID'
	ORDER BY ent.id ASC
	");
$allMsg = $req->fetchall();

//On cherche si le user est le GM
if ($avInfos['gmID'] == $userID) {
	$_SESSION['GM'] = "1";
} else {
	$_SESSION['GM'] = "0";
}

//On récupère le dernier message rp du joueur, pour l'édition/suppression
$lastMsgID;
foreach ($allMsg as $key => $msg) {
	if ($msg['type'] == 'rp' AND $msg['userID'] == $userID) {
		$lastMsgID = $msg['id'];
	}
}

//On vérifie si le dernier message posté est RP et est celui du user
foreach ($allMsg as $key => $msg) {
	if ($msg['type'] == 'rp' AND $msg['userID'] == $userID) {
		$lastIsUser = True;
	}else{
		$lastIsUser = False;
	}
}


//--------------PAGINATION--------------

$postsParPage = 6;
$nbrPosts = end($allMsg)['postID'];
$nbrPages = ceil($nbrPosts/$postsParPage);

//On défini la page courante
if (isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page'] > 0) {
	$_GET['page']=intval($_GET['page']);
	$currentPage = $_GET['page'];
}else{
	$currentPage = $nbrPages;
}

//On défini où on en est sur cette page
$lastPostOfPage = ($currentPage)*$postsParPage;
$firstPostOfPage = $lastPostOfPage - $postsParPage + 1;

//--------------caracOfAv--------------
//(à terme, regrouper ça avec une array "avInfo" générale)

$req = $bdd->query("
	SELECT 
	c1_name,
	c2_name,
	c3_name,
	c4_name,
	c5_name
	FROM mas_aventures
	INNER JOIN mas_univers
	ON mas_aventures.univID = mas_univers.id
	WHERE mas_aventures.id = '$avID'
	");

$_SESSION['caracOfAv'] = $req->fetch();
$caracOfAv = $_SESSION['caracOfAv'];

?>