function CaracControl(){

	this.addCarac = function(){
		if ($('.caracContainer:not([hidden])').length == 8) {
			$('.addCarac').hide(100);
		}

		$('.caracContainer[hidden]').first().show(200).removeAttr('hidden')

	}

	this.removeCarac = function(caracKey){
		//On affiche le addCarac button
		$('.addCarac').show(100)
		//On cache la carac
		let caracContainer = $('.caracContainer[carac='+caracKey+']')
		caracContainer.hide(200, function(){
			caracContainer.attr("hidden", true)
			//On vide son nom
			caracContainer.find('.caracName').val('')
			//On vide son icone
			caracContainer.find('.chooseCaracIcon').css({'background':''}).html('?')
			caracContainer.find('.chooseCaracIcon').attr('icon', '')
			//On met la couleur sur Gris
			caracContainer.find('.selectIconColor option').first().attr('selected','selected')
			//On la met au bout des choix de carac
			$('.caracBox').append(caracContainer)
		})
	}


}