/*----- IF MOBILE -----*/

if (window.matchMedia("(max-width: 720px)").matches) {

	/*----CLIQUE SUR L'AVATAR----*/
	$('.layer').click(function(e){

		/*Petit if pour pas que la croix s'agrandisse*/
	    if($(e.target).is('.croixAvatar')){
        	e.preventDefault();
        	return;
    	}
    	/*endif croix*/
		$(e.target).children('.croixAvatar').show();
		$(e.target).animate({width:'170px', height:'220px', opacity:'1', borderRadius:'10px'}, 1);
		$(e.target).parent().css({"box-shadow":"none","border-radius":"10px"});
	});

	$('.croixAvatar').click(function(e){
		$(e.target).parent().animate({width:'30px', height:'30px', opacity:'0', borderRadius:'40px'}, 1);
		$(e.target).parent().parent().css({"box-shadow":"0px 0px 10px black","border-radius":"40px"});
		$(e.target).hide();
	});


}

