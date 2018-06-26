var niquelesblagues = document.getElementsByClassName('lesblagues');

i=0;
function replace(){
	niquelesblagues[i].innerHTML = "Yo ! On nique toutes les blagues du tableau une par une!";
	i++;
}

setInterval(replace, 1000, 3);