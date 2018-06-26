/* TEST DE CREATION
var node = document.createTextNode("Nouvelle ligne !");
var div = document.getElementById("monId");
var table = document.createElement('table');
var tr = document.createElement('tr');
var th = document.createElement('th')
th.appendChild(node);
tr.appendChild(th);
table.appendChild(tr);
div.appendChild(table);
th.removeChild(node);
*/

function newline(){
	var node = document.createTextNode("Nouvelle ligne !");
	var p = document.createElement("p");
	var div = document.getElementById('monId');
	p.appendChild(node);
	div.appendChild(p);
}

