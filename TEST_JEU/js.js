function clickCase()
{
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
	var node = document.getElementById('boutonCase');
	var td = document.getElementById("case"+random);
	td.appendChild(node);
	var oldrandom = document.getElementById('stockRandom');
	oldrandom.innerHTML = random;
	//AJOUTE 1 PAR CLIQUE AU SCORE
	var score = document.getElementById('stockScore').innerHTML;
	var newScore = parseInt(score) +1;
	var stockScore = document.getElementById('stockScore');
	stockScore.innerHTML = newScore;
}



function startChrono (){
	//SUPPRIME LE BOUTON START
	var start = document.getElementById('start');
	start.innerHTML = "";
	//AFFICHE LE PREMIER BOUTON A CLIQUER
	document.getElementById("boutonCase").removeAttribute("hidden");
	//LANCE LE CHRONO
	var sec = 1;
	var interChrono = setInterval(chrono, 1000);
	function chrono()
	{
		timer = document.getElementById('timer');
		timer.innerHTML = sec;
		//FIN DU CHRONO
		if (sec==15) {
			var blockTimer = document.getElementById("blockTimer");
			blockTimer.innerHTML = "Bravo !";
			alert ("Terminé !");
			clearInterval(interChrono);
		}
		sec++;
	}
}

