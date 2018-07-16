var x = 2;
var y = 2;
var max = document.getElementById("max").innerHTML;
var current = document.getElementById('C'+x+'.'+y);
current.classList.add("VIP");

function move(){
	var w = event.which;

	if (w == 37) {
		if (x!==1){
			current.classList.remove("VIP")
			x=x-1;
			current = document.getElementById('C'+x+'.'+y);
			current.classList.add("VIP");
		}
	}
	if (w == 38) {
		if (y!==1){
			current.classList.remove("VIP")
			y=y-1;
			current = document.getElementById('C'+x+'.'+y);
			current.classList.add("VIP");
		}
	}
	if (w == 39) {
		if (x!= max){
			current.classList.remove("VIP")
			x=x+1;
			current = document.getElementById('C'+x+'.'+y);
			current.classList.add("VIP");		
		}
	}
	if (w == 40) {
		if (y!= max){
			current.classList.remove("VIP")
			y=y+1;
			current = document.getElementById('C'+x+'.'+y);
			current.classList.add("VIP");		
		}
	}
}