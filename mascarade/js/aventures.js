$(".nav2").addClass("currentNav");
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
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
			    height: 184,
			    menubar: false,
			    forced_root_block : "",
			    statusbar : false,
			    paste_auto_cleanup_on_paste : true,
			    paste_remove_styles: true,
			    paste_remove_styles_if_webkit: true,
			    paste_strip_class_attributes: true,
			    fontsize_formats: "6pt 8pt 11pt 14pt 18pt",
			    toolbar: 'bold italic | forecolor fontsizeselect',
			    plugins: 'code image textcolor preview paste'
			});
		}
	}

// --------- fixInfosSlider height ---------

var sectionHeight = $('section').height();
$('.fixInfosSlider').height(sectionHeight-200);


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

//Button Edit
function handler1(e) {
	var msgID = $(e.currentTarget).attr('msgid');
	var contenu = $(e.currentTarget).parent().children('.lastMsgOfPost');
	var editBloc = $(e.currentTarget).parent().children('.editMsgBloc');
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
	contenu.slideToggle(function(){
		$('.editMsg').html('annuler')
	});
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

    $(this).one("click", handler2);
}

//Button annuler
function handler2(e) {
	var contenu = $(e.currentTarget).parent().children('.lastMsgOfPost');
	var editBloc = $(e.currentTarget).parent().children('.editMsgBloc');
	contenu.slideToggle();
	editBloc.slideToggle();
	$('.editMsg').html('edit')
    $(this).one("click", handler1);
}

$('.editMsg').one("click", handler1);


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

//Si Desktop, on affiche le classicReply par défaut
if (window.matchMedia("(min-width: 720px)").matches) {
	$('.showingOW:first').click();
}

$('.closingCross,.closingArrow').click(function(e){
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
	alert('Tu as fait '+ result +' à ton jet ! ;-)');
	$("#resultStock")[0].setAttribute("value", result);
})

/*ALLO GM*/

	//Showing if player
	$('.showingAlloGM-direct').click(function() {
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
	            //INIT TOOLTIPS
				$(function () {
				  $('[data-toggle="tooltip"]').tooltip()
				})
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
				//remove unseen class
				$(e.currentTarget).removeClass("unseen2");
				//showing messages
	            $('.alloGM-content').html(this.responseText.trim());
	            //INIT TOOLTIPS
				$(function () {
				  $('[data-toggle="tooltip"]').tooltip()
				})
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



	$('.replyOption:not(.showingAlloGM)').click(function(){
		if (typeof alloRefreshInterval !== 'undefined') {
	    	clearInterval(alloRefreshInterval);
		}
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
		        if (this.readyState == 4 && this.status == 200) {
		        	$('.alloGM-loading').addClass('alloGM-submit button');
		        	$('.alloGM-submit').removeClass('alloGM-loading');
		        	if (http.responseText.includes('success')){
		        	}

		       }
		    };

		    var content = $('.alloGM-textArea').val().replace(/\\n/g, '\n');
		    var URIcontent =  encodeURIComponent(content);
		    var tempContent = '<div class="alloGM-msg msg-user temp">'+content+'</div>'
		    var userID = $('#alloGM-userID').attr('userID');
		    var otherID = $('#alloGM-otherID').attr('otherID');
		    var avID = $('#avID').html();
			http.open('POST','server/HTTP_REQUEST.php', true);
			http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			http.send("action=alloGM&content="+URIcontent+"&userID="+userID+"&otherID="+otherID+"&avID="+avID);	

       		$('.alloGM-content').append(tempContent);
            $('.alloGM-textArea').val('');
           	$('.alloGM-content').scrollTop(9999);
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
		        	var unseenArray = JSON.parse(http_notif.responseText);
		        	var i = 0;
		        	console.log(unseenArray);
		        	unseenArray.forEach(function(unseen){
		        		console.log(unseen);
		        		$('.alloGM-playerChoice').each(function(){
		        			var playerID = this.id;
		        			var playerDOM = this;
		        			if (unseen[0] == playerID) {
		        				$('.alloGM-playerChoice#'+unseen[0]).addClass('unseen2');
		        			}
		        		})
			        	i++;

		        	})
					$('.showingAlloGM').addClass("unseen1");
		        }
	       }
	      }

		http_notif.open('GET','server/HTTP_REQUEST.php?action=notifUnseen&avID='+avID+"&userID="+userID, true);
		http_notif.send();
	}

	setInterval(refreshNotifUnseen, 10000);


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
	$(".notesPaperStyle").click(function(){
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


	//GM DASHBOARD
	$('.GMDashBoard-playerChoice').click(function(e) {

		var userID = $(e.currentTarget).attr('id');
		var OW = $(".OW#GMDashBoard-"+userID);
		var otherOW = OW.parent().children('.OW').not(OW);
		OW.show();
		OW.animate({opacity:"1"},100, function(){
			otherOW.animate({opacity:"0"}, 100, function(){
				otherOW.hide();
			})
		});




/*		var http = new XMLHttpRequest;
	    http.onreadystatechange = function() {
	    	if (this.readyState < 4 ) {
	    		$('.GMDashBoard-content').html('<div class="loading"><div></div><div></div><div></div><div></div></div>');
	    	}
	        if (this.readyState == 4 && this.status !== 200) {
	        $('.GMDashBoard-content').html('<div class="loading-error"></div>');
	       }
	        if (this.readyState == 4 && this.status == 200) {
				//remove unseen class
				$(e.currentTarget).removeClass("unseen2");
				//showing perso infos
	            $('.GMDashBoard-content').html(this.responseText.trim());
	            //INIT TOOLTIPS
				$(function () {
				  $('[data-toggle="tooltip"]').tooltip()
				})
	       }
	    };

	    var playerID = $(e.currentTarget).attr('id');
	    var avID = $('#avID').html();

		http.open('POST','ajax/aventures_gmdashboard.php', true);
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		http.send("playerID="+playerID+"&avID="+avID);  */ 
	});




// ---------- GM DASHBOARD ---------


//Change Values
$('.update_lessPV').click(function(e){
	var bar = $(e.currentTarget).parent().children('.pvBar');
	var currentValue = parseInt(bar.attr('pv_val'));
	var nexValue;
	if (currentValue>0) {
		newValue = currentValue-1;
	}else{
		newValue = currentValue;
	}
	bar.attr('pv_val', newValue);
	bar.attr('data-original-title', newValue+'/10 PV');
	bar.attr('src','img/rpg/pv_'+newValue+'.png');
})

$('.update_morePV').click(function(e){
	var bar = $(e.currentTarget).parent().children('.pvBar');
	var currentValue = parseInt(bar.attr('pv_val'));
	var nexValue;
	if (currentValue<10) {
		var newValue = currentValue+1;
	}else{
		newValue = currentValue;
	}
	bar.attr('pv_val', newValue);
	bar.attr('data-original-title', newValue+'/10 PV');
	bar.attr('src','img/rpg/pv_'+newValue+'.png');
})


$('.updatePerso_submit').click(function(e){
	//On défini toutes les valeurs
	var avID = $('#avID').html();
	console.log(avID);
	var parent = $(e.currentTarget).parent();

	var perso = {
		id : parent.find('.persoID-stock').html(),
		pv : parent.find('.pvBar').attr('pv_val'),
		invent1 : parent.find('.invent1_val').val().trim(),
		invent2 : parent.find('.invent2_val').val().trim(),
		invent3 : parent.find('.invent3_val').val().trim(),
		invent4 : parent.find('.invent4_val').val().trim(),
		invent5 : parent.find('.invent5_val').val().trim(),
		c1Cond : parseInt(parent.find('.c1Cond_val').val()),
		c2Cond : parseInt(parent.find('.c2Cond_val').val()),
		c3Cond : parseInt(parent.find('.c3Cond_val').val()),
		c4Cond : parseInt(parent.find('.c4Cond_val').val()),
		c5Cond : parseInt(parent.find('.c5Cond_val').val()),
		addedXP : parseInt(parent.find('.xpTextArea').val().trim())
	}
    perso = JSON.stringify(perso);

	//On les envoie au serveur pour l'update
	var loading = parent.find('.updatePerso_loading');
	var http = new XMLHttpRequest;
    http.onreadystatechange = function() {
    	if (this.readyState < 4 ) {

    		loading.addClass('littleLoading');
    	}
        if (this.readyState == 4 && this.status !== 200) {
    		loading.addClass('littleLoading');
       }
        if (this.readyState == 4 && this.status == 200) {
    		loading.removeClass('littleLoading');
    		loading.addClass('littleComplete');
       }
    };

	http.open('POST','server/HTTP_REQUEST', true);
	http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	http.send("action=updatePerso&perso="+perso+"&avID="+avID);

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

	/*----REPLYOPTIONS----*/

	$('.showingOW').click(function(e){
		//fixInfos plus grande que les autres
		if (this == $('.showingFixInfos')[0]) {
			$('#replyContainer').animate({height:'460'},100);
		}else{			
			$('#replyContainer').animate({height:'280'},100);
		}
		$('.closingArrow').show();
		$('.closingArrow').animate({height:'40'},100);
		$('#headerMobile').slideUp(300);
	})

	$('.OW').click(function(){
		$('#headerMobile').slideUp(300);
	})


	$(".closingArrow").click(function(e){
		$('#replyContainer').animate({height:'0'},100);
		$('.closingArrow').animate({height:'0'},100);
		$('.closingArrow').hide();

	})
	
	$('.infoPersoNom a').click(function(e){
		e.preventDefault();
	})

}

