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

