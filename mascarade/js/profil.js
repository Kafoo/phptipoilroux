$(".nav4").addClass("currentNav");

$('.discBox').click(function(e){
	var disc = $(e.currentTarget).attr('id');
	$('.'+disc).show();
	$('.'+disc).animate({opacity:'1'}, 200);
})

$('.croix').click(function(){
	$('.discWindow').animate({opacity:'0'}, 200, function(){
		$('.discWindow').hide()
	});
})