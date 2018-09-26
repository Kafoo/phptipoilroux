$("#navDesk1").addClass("currentNav");

var infos = {
	gg :"Jyhad jyhad jyhad jyhad jyhad jyhad jyhad jyhad jyhad jyhad jyhad jyhad jyhad jyhad jyhad jyhad jyhad jyhad jyhad jyhad jyhad jyhad jyhad jyhad jyhad jyhad jyhad jyhad jyhad jyhad jyhad jyhad jyhad jyhad jyhad jyhad jyhad jyhad jyhad jyhad jyhad jyhad jyhad jyhad jyhad jyhad jyhad jyhad jyhad jyhad jyhad jyhad jyhad jyhad jyhad jyhad ",
	g : "Vampires vampires vampires vampires vampires vampires vampires vampires vampires vampires vampires vampires vampires vampires vampires vampires vampires vampires vampires vampires vampires vampires vampires vampires vampires vampires vampires vampires vampires vampires vampires vampires vampires vampires vampires",
	c : "Univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers univers ",
	d : "Gehenne géhenne géhenne géhenne géhenne géhenne géhenne géhenne géhenne géhenne géhenne géhenne géhenne géhenne géhenne géhenne géhenne géhenne géhenne géhenne géhenne géhenne géhenne géhenne géhenne géhenne géhenne géhenne géhenne géhenne géhenne géhenne géhenne géhenne géhenne géhenne géhenne géhenne géhenne géhenne géhenne ",
	dd : "Vous vous vous vous vous vous vous vous vous vous vous vous vous vous vous vous vous vous vous vous vous vous vous vous vous vous vous vous vous vous vous vous vous vous vous vous vous vous vous vous vous vous vous vous vous vous vous vous vous vous vous vous vous vous vous vous vous vous vous vous vous vous vous vous vous vous "
}



function choose(what){


	$("#infosAccueil").text(infos[what]);

	$(".currentOnglet").removeClass("currentOnglet");

	$("#onglet"+what).addClass("currentOnglet");



}