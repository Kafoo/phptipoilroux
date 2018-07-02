function showPrompt(){
	var result = prompt('yo');
	if (result == ""){
		var titre = document.getElementById('titre');
		titre.innerHTML = "vide";
	}	
	else if (result == null){
		var titre = document.getElementById('titre');
		titre.innerHTML = "null";
	}
	else{
		var titre = document.getElementById('titre');
		titre.innerHTML = result;
	}
}