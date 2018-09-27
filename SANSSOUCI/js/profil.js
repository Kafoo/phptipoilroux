$("#navDesk3").addClass("currentNav");

function confirmSupp(){
	if (confirm("Tu es sûr de vouloir supprimer ce perso ?") == false) {
		document.location.href="";
	}