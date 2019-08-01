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
	var type
	if (what == 'capa') {type = 'capacité'}
	else if (what == 'disc') {type = 'discipline'}
	else {type = what}
	//Loading
	$('.select'+What).html('<option>...</option>');
	$('.'+what+'Description').html('...');

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
			$('.select'+What).html('');
			$('.'+what+'Description').html('');
			if (data.length == 0) {
				$('.select'+What).html('<option>---</option>');
				$('.'+what+'Description').html('pas encore de '+type);
			}else{
				if (what == 'race') {refresh('capa', data[0]['id'])}
				if (what == 'classe') {refresh('disc', data[0]['id'])}
				$.each(data, function(key, value){
					if (key == 0) {
						$('.'+what+'Description').html(value['description'])
					}
					$('.select'+What).append("<option value='"+value['description']+"' id='"+value['id']+"'>"+value['name']+"</option>")
				})
			}
		}
	})

}

// On initialise tout au chargement
refresh('race')
refresh('classe')

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

$('.deleteNature').click(function(e){
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

$('.power_submit').click(function(){
	var submit = $(this)
	var univID = $('.univID-stock').html();
	var type = submit.attr('power_type');
	var natureID = submit.parent().parent().find('option:selected', '.selectNature').attr('id');
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

$('.deletePower').click(function(e){
	if (confirm('sûr ?')) {
		var univID = $('.univID-stock').html();
		var type = $(e.currentTarget).attr('powerType');
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
	  			refresh(type)
	  		},
		})
	} 
})