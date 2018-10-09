$("#navDesk2").addClass("currentNav");

$(".confirm").on('click', function () {
	return confirm("Tu es sûr de vouloir supprimer ce message ? C'est définitif !");
});

/*
$(".joinAv").on('click', function () {
	var pseudo = $("#activePersoStock").text();
	return confirm("Tu veux rejoindre cette aventure avec ton perso actif ("+pseudo+") ?");
});
*/

$(".joinAv").on('click', function () {
	var pseudo = $("#activePersoStock").text();
	alert("Patieeeeence, Work in Progress, Je vous envoie un petit message sur Facebook quand c'est prêt =P");
	return false;
});



function showInfo(who){
	$("#info"+who).removeAttr("hidden");
}

function hideInfo(who){
	$("#info"+who).attr("hidden", "true");
}

