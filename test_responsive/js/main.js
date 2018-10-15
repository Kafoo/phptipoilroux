$('#navLogo').click(function(){
	$('#navMobile').slideToggle(200);
	$("#navLogo").hide();
});

$('#croix').click(function(){
	$('#navMobile').slideToggle(200, function(){
		$("#navLogo").show();
	});
});