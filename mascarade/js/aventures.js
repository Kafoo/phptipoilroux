$(".nav2").addClass("currentNav");

/*----------------AVENTURES PAGE----------------*/

//CLIQUE SUR REJOINDRE

$('.joinAv').click(function(e){
	$(e.currentTarget).parent().children('.joinPerso').show();
	$(e.currentTarget).parent().children('.joinPerso').animate({opacity:'1'},200);
});


/*----------------MESSAGES PAGE----------------*/

// TINYMCE INITIALISATION
if (typeof tinymce !== 'undefined') {
	if (window.matchMedia("(min-width: 720px)").matches) {
	//Desktop init.
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
			lastMsgOfPost.slideToggle(500);
			lastSepOfPost.slideToggle(500);
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


// ---------- REPLY OPTIONS ---------

$('.closingCross').click(function(e){
	$('.showingOW').removeClass("current");
})


/*DICE REPLY*/

function choose(what, choice){
	$(".diceReply-"+what).removeClass('current');
	$(".diceReply-"+what+"."+what+choice).addClass('current');
	$('#'+what+'Stock')[0].setAttribute("value", choice);
}

$("#diceReply-submit").click(function(){
	var result = Math.ceil(Math.random()*10);
	alert(result);
	$("#resultStock")[0].setAttribute("value", result);
})

/*ALLO GM*/

//Showing if player
$('.showingAlloGM-direct').one('click', function() {
	var http = new XMLHttpRequest;
    http.onreadystatechange = function() {
    	if (this.readyState < 4 ) {
    		$('.alloGM-content').html('<div class="loading"><div></div><div></div><div></div><div></div></div>');
    	}
        if (this.readyState == 4 && this.status !== 200) {
        $('.alloGM-content').html('<div class="loading-error"></div>');
       }
        if (this.readyState == 4 && this.status == 200) {
            $('.alloGM-content').html(this.responseText.trim());
       }
    };

    var userID = $('#userID').html();
    var otherID = $('#GMID').html();
    var avID = $('#avID').html();

	http.open('POST','ajax/aventures_allogm.php', true);
	http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	http.send("userID="+userID+"&otherID="+otherID+"&avID="+avID);
	refreshNotifUnseen(); 
});

//Showing if GM

$('.alloGM-playerChoice').click(function(e) {

	var OW = $(".OW#alloGM");
	var otherOW = OW.parent().children('.OW').not(OW);
	OW.show();
	OW.animate({opacity:"1"},100, function(){
		otherOW.animate({opacity:"0"}, 100, function(){
			otherOW.hide();
		})
	});


	var http = new XMLHttpRequest;
    http.onreadystatechange = function() {
    	if (this.readyState < 4 ) {
    		$('.alloGM-content').html('<div class="loading"><div></div><div></div><div></div><div></div></div>');
    	}
        if (this.readyState == 4 && this.status !== 200) {
        $('.alloGM-content').html('<div class="loading-error"></div>');
       }
        if (this.readyState == 4 && this.status == 200) {
            $('.alloGM-content').html(this.responseText.trim());
       }
    };

    var userID = $('#GMID').html();
    var otherID = $(e.currentTarget).attr('id');
    var avID = $('#avID').html();

	http.open('POST','ajax/aventures_allogm.php', true);
	http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	http.send("userID="+userID+"&otherID="+otherID+"&avID="+avID);  
	refreshNotifUnseen();  
});

//Stop refresh when stop showing
$('#alloGM').children(".closingCross").click(function(){
	clearInterval(alloRefreshInterval);
})

$('.replyOption').click(function(){
	clearInterval(alloRefreshInterval);
})

//Sending

$('.alloGM-textArea').on('keypress', function (e) {
         if(e.which === 13){
         	$('.alloGM-submit').click();
         	return false;
         }
   });

$('.alloGM-submit').click(function(){

	if ($(".alloGM-textArea").val().trim() !== "") {


		var http = new XMLHttpRequest;
	    http.onreadystatechange = function() {
	    	if (this.readyState < 4 ) {
	    		$('.alloGM-submit').addClass('alloGM-loading');
	    		$('.alloGM-loading').removeClass('alloGM-submit button');
	    	}
	        if (this.readyState == 4 && this.status !== 200) {
	        //code
	       }
	        if (this.readyState == 4 && this.status == 200) {
	        	$('.alloGM-loading').addClass('alloGM-submit button');
	        	$('.alloGM-submit').removeClass('alloGM-loading');
	        	if (http.responseText.includes('success')){
	        		$('.alloGM-content').append(formContent);
	        	}
	            $('.alloGM-textArea').val('');
	           	$('.alloGM-content').scrollTop(9999);

	       }
	    };

	    var content = $('.alloGM-textArea').val().replace(/\\n/g, '\n');
	    var URIcontent =  encodeURIComponent(content);
	    var formContent = '<div class="alloGM-msg msg-user temp">'+content+'</div>'
	    var userID = $('#alloGM-userID').attr('userID');
	    var otherID = $('#alloGM-otherID').attr('otherID');
	    var avID = $('#avID').html();
		http.open('POST','server/HTTP_REQUEST.php', true);
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		http.send("action=alloGM&content="+URIcontent+"&userID="+userID+"&otherID="+otherID+"&avID="+avID);	
	}
})
	
//Notification unseen

function refreshNotifUnseen(){

	var http_notif = new XMLHttpRequest;
	var avID = $('#avID').html();
	var userID = $('#userID').html();

    http_notif.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
	        if (http_notif.responseText == "[]") {
	        	$('.showingAlloGM').removeClass("unseen1");
	        }
	        else{
				$('.showingAlloGM').addClass("unseen1");
	        }
       }
      }

	http_notif.open('GET','server/HTTP_REQUEST.php?action=notifUnseen&avID='+avID+"&userID="+userID, true);
	http_notif.send();
}

setInterval(refreshNotifUnseen, 5000);





/*NOTES*/
$('.showingNotes').one('click', function() {
	var http = new XMLHttpRequest;
    http.onreadystatechange = function() {
    	if (this.readyState < 4 ) {
    		$('.notesContent').html('<div class="loading"><div></div><div></div><div></div><div></div></div>');
    	}
        if (this.readyState == 4 && this.status !== 200) {
        $('.notesContent').html('<div class="loading-error"></div>');
       }
        if (this.readyState == 4 && this.status == 200) {
            $('.notesContent').html(this.responseText.trim());
       }
    };

    var userID = $('#userID').html();
    var avID = $('#avID').html();

	http.open('POST','ajax/aventures_notes.php', true);
	http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	http.send("userID="+userID+"&avID="+avID);    
});

/*EDIT NOTES*/
$(".editButton").click(function(){
	var notesContent = $(".notesContent").html().replace(/<br>/g,'');
	$(".notesPaper").slideToggle(200);
	$("#editNotesArea").html(notesContent);	
	$(".editNotesBlock").slideToggle(200, function(){
	$("#editNotesArea").focus();	
	});
})

$(".confirmEditNotes").click(function(){
	var http = new XMLHttpRequest;
    http.onreadystatechange = function() {
    	if (this.readyState < 4 ) {
    		$('.notesContent').html('<div class="loading"><div></div><div></div><div></div><div></div></div>');
    	}
        if (this.readyState == 4 && this.status !== 200) {
        $('.notesContent').html('<div class="loading-error"></div>');
       }
        if (this.readyState == 4 && this.status == 200) {
            $('.notesContent').html(http.responseText);
       }
    };

    var content =  encodeURIComponent($('#editNotesArea').val().replace(/\\n/g, '\n'));
    var userID = $('#userID').html();
    var avID = $('#avID').html();
	http.open('POST','server/HTTP_REQUEST.php', true);
	http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	http.send("action=editNotes&notesContent="+content+"&userID="+userID+"&avID="+avID);

	$(".notesPaper").slideToggle(200);
	$(".editNotesBlock").slideToggle(200);
})

/*FIXINFOS POP-UP SYSTEM*/

$(".infoPersoCarac").mouseover(function(e){
	$carac = $(e.currentTarget).attr('carac');
	$('.puFixInfos').html($carac);
	$('.puFixInfos').animate({opacity:'1'}, 80);
})

$(".hpBar").mouseover(function(e){
	$pv = $(e.currentTarget).attr('pv');
	$('.puFixInfos').html($pv+'/10 PV');
	$('.puFixInfos').animate({opacity:'1'}, 80);
})

$(".infoPersoNom").mouseover(function(){
	$('.puFixInfos').html('fiche perso');
	$('.puFixInfos').animate({opacity:'1'}, 80);
})

$(".infoPersoInventory").mouseover(function(){
	$('.puFixInfos').html('inventaire');
	$('.puFixInfos').animate({opacity:'1'}, 80);
})

$(".infoPersoXP-container, .infoPersoLvl").mouseover(function(e){
	$xp = $(e.currentTarget).children('.infoPersoXP').attr('xp');
	$('.puFixInfos').html($xp);
	$('.puFixInfos').animate({opacity:'1'}, 80);
})

$(".infoPerso").mouseleave(function(){
	$('.puFixInfos').animate({opacity:'0'}, 1);
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



