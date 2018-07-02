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
}



function startChrono (){
	//SUPPRIME LE BOUTON START
	var boutonStart = document.getElementById('boutonStart');
	boutonStart.parentNode.removeChild(boutonStart);
	//AFFICHE LE PREMIER BOUTON A CLIQUER
	document.getElementById("boutonCase").removeAttribute("hidden");
	//LANCE LE CHRONO
	var centSec = 1;
	var interChrono = setInterval(chrono, 10);
	function chrono()
	{
		sec = centSec/100
		timer = document.getElementById('timer');
		timer.innerHTML = sec.toFixed(1);
		//FIN DU CHRONO
		if (sec==15.02) {
			var bouton = document.getElementById('boutonCase');
			bouton.parentNode.removeChild(bouton);
			clearInterval(interChrono);
			showPrompt();
		}
		centSec++;
	}
}

function checkForm(){
    var a=document.forms["form"]["nombreCases"].value;
    if (a>20)
    {
		var plop = confirm("Argh, tu es joueur ! L'affichage n'est pas optimal pour des grilles aussi grandes... Tu veux quand même continuer ?");
		if (plop== true){
			return true;
		}
		else{
			return false;
		}
    }
}

function showPrompt(){
	var pseudo = prompt("Yeah ! Pseudo ? \"Annuler\" pour rejouer");
	if (pseudo == ""){showPrompt();}
	if (pseudo == null){window.location="";}
	else{
		var titre = document.getElementById('titre');
		titre.innerHTML= pseudo;
	}
}