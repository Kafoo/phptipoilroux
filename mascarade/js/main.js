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

$(".closingCross").click(function(e){
	$(e.currentTarget).parent().animate({opacity:"0"}, 100, function(){
		$(e.currentTarget).parent().hide();
	})
});


/*POP-UP SYSTEM*/

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

$(".infoPersoXP-container, .infoPersoLvl").mouseover(function(e){
	$xp = $('.infoPersoXP').attr('xp');
	$('.puFixInfos').html($xp);
	$('.puFixInfos').animate({opacity:'1'}, 80);
})

$(".infoPerso").mouseleave(function(){
	$('.puFixInfos').animate({opacity:'0'}, 1);
})