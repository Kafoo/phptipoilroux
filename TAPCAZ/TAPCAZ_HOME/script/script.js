function clickCase(){
	//GENERE UN RANDOM EN FONCTION DU NOMBRE DE CASES
	var nombreCases = document.getElementById('stockCases').innerHTML;
	var oldrandom = document.getElementById('stockRandom').innerHTML;
	var random = Math.floor((Math.random()*nombreCases)+1)
	//GENERE UN NOUVEAU RANDOM TANT QUE CA NE CHANGE PAS
	while (oldrandom==random)
	{
		var random = Math.floor((Math.random()*nombreCases)+1);
	}
	//DEPLACE LE BOUTON A LA NOUVEL CASE (DE POSITION RANDOM)
	var bouton = document.getElementById('boutonCase');
	var td = document.getElementById("case"+random);
	td.appendChild(bouton);
	var oldrandom = document.getElementById('stockRandom');
	oldrandom.innerHTML = random;
	//AJOUTE 1 PAR CLIQUE AU SCORE
	var score = document.getElementById('score').innerHTML;
	var newScore = parseInt(score) +1;
	var score = document.getElementById('score');
	score.innerHTML = newScore;
	var stockScore = document.getElementById('stockScore');
	stockScore.setAttribute("value", newScore);
}



function startChrono (){
	//SUPPRIME LE BOUTON START
	var boutonStart = document.getElementById('boutonStart');
	boutonStart.parentNode.removeChild(boutonStart);
	//AFFICHE LE PREMIER BOUTON A CLIQUER
	document.getElementById("boutonCase").removeAttribute("hidden");
	//LANCE LE CHRONO
	var sec = 1;
	var interChrono = setInterval(chrono, 1000);
	function chrono()
	{
		timer = document.getElementById('timer');
		timer.innerHTML = sec.toFixed(0);

		//FIN DU CHRONO
		if (sec==15.00) {
			var bouton = document.getElementById('boutonCase');
			bouton.parentNode.removeChild(bouton);
			clearInterval(interChrono);
			clearInterval(interChronoDec);
			timerDec = document.getElementById('timerDec');
			timerDec.innerHTML = "00";
			showPseudoForm();
		}
		sec++;
	}

	//SIMULATION DES DECIMALES
	var dec = 1;
	var interChronoDec = setInterval(chronoDec, 10);
	checkSec = 1;
	function chronoDec(){
		timerDec = document.getElementById('timerDec');
		if (checkSec == sec && dec<99) {
			dec=dec+1;
		}
		else{
			dec = 1;
			checkSec = sec;
		}
		if (dec<10) {
			timerDec.innerHTML = "0"+dec.toFixed(0);	
		}
		else{
			timerDec.innerHTML = dec.toFixed(0);		
		}
	}	
}

function showPseudoForm(){
	var pseudoForm = document.getElementById('pseudoForm');
	var table = document.getElementById('table');
	table.innerHTML = "";
	pseudoForm.removeAttribute("hidden");
	table.appendChild(pseudoForm);
}

function showRules(){
	alert("----------- REGLES DE TAPCAZ -----------\n\nC'est un jeu de vitesse !\n\nChoisis la taille de ta grille dans l'encart gauche, et clique sur \"start\" pour lancer le chrono !\nClique le plus rapidement sur les cases vertes qui vont apparaître dans ta grille, tu as 15 secondes pour faire le plus gros score possible.\n\nTu pourras ensuite rentrer ton pseudo pour montrer ton gros kiki dans la page des HighScores !\n\n Enjoy =) ");
}