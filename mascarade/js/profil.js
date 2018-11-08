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

$("#editButtonPhysique").click(function(){
	$("#editButtonPhysique").hide();
	var height = $("#persoPhysique").css("height");
	if (height<"200px") {
		$("#editPhysiqueArea").height(150);
	}else{
		$("#editPhysiqueArea").height(height);
	}
	var persoPhysique = $("#persoPhysique").html();
	$("#persoPhysique").slideToggle();
	$("#editPhysiqueBlock").slideToggle();
	$("#editPhysiqueArea").html(persoPhysique);	
})


$("#editButtonLore").click(function(){
	$("#editButtonLore").hide();
	var height = $("#persoLore").css("height");
	if (height<"200px") {
		$("#editLoreArea").height(150);
	}else{
		$("#editLoreArea").height(height);
	}
	var persoLore = $("#persoLore").html();
	$("#persoLore").slideToggle();
	$("#editLoreBlock").slideToggle();
	$("#editLoreArea").html(persoLore);	
})

