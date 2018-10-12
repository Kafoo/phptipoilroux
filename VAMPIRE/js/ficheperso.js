$("#navDesk3").addClass("currentNav");

$("#editButtonLore").click(function(){
	$(".editButtonLore").hide();
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


$("#editButtonPhysique").click(function(){
	$(".editButtonPhysique").hide();
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
