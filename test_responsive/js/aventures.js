$(".nav2").addClass("currentNav");

/*----------------AVENTURES PAGE----------------*/

/*-----CLIQUE SUR REJOINDRE-----*/

$('.joinAv').click(function(e){
	$(e.target).children('.joinPerso').show();
	$(e.target).children('.joinPerso').animate({opacity:'1'},200);
});


/*----------------MESSAGES PAGE----------------*/

// TINYMCE INITIALISATION

/*tinymce.init({
    selector: '#mytextarea',
    content_css : "style/tinymce.css",
    height: 300,
    menubar: false,
    forced_root_block : "",
    statusbar : false,
    toolbar: 'undo redo | bold italic | link image code forecolor backcolor preview',
    plugins: 'code image textcolor preview'
});*/


/*----- IF MOBILE -----*/

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

