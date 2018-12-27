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
	    selector: '.mytextarea',
	    content_css : "style/tinymce.css",
	    height: 300,
	    menubar: false,
	    forced_root_block : "",
	    statusbar : false,
	    paste_auto_cleanup_on_paste : true,
	    paste_remove_styles: true,
	    paste_remove_styles_if_webkit: true,
	    paste_strip_class_attributes: true,
	    fontsize_formats: "6pt 8pt 11pt 14pt 18pt",
	    toolbar: 'undo redo | bold italic | link image forecolor backcolor fontsizeselect | code',
	    plugins: 'code image textcolor preview paste'
	});
//Mobile init.
}else{
	tinymce.init({
	    selector: '.mytextarea',
	    content_css : "style/tinymce.css",
	    height: 300,
	    menubar: false,
	    forced_root_block : "",
	    statusbar : false,
	    paste_auto_cleanup_on_paste : true,
	    paste_remove_styles: true,
	    paste_remove_styles_if_webkit: true,
	    paste_strip_class_attributes: true,
	    fontsize_formats: "6pt 8pt 11pt 14pt 18pt",
	    toolbar: 'undo redo | bold italic | link image forecolor backcolor fontsizeselect | code',
	    plugins: 'code image textcolor preview paste'
	});
}



// --------- SUPP MESSAGE ---------
 
$('.suppMsg').click(function(e){

	var confirmation = confirm("Tu es sûr de vouloir supprimer ce message ? C'est définitif !\n\n (si plusieurs messages ont été postés à la suite, seul le dernier sera supprimé ;-)");
	if (confirmation == false) {
		return false;
	}else{

		var msgCount = $(e.currentTarget).parent().children(".msgCount").attr('msgcount');
		// Si un seul message dans le post
		if (msgCount == 1) {
			var msgID = $(e.currentTarget).attr('msgid');
			$('.'+msgID).animate({opacity:"0"}, 500, function(){
				$('.'+msgID).slideToggle(300, function(){
					$('.'+msgID).replaceWith('<div></div>');
				});
			});
		}

		// Si plusieurs messages dans le post :
		if (msgCount > 1) {
			var lastMsgOfPost = $(e.currentTarget).parent().children('.lastMsgOfPost');
			var lastSepOfPost = $(e.currentTarget).parent().children('.lastSepOfPost');
			lastMsgOfPost.slideToggle(300);
			lastSepOfPost.slideToggle(300);			
		}
		
		$(".msgOption").remove();
		$(".editMsg").remove();
		$(".suppMsg").remove();

		var refine = $(e.currentTarget).attr('ajax');
		var http = new XMLHttpRequest();
		http.open('GET', 'server/HTTP_REQUEST.php'+refine, false);
		http.send();
	}
})


// --------- EDIT MESSAGE ---------
 
$('.editMsg').click(function(e){

	var msgID = $(e.currentTarget).attr('msgid');
	var contenu = $(e.currentTarget).parent().children('.lastMsgOfPost');
	var editBloc = $(e.currentTarget).parent().children('.editMsgBloc')
	var editArea = $(e.currentTarget).parent().children('.editMsgBloc').children('.editMsgArea');
	var contenuHTML = contenu.html();
	var height = $(e.currentTarget).parent().css("height");
	if (height < 200) {
		editArea.height(150);
		console.log('1');
	}else{
		var newheight = parseFloat(height)/2;
		editArea.height(newheight);
	}
	contenu.slideToggle();
	editBloc.slideToggle();
	tinymce.get(msgID).setContent(contenuHTML);
	//Si mobile, on cache les options du message
	if (window.matchMedia("(max-width: 720px)").matches) {
		var editButton = $(e.currentTarget).parent().children('.editMsg.mobile');
		var suppButton = $(e.currentTarget).parent().children('.suppMsg.mobile');
		editButton.hide();
		editButton.animate({opacity:"0"}, 200);
		suppButton.hide();
		suppButton.animate({opacity:"0"}, 200);
	}
})


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

	/*----CLIQUE OPTIONS DU MESSAGE----*/	

	$('.msgOption').click(function(e){
		var msgID = $(e.currentTarget).attr('msgid');
		var editButton = $(e.currentTarget).parent().children('.editMsg.mobile');
		var suppButton = $(e.currentTarget).parent().children('.suppMsg.mobile');
		editButton.show();
		editButton.animate({opacity:"1"}, 200);
		suppButton.show();
		suppButton.animate({opacity:"1"}, 200);
	})

	/*----CLIQUE SUR L'AVATAR----*/
	$('.writerAvatar').click(function(e){

		if ($(e.currentTarget).is('.GM')) {
        	e.preventDefault();
        	return;
		}
		else{
			$(e.currentTarget).animate({width:'80vw', height:'100vw', borderRadius:'10px'}, 200);
			$(e.currentTarget).css('z-index', 400);
			$(e.currentTarget).children('.mobile').show();	
		}
	});

	$('.croixAvatar').click(function(e){
		event.stopPropagation();
		$(e.currentTarget).parent().parent().animate({width:'70px', height:'70px', border:'1px solid black', borderRadius:'40px'}, 200);
		$(e.currentTarget).parent().parent().css('z-index', 100);
		$(e.currentTarget).parent().parent().children('.mobile').hide(200);
	});
}

