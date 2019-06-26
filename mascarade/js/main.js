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

/*NAVIGATION DEROULANTE MOBILE*/

$('#navLogo').click(function(){
	$('#navMobile').slideToggle(200);
	$("#navLogo").hide();
	$('#croixNav').show();
});

$('#croixNav').click(function(){
	$('#navMobile').slideToggle(200, function(){
		$('#croixNav').hide();
		$("#navLogo").show();
	});
});

/*CONNEXION DEROULANTE MOBILE*/

$('#connectionLogo').click(function(){
	$('#connectionMobile').slideToggle(200);
	$("#connectionLogo").hide();
	$('#croixConnection').show();
});

$('#croixConnection').click(function(){
	$('#connectionMobile').slideToggle(200, function(){
		$('#croixConnection').hide();
		$("#connectionLogo").show();
	});
});


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
	$(e.currentTarget).parent().animate({opacity:"0"}, 100, function(){
		$(e.currentTarget).parent().hide();
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


/*-------------- IF MOBILE --------------*/

if (window.matchMedia("(max-width: 720px)").matches) {

	/*----HIDE&SHOW HEADER ON SCROLL----*/

	var position = $(window).scrollTop(); 
	// should start at 0

	var iScrollPos = 0;
	$(window).scroll(function () {
	    var iCurScrollPos = $(this).scrollTop();
	    if (iCurScrollPos > iScrollPos) {
	        slideUpHeader();
	    } else {
	       $('#headerMobile').slideDown(300);
	    }
	    iScrollPos = iCurScrollPos;
	});


	$(document).mouseup(function(e) {
	    var container = $("#navMobile");
	    if (!container.is(e.target) && container.has(e.target).length === 0) {
	        container.slideUp(200);
			$('#navLogo').show();
			$('#croixNav').hide();
	    }
	});

	$(document).mouseup(function(e) {
	    var container = $("#connectionMobile");
	    if (!container.is(e.target) && container.has(e.target).length === 0) {
	        container.slideUp(200);
			$('#connectionLogo').show();
			$('#croixConnection').hide();
	    }
	});

}