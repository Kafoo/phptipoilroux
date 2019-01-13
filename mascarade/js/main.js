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
});

$(".closingCross").click(function(e){
	$(e.currentTarget).parent().animate({opacity:"0"}, 100, function(){
		$(e.currentTarget).parent().hide();
	})
});