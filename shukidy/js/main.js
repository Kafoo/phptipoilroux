/*CHOOSE ICONE*/

//Fonction principale
function chooseIcon(target, callBack){

	let iconsBox = $('<div class="iconsBox"></div>')
	$('body').append(iconsBox)
	iconsBox.animate({opacity:1}, 200)
	iconsBox.html('<p class="saving"><span>.</span><span>.</span><span>.</span></p>')
	iconsBox.load('ajax/icons.php', function(){

		//Comportements dans le pop-up, une fois que son contenu est chargé
		$('.iconsCat').click(function(){
			$('.iconsCat').removeClass('current')
			$(this).addClass('current')
			let cat = $(this).attr('cat')
			$('.iconsContainer').hide();
			$('.iconsContainer[cat="'+cat+'"]').show()
		})

		$('.icon').click(function(){
			let icon = $(this).attr('icon')
			let cat = $(this).attr('cat')
			iconsBox.animate({opacity:0}, 200, function(){
				iconsBox.remove()
			})
			callBack(cat, icon)
		})

		//On enlève la box si on clique ailleurs
		$(document).mouseup(function(e){
		    // If the target of the click isn't the iconsBox
		    if(!iconsBox.is(e.target) && iconsBox.has(e.target).length === 0){
				iconsBox.animate({opacity:0}, 200, function(){
					iconsBox.remove()
				})
		    }
		});

	})
}


/*CUSTOM CONFIRM*/

/*
element.click(function(){
	customConfirm(
		//msg
		'',
		//yesMsg
		'',
		//noMsg
		'',
		function(){			
		//yesCallBack
		},
		function(){
		//noCallBack
		})
})*/


function customConfirm(msg, yesMsg, noMsg, yesCallBack, noCallBack){

	let confirmBox = $('<div class="custConf"></div>')
	let msgBox = $('<div class="custConf_msg">'+msg+'</div>')
	let choicesBox = $('<div class="custConf_choices"></div>')
	let yesBox = $('<div class="button custConf_yes">'+yesMsg+'</div>')
	let noBox = $('<div class="button custConf_no">'+noMsg+'</div>')

	choicesBox.append(yesBox, noBox)
	confirmBox.append(msgBox, choicesBox)
	$('body').append(confirmBox)
	$('.custConf').animate({opacity:1}, 200)

	$('.custConf_yes').click(function(){
		yesCallBack()
		$('.custConf').animate({opacity:0}, 200, function(){
			$('.custConf').remove()		
		})
	})
	$('.custConf_no').click(function(){
		noCallBack()
		$('.custConf').animate({opacity:0}, 200, function(){
			$('.custConf').remove()		
		})
	})	
}

/*OVER WINDOWS*/

$('.showingOW').click(function(e){
	var OWName = ($(e.currentTarget).attr('OW'));
	var OW = $(".OW#"+OWName);
	var otherOW = OW.parent().children('.OW').not(OW);
	OW.show();
	OW.animate({opacity:"1"},100, function(){
		otherOW.animate({opacity:"0"}, 100, function(){
			otherOW.hide();
		})
	});

	//current
	var showingOW = $(e.currentTarget)
	var allShowingOW = $(e.currentTarget).parent().children(".showingOW");
	allShowingOW.removeClass("current");
	showingOW.addClass("current");

});

$(".closingCross,.closingArrow").click(function(e){
	$(e.currentTarget).parent().parent().animate({opacity:"0"}, 100, function(){
		$(e.currentTarget).parent().parent().hide();
	})
});


/*TOOLTIPS FOR MOBILE*/

/*$('[title]').click(function(e){
	var title = $(e.currentTarget).attr('title');
	$('#topMenuMobile').html("<div class='arrowUP'></div>"+title);
	$('#topMenuMobile').slideDown(200);
	e.stopPropagation();
})

$(document).click(function(e) {
    $('#topMenuMobile').slideUp(200);
});


$(document).ready(function(){
  var _originalSize = $(window).width() + $(window).height()
  $(window).resize(function(){
    if($(window).width() + $(window).height() != _originalSize){
      slideUpHeader();
    }
  });
});*/



/*NAVIGATION DEROULANTE MOBILE*/

$('#navLogo').click(function(){
	$('#navMobile').slideToggle(200);
	$("#navLogo").hide();
	$('#croixNav').show();
});


/*CONNEXION DEROULANTE MOBILE*/

$('#connectionLogo').click(function(){
	$('#connectionMobile').slideToggle(200);
	$("#connectionLogo").hide();
	$('#croixConnection').show();
});


/*----HIDE&SHOW HEADER ON SCROLL----*/

function slideUpHeader(){
	$('#navMobile').hide(150);
	$('#connectionMobile').hide(150);
	$('#headerMobile').slideUp(300,function(){
		$('#navLogo').show();
		$('#connectionLogo').show();
		$('#croixNav').hide();
		$('#croixConnection').hide();		
	});

}

var position = $(window).scrollTop(); 
var iScrollPos = 0;
var lastSlide = 0;
var intervalSlide = 50;


$(window).scroll(function slideHeaderMobile() {
	var currentSlide = Date.now();
    var iCurScrollPos = $(this).scrollTop();
    if (currentSlide > lastSlide + intervalSlide) {    	
	    if (iCurScrollPos > iScrollPos) {
	        slideUpHeader();
	    } else {
	       $('#headerMobile').slideDown(300);
	    }
    }
    lastSlide = currentSlide;
    iScrollPos = iCurScrollPos;
});


//On cache le nav ou la co si on clique ailleurs
$(document).mouseup(function(e) {
    var navMobile = $("#navMobile");
    if (!navMobile.is(e.target) && navMobile.has(e.target).length === 0) {
        navMobile.slideUp(200);
		$('#navLogo').show();
		$('#croixNav').hide();
    }
    var connectionMobile = $("#connectionMobile");
    if (!connectionMobile.is(e.target) && connectionMobile.has(e.target).length === 0) {
        connectionMobile.slideUp(200);
		$('#connectionLogo').show();
		$('#croixConnection').hide();
    }
});



/*-----------TEST-------------*/


//RESIZING carac value in displayCarac-Container	
$('.displayCarac-value').css('font-size', Math.max(Math.min($('.displayCarac-container').width()/4)))
