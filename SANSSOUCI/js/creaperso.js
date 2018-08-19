//var valCarac = document.getElementById('yo');
//var outputCarac = document.getElementsByClassName("valCarac");
//outputCarac.innerHTML = valCarac.value;

//valCarac.oninput = function(){
//	outputCarac.innerHTML = this.value;
//}

function change(carac){
	//Change la valeur affichée devant chaque caractéristique
	var displayCarac = $("#display"+carac);
	var valCarac = $("#val"+carac).val();
	displayCarac.html(valCarac);
	//Compte le total des carac et l'affiche dans total
	var arrayCarac = $(".displayCarac");
	var count = 0;
	for (var i = 0; i < arrayCarac.length; i++) {
		var add = arrayCarac[i].innerHTML;
		count = count + Number(add);
	}
	$("#totalCarac").html(count);
	//Change la couleur du total en fonction de l'objectif
	var objectif = 25; 
	if (count < objectif) {
		$("#totalCarac").css("color", "blue");
	}
	if (count > objectif) {
		$("#totalCarac").css("color", "red");
	}
	if (count == objectif) {
		$("#totalCarac").css("color", "green");
	}
}



function showHelp(x){
	document.getElementById("help"+x).removeAttribute("hidden");
}

function hideHelp(x){
	document.getElementById("help"+x).setAttribute("hidden", true);
}


function show(what,source,info){

	/*Cache le Fixe*/
	var shown = document.querySelectorAll("div["+what+"Shown]");
	shown[0].setAttribute("hidden", true);
	/*Affiche ce sur quoi l'utilisateur a la souris*/
	var tempShown = document.getElementById(info);
	tempShown.removeAttribute("hidden");
	/*Met l'icone selectionnée en gris*/
	document.getElementById(source).style.backgroundColor = "lightgrey";
}

function hide(what,source,info){

	/*Cache le tempShown*/
	var tempShown = document.getElementById(info);
	tempShown.setAttribute("hidden", true);
	/*Raffiche le Fixe*/
	var shown = document.querySelectorAll("div["+what+"Shown]");
	shown[0].removeAttribute("hidden");
	/*Remet l'icone en transparent*/
	document.getElementById(source).style.backgroundColor = "transparent";
}

function choose(what,choix){

	/*Cache le Fixe définitivement */
	var oldShown = document.querySelectorAll("div["+what+"Shown]");
	oldShown[0].setAttribute("hidden", true);
	oldShown[0].removeAttribute(what+"Shown");
	/*Défini un nouveau Fixe*/
	newShown = document.getElementById("info"+choix);
	newShown.removeAttribute("hidden");
	newShown.setAttribute(what+"Shown", true);
	/*Enlève le contour et l'attribut currentLogo du choix précédent*/
	var oldCurrent = document.querySelectorAll("div[current"+what+"Logo]");
	oldCurrent[0].style.boxShadow = "inset 0 0 10px 1px black";
	oldCurrent[0].removeAttribute("current"+what+"Logo");
	/*Applique l'attribut au nouveau currentLogo*/
	var newCurrent = document.getElementById("logo"+choix);
	newCurrent.setAttribute("current"+what+"Logo", true);
	newCurrent.style.boxShadow = "inset 0 0 30px 1px white";
}