$("#navDesk2").addClass("currentNav");

$(".confirm").on('click', function () {
	return confirm("Tu es sûr de vouloir supprimer ce message ? C'est définitif !");
});


$(".joinAv").on('click', function () {
	var pseudo = $("#activePersoStock").text();
	return confirm("Tu veux rejoindre cette aventure avec ton perso actif ("+pseudo+") ?");
});
