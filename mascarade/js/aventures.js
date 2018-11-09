$(".nav2").addClass("currentNav");

/*----------------AVENTURES PAGE----------------*/

//CLIQUE SUR REJOINDRE

$('.joinAv').click(function(e){
	$(e.currentTarget).parent().children('.joinPerso').show();
	$(e.currentTarget).parent().children('.joinPerso').animate({opacity:'1'},200);
});


/*----------------MESSAGES PAGE----------------*/

// TINYMCE INITIALISATION

//Desktop init.
if (window.matchMedia("(min-width: 720px)").matches) {
	tinymce.init({
	    selector: '#mytextarea',
	    content_css : "style/tinymce.css",
	    height: 300,
	    menubar: false,
	    forced_root_block : "",
	    statusbar : false,
	    toolbar: 'undo redo | bold italic | link image code forecolor backcolor',
	    plugins: 'code image textcolor preview'
	});
//Mobile init.
}else{
	tinymce.init({
	    selector: '#mytextarea',
	    content_css : "style/tinymce.css",
	    height: 300,
	    menubar: false,
	    forced_root_block : "",
	    statusbar : false,
	    toolbar: 'undo redo | bold italic | link image code forecolor backcolor',
	    plugins: 'code image textcolor preview'
	});
}


// --------- ROLL THE DIE ---------

$('.rollTheDie').one('click', function(e){
	var result = Math.ceil(Math.random()*10);
	$(e.currentTarget).html(result);
	$(e.currentTarget).removeClass('button rollTheDie');
	$(e.currentTarget).addClass('dieRolled');
	var refine = $(e.currentTarget).attr('ajax');

	var http = new XMLHttpRequest();
	http.open('GET', 'server/HTTP_REQUEST.php'+refine+'&result='+result, false);
	http.send();



	alert('Tu as fait '+ result +' à ton jet ! ;-) \nTon résultat a bien été enregistré');
})




/*-------------- IF MOBILE --------------*/

if (window.matchMedia("(max-width: 720px)").matches) {

	/*----CLIQUE SUR L'AVATAR----*/
	$('.writerAvatar').click(function(e){

		if ($(e.target).is('.GM')) {
        	e.preventDefault();
        	return;
		}


		else{
			/*Petit if pour pas que la croix s'agrandisse*/
		    if($(e.target).is('.croixAvatar')){
	        	e.preventDefault();
	        	return;
	    	}/*endif croix*/

			$(e.target).animate({width:'80vw', height:'100vw', borderRadius:'10px'}, 200);
			$(e.target).css('z-index', 400);
			$(e.target).children('.mobile').show();	
		}
	});

	$('.croixAvatar').click(function(e){
		$(e.target).parent().parent().animate({width:'70px', height:'70px', border:'1px solid black', borderRadius:'40px'}, 200);
		$(e.target).parent().parent().css('z-index', 100);
		$(e.target).parent().parent().children('.mobile').hide(200);
	});
}

