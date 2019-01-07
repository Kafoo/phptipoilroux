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



$(".closingCross").click(function(e){
	$(e.currentTarget).parent().animate({opacity:"0"}, function(){
		$(e.currentTarget).parent().hide();
	})
});