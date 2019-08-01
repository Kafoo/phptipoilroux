//--------- UPDATE CARACS ---------

$('.carac_submit').click(function(e){
	var univID = $('.univID-stock').html()
	var carac1 = $('.input_carac1').val()
	var carac2 = $('.input_carac2').val()
	var carac3 = $('.input_carac3').val()
	var carac4 = $('.input_carac4').val()
	var carac5 = $('.input_carac5').val()

	$.post({
		url: 'server/set_univers.php',
		data: {
			action: 'changeCaracs',
			univID: univID,
			carac1: carac1,
			carac2: carac2,
			carac3: carac3,
			carac4: carac4,
			carac5: carac5
		},
  		dataType: 'html',

  		success: function(data, statut){
  			$('.carac_submit').after('<span class="success">ok</span>')
  			setTimeout(function(){
  				$('.success').fadeOut(200)
  			}, 3000)
  		},
	})	
})


//--------- REFRESH NATURE OR POWER ---------

function refresh(what, natureID = 0){
	var univID = $('.univID-stock').html()
	var What = what[0].toUpperCase() + what.substring(1)
	//On définit "type" comme un "what" qui aurait toutes ses lettres
	var type;
	if (what == 'capa') {type = 'capacité'}
	else if (what == 'disc') {type = 'discipline'}
	else {type = what}
	//Loading
	$('.select'+What).html('<option>...</option>');
	$('.'+what+'Description').html('<p class="saving"><span>.</span><span>.</span><span>.</span></p>');

	$.post({
		url : 'server/request_univers.php',
		data : {
			getInfos : true,
			univID : univID,
			what : what,
			natureID : natureID
		},
		dataType : 'json',

		success : function(data){
			//On vide les choix et la description
			$('.select'+What).html('');
			$('.'+what+'Description').html('');
			//S'il n'y a pas encore d'attribut existant
			if (data.length == 0) {
				$('.select'+What).html('<option>---</option>');
				$('.'+what+'Description').html('pas encore de '+type);
				$('.edit_'+what).hide();
				$('.delete_'+what).hide();			
			}else{
				//On refresh les pouvoirs correspondants à la nature
				if (what == 'race') {refresh('capa', data[0]['id'])}
				if (what == 'classe') {refresh('disc', data[0]['id'])}
				//Pour chaque attribut, on l'ajoute aux choix
				$.each(data, function(key, value){
					//Et on met la description du premier
					if (key == 0) {
						$('.'+what+'Description').html(value['description'])
					}
					$('.select'+What).append("<option value='"+value['description']+"' id='"+value['id']+"'>"+value['name']+"</option>")
				})
				$('.edit_'+what).show();
				$('.delete_'+what).show();				


			}
		}
	})

}

//On affiche la description correspondante à n'importe quel changement
$('.selectAttribute').change(function(){
	var description = this.value
	$(this).parent().siblings('.descriptionBox').html(description)
})

//On refresh les pouvoirs lorsqu'on change de nature
$('.selectNature').change(function(){
	var natureID = $(this).attr('id')
	var natureID = $('option:selected', this).attr('id');
	if ($(this).hasClass('selectRace') ) {
		refresh('capa', natureID)
	}
	if ($(this).hasClass('selectClasse') ) {
		refresh('disc', natureID)
	}
})

// On initialise tout au chargement
refresh('race')
refresh('classe')


//--------- EDIT DESCRIPTION ---------

function edit(){
	var what = $(this).attr('edit');
	var What = what[0].toUpperCase() + what.substring(1)
	var descriptionBox = $('.'+what+'Description')
	var selectBox = $('.select'+What)
	var name_old = $('option:selected', '.select'+What).html();
	if (name_old.length > 1) {		
		var Name_old = name_old[0].toUpperCase() + name_old.substring(1)
	}else{
		Name_old = name_old.toUpperCase();
	}
	var description_old = descriptionBox.html();
	var format_description = description_old.replace(/\<br>/g, '');

	selectBox.after('<input type="text" class="editArea selectBox select'+What+'" maxlength="20" value="'+Name_old+'">')
	selectBox.hide();
	descriptionBox.replaceWith('<textarea class="editArea descriptionBox '+what+'Description">'+format_description+'</textarea>')
	$(this).replaceWith('<div class="button update_button confirm_button confirm_'+what+'" edit="'+what+'">valider</div>')
	$('.delete_'+what).hide();
	$('.confirm_'+what).one("click", confirm_edit);
}

function confirm_edit(){
	var submit = $(this)
	var what = $(this).attr('edit');
	//On définit "type" comme un "what" qui aurait toutes ses lettres
	var type;
	var natureID;
	if (what == 'capa') {
		type = 'capacité'
		natureID = $('option:selected', '.selectRace').attr('id');
	}
	else if (what == 'disc') {
		type = 'discipline'
		natureID = $('option:selected', '.selectClasse').attr('id');
	}
	else {type = what}
	var descriptionBox = $('.'+what+'Description')
	var What = what[0].toUpperCase() + what.substring(1)
	var descriptionBox = $('.'+what+'Description')
	var selectBox = $("select.select"+What)
	var editArea = $("input.select"+What)
	var description_new = descriptionBox.val();
	var name_new = editArea.val();
	var id = $('option:selected', '.select'+What).attr('id');
	descriptionBox.replaceWith('<div class="descriptionBox '+what+'Description"></div>')
	selectBox.show();
	editArea.remove();
	$(this).replaceWith('<div class="button update_button edit_button edit_'+what+'" edit="'+what+'">éditer cette '+type+'</div>')
    $('.edit_'+what).one("click", edit);


	//Loading
	$('.select'+What).html('<option>...</option>');
	$('.'+what+'Description').html('<p class="saving"><span>.</span><span>.</span><span>.</span></p>');

	$.post({
		url: 'server/set_univers.php',
		data: {
			action: 'edit',
			what: what,
			id: id,
			name: name_new,
			description: description_new
		},
  		dataType: 'html',

  		success: function(data, statut){
  			$('.'+type+'_name').val('');
  			$('.'+type+'_description').val('');
  			submit.after('<span class="success">ok</span>')
  			setTimeout(function(){
  				$('.success').fadeOut(200)
  			}, 3000)
  			refresh(what, natureID)
  		},
	})


}

$('.edit_button').one("click", edit);


//--------- CREATE SLIDE ---------


$('.addBox h4').click(function(e){
	$(this).siblings('.addContainer').slideToggle();
	if ($(this).children('.downArrow').length > 0){
		$(this).children('.downArrow').replaceWith('<div class="upArrow"></div>')
	}else{
		$(this).children('.upArrow').replaceWith('<div class="downArrow"></div>')
	}
})


//--------- CREATE NATURE ---------

$('.nature_submit').click(function(){
	var submit = $(this)
	var univID = $('.univID-stock').html();
	var type = submit.attr('nature_type');
	var nature_name = $('.'+type+'_name').val();
	var nature_description = $('.'+type+'_description').val();

	$.post({
		url: 'server/set_univers.php',
		data: {
			action: 'addNature',
			univID: univID,
			name: nature_name,
			type: type,
			description: nature_description
		},
  		dataType: 'html',

  		success: function(data, statut){
  			$('.'+type+'_name').val('');
  			$('.'+type+'_description').val('');
  			submit.after('<span class="success">ok</span>')
  			setTimeout(function(){
  				$('.success').fadeOut(200)
  			}, 3000)
  			refresh(type)
  		},
	})

})

//--------- DELETE NATURE ---------

$('.delete_nature').click(function(e){
	if (confirm('sûr ?')) {
		var univID = $('.univID-stock').html();
		var type = $(e.currentTarget).attr('natureType');
		var ucFirstType = type[0].toUpperCase() + type.substring(1);
		var natureID = $('option:selected', '.select'+ucFirstType).attr('id');


		$.post({
			url: 'server/set_univers.php',
			data: {
				action: 'deleteNature',
				univID: univID,
				natureID: natureID,
			},
	  		dataType: 'html',

	  		success: function(data, statut){
	  			refresh(type)
	  		},
		})
	} 
})


//--------- CREATE POWER ---------

$('.power_submit').click(function(e){
	var submit = $(this)
	var univID = $('.univID-stock').html();
	var type = $(e.currentTarget).attr('power_type');
	var NatureType;
	if (type == 'capa') {NatureType = 'Race'}
	else if (type == 'disc') {NatureType = 'Classe'}
	var natureID = $('option:selected', '.select'+NatureType).attr('id');
	var name = $('.'+type+'_name').val();
	var description = $('.'+type+'_description').val();

	$.post({
		url: 'server/set_univers.php',
		data: {
			action: 'addPower',
			univID: univID,
			natureID: natureID,
			type: type,
			name: name,
			description: description
		},
  		dataType: 'html',

  		success: function(data, statut){
  			$('.'+type+'_name').val('');
  			$('.'+type+'_description').val('');
  			submit.after('<span class="success">ok</span>')
  			setTimeout(function(){
  				$('.success').fadeOut(200)
  			}, 3000)
  			refresh(type, natureID)
  		},
	})

})

//--------- DELETE POWER ---------

$('.delete_power').click(function(e){
	if (confirm('sûr ?')) {
		var univID = $('.univID-stock').html();
		var type = $(e.currentTarget).attr('powerType');
		var NatureType;
		if (type == 'capa') {NatureType = 'Race'}
		else if (type == 'disc') {NatureType = 'Classe'}
		var natureID = $('option:selected', '.select'+NatureType).attr('id');
		var Type = type[0].toUpperCase() + type.substring(1);
		var powerID = $('option:selected', '.select'+Type).attr('id');

		$.post({
			url: 'server/set_univers.php',
			data: {
				action: 'deletePower',
				univID: univID,
				powerID: powerID,
			},
	  		dataType: 'html',

	  		success: function(data, statut){
	  			refresh(type, natureID)
	  		},
		})
	} 
})