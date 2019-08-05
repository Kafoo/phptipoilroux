//--------- SELECT BIG CONTAINER ---------

$('.selectBigContainer').click(function(){
	var what = $(this).attr('bigContainer')

	$('.selectBigContainer').removeClass('current');
	$(this).addClass('current')
	$('.bigContainer').hide(0, function(){
	$('.'+what+'BigContainer').show();
	});
})


//--------- CARAC ICONES ---------

$('.chooseIcon').click(function(){
	let target = $(this)
	chooseIcon(
		target, 
		function(cat, icon){
			target.html('')
			target.attr('icon', cat+'/'+icon)
			target.css('background-image','url(img/gameicons/'+cat+'/'+icon+')'); 
	})
})

$('.selectIconColor').change(function(){

	let option = $('option:selected', this)

	if (option.value !== 'Couleur') {
		let color = option.val()
		let carac = $(this).attr('carac')
		let chooseIconBox = $('.chooseCaracIcon[carac="'+carac+'"]')
		chooseIconBox.css('background-color',color)
	}
	
})

//--------- UPDATE CARACS ---------

$('.edit_carac').click(function(e){
	var univID = $('.univID-stock').html()
	var c1_name = $('.input_carac1').val()
	var c1_icon = $('.chooseCaracIcon[carac="1"]').attr('icon')
	var c1_color = $('option:selected', '.selectIconColor[carac="1"]').val()
	var c2_name = $('.input_carac2').val()
	var c2_icon = $('.chooseCaracIcon[carac="2"]').attr('icon')
	var c2_color = $('option:selected', '.selectIconColor[carac="2"]').val()
	var c3_name = $('.input_carac3').val()
	var c3_icon = $('.chooseCaracIcon[carac="3"]').attr('icon')
	var c3_color = $('option:selected', '.selectIconColor[carac="3"]').val()
	var c4_name = $('.input_carac4').val()
	var c4_icon = $('.chooseCaracIcon[carac="4"]').attr('icon')
	var c4_color = $('option:selected', '.selectIconColor[carac="4"]').val()
	var c5_name = $('.input_carac5').val()
	var c5_icon = $('.chooseCaracIcon[carac="5"]').attr('icon')
	var c5_color = $('option:selected', '.selectIconColor[carac="5"]').val()

	$('.edit_carac').val('...')
	$.post({
		url: 'server/set_univers.php',
		data: {
			action: 'changeCaracs',
			univID: univID,
			c1_name, c1_icon, c1_color,
			c2_name, c2_icon, c2_color,
			c3_name, c3_icon, c3_color,
			c4_name, c4_icon, c4_color,
			c5_name, c5_icon, c5_color
		},
  		dataType: 'html',

  		success: function(data, statut){
  			$('.edit_carac').val('C\'est validé !')
  			setTimeout(function(){
  				$('.edit_carac').val('Valider les caractéristiques')
  			}, 2000)
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
					//Et on met la description du premier et son icon
					if (key == 0) {
						$('.'+what+'Description').html(value['description'])
						$('.'+what+'Background').css('background-image','url(img/gameicons/'+value['icon']+')')		
					}
					$('.select'+What).append("<option value='"+value['description']+"' id='"+value['id']+"' icon='"+value['icon']+"'>"+value['name']+"</option>")
				})
				$('.edit_'+what).show();
				$('.delete_'+what).show();				
			}
		}
	})

}

//On affiche la description correspondante à n'importe quel changement
$('.selectAttribute').change(function(){
	var what = $(this).attr('select')
	var description = this.value
	$('.'+what+'Description').html(description)
	//On change le background pour les natures
	if (what == 'race' || what == 'classe') {
		let icon = $('option:selected', this).attr('icon')
		$('.'+what+'Background').css('background-image','url(img/gameicons/'+icon+')')
	}
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

function editUniv(){
	descriptionBox = $('.univDescription')
	var description_old = descriptionBox.html()
	var format_description = description_old.replace(/\<br>/g, '');
	descriptionBox.replaceWith('<textarea class="editArea univDescription">'+format_description+'</textarea>')
	descriptionBox_new = $('.univDescription')
	descriptionBox_new.focus()
    var v = descriptionBox_new.html();
    descriptionBox_new.html('');
    descriptionBox_new.html(v);
    descriptionBox_new.scrollTop(2000); 
	$(this).replaceWith('<div class="button update_button confirm_button confirm_univ">valider</div>')
	$('.confirm_univ').one("click", confirm_editUniv);
}

function confirm_editUniv(){

	var univID = $('.univID-stock').html();
	var submit = $(this)
	var descriptionBox = $('.univDescription');
	var description_new = descriptionBox.val();
	descriptionBox.replaceWith('<div class="univDescription"></div>')
	$(this).replaceWith('<div class="button update_button edit_button edit_univ" edit="univ">éditer la description</div>')

    $('.edit_univ').one("click", editUniv);


	//Loading

	$('.univDescription').html('<p class="saving"><span>.</span><span>.</span><span>.</span></p>');

	$.post({
		url: 'server/set_univers.php',
		data: {
			action: 'edit',
			what: 'univ',
			univID: univID,
			description: description_new
		},
  		dataType: 'html',

  		success: function(data, statut){

  			$('.univDescription').html(data)
  		},
	})


}

$('.edit_univ').one("click", editUniv);



//--------- EDIT REGLES ---------

function editRegles(){
	reglesBox = $('.regles')
	var regles_old = reglesBox.html()
	var format_regles = regles_old.replace(/\<br>/g, '');
	reglesBox.replaceWith('<textarea class="editArea regles">'+format_regles+'</textarea>')
	reglesBox_new = $('.regles')
	reglesBox_new.focus()
    var v = reglesBox_new.html();
    reglesBox_new.html('');
    reglesBox_new.html(v);
    reglesBox_new.scrollTop(2000); 
	$(this).replaceWith('<div class="button update_button confirm_button confirm_regles">valider</div>')
	$('.confirm_regles').one("click", confirm_editRegles);
}

function confirm_editRegles(){

	var univID = $('.univID-stock').html();
	var submit = $(this)
	var reglesBox = $('.regles');
	var regles_new = reglesBox.val();
	reglesBox.replaceWith('<div class="regles"></div>')
	$(this).replaceWith('<div class="button update_button edit_button edit_regles" edit="univ">éditer les regles</div>')

    $('.edit_regles').one("click", editRegles);


	//Loading

	$('.regles').html('<p class="saving"><span>.</span><span>.</span><span>.</span></p>');

	$.post({
		url: 'server/set_univers.php',
		data: {
			action: 'edit',
			what: 'regles',
			univID: univID,
			regles: regles_new
		},
  		dataType: 'html',

  		success: function(data, statut){

  			$('.regles').html(data)
  		},
	})


}

$('.edit_regles').one("click", editRegles);




//--------- EDIT ATTRIBUTE ---------

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
	descriptionBox_new = $('.'+what+'Description')
	descriptionBox_new.focus()
    var v = descriptionBox_new.html();
    descriptionBox_new.html('');
    descriptionBox_new.html(v);
    descriptionBox_new.scrollTop(2000);
    let chooseIconBox = $('.choose'+What+'Icon')
	let icon
	let chooseIcon
	if (what == 'race' || what == 'classe') {
		icon = $('option:selected', '.select'+What).attr('icon') 
	}
	chooseIconBox.css('background-image','url(img/gameicons/'+icon+')').attr('icon',icon)
	chooseIconBox.removeClass('chooseNatureIcon-hidden')
	chooseIconBox.addClass('chooseNatureIcon')
	$(this).replaceWith('<div class="button update_button confirm_button confirm_'+what+'" edit="'+what+'">valider</div>')
	$('.delete_'+what).hide();
	$('.confirm_'+what).one("click", confirm_edit);
}

function confirm_edit(){
	var submit = $(this)
	var what = $(this).attr('edit');
	var What = what[0].toUpperCase() + what.substring(1)
	//On définit "type" comme un "what" qui aurait toutes ses lettres
	var type;
	var icon;
	var natureID;
    let chooseIconBox = $('.choose'+What+'Icon')
	if (what == 'capa') {
		type = 'capacité'
		natureID = $('option:selected', '.selectRace').attr('id');
	}
	else if (what == 'disc') {
		type = 'discipline'
		natureID = $('option:selected', '.selectClasse').attr('id');
	}else{
		type = what
		icon = chooseIconBox.attr('icon')
	}
	var descriptionBox = $('.'+what+'Description')
	var selectBox = $("select.select"+What)
	var editArea = $("input.select"+What)
	var description_new = descriptionBox.val();
	var name_new = editArea.val();
	var id = $('option:selected', '.select'+What).attr('id');
	descriptionBox.replaceWith('<div class="descriptionBox '+what+'Description"></div>')
	selectBox.show();
	editArea.remove();
	var icon = 	chooseIconBox.attr('icon')
	chooseIconBox.removeClass('chooseNatureIcon')
	chooseIconBox.addClass('chooseNatureIcon-hidden')
	$(this).replaceWith('<div class="button update_button edit_button edit_'+what+'" edit="'+what+'">éditer cette '+type+'</div>')
    $('.edit_'+what).one("click", edit);


	//Loading
	$('.select'+What).html('<option>...</option>');
	$('.'+what+'Description').html('<p class="saving"><span>.</span><span>.</span><span>.</span></p>');
	$('.'+what+'Background').css('background-image','')		
	$.post({
		url: 'server/set_univers.php',
		data: {
			action: 'edit',
			what: what,
			id: id,
			icon: icon,
			name: name_new,
			description: description_new
		},
  		dataType: 'html',

  		success: function(data, statut){
  			$('.'+type+'_name').val('');
  			$('.'+type+'_description').val('');
  			refresh(what, natureID)
  		},
	})


}

$('.edit_button').one("click", edit);


//--------- CREATE SLIDE ---------


$('.addTitle').click(function(e){
	$(this).siblings('.addContainer').slideToggle();
	if ($(this).children('.addIcone').length > 0){
		$(this).children('.addIcone').replaceWith('<div class="upArrow"></div>')
	}else{
		$(this).children('.upArrow').replaceWith('<div class="addIcone"></div>')
	}
})


//--------- CREATE NATURE ---------

$('.nature_submit').click(function(){
	var submit = $(this)
	var univID = $('.univID-stock').html();
	var what = submit.attr('nature_type');
	var What = what[0].toUpperCase() + what.substring(1)
	var nature_name = $('.'+what+'_name').val();
	var nature_description = $('.'+what+'_description').val();
	chooseIconBox = $('.chooseNew'+What+'Icon')
	var icon = chooseIconBox.attr('icon')
	$('.add'+What+' .addTitle').click()


	$.post({
		url: 'server/set_univers.php',
		data: {
			action: 'addNature',
			univID: univID,
			name: nature_name,
			what: what,
			description: nature_description,
			icon: icon
		},
  		dataType: 'html',

  		success: function(data, statut){
  			$('.'+what+'_name').val('');
  			$('.'+what+'_description').val('');
  			submit.after('<span class="success">ok</span>')
  			setTimeout(function(){
  				$('.success').fadeOut(200)
  			}, 3000)
  		},
	})

})

//--------- DELETE NATURE ---------

$('.delete_nature').click(function(e){

		var what = $(e.currentTarget).attr('natureType');

	customConfirm(
		//msg
		'Tu es sûr de vouloir supprimer cette '+what+' ?',
		//yesMsg
		'Carrément !',
		//noMsg
		'Euh en fait non',
		//yesCallBack
		function(){			
			var univID = $('.univID-stock').html();
			var What = what[0].toUpperCase() + what.substring(1);
			var natureID = $('option:selected', '.select'+What).attr('id');


			$.post({
				url: 'server/set_univers.php',
				data: {
					action: 'deleteNature',
					univID: univID,
					natureID: natureID,
				},
		  		dataType: 'json',

		  		success: function(data, statut){
		  			if (data['success'] == 0) {
		  				alert(data['msg'])
		  			}else{
		  				refresh(what)
		  			}
		  		},
			})
		},
		//noCallBack
		function(){
		})
})


//--------- CREATE POWER ---------

$('.power_submit').click(function(e){
	var submit = $(this)
	var univID = $('.univID-stock').html();
	var what = submit.attr('power_type');
	var What = what[0].toUpperCase() + what.substring(1)
	var NatureType;
	if (what == 'capa') {NatureType = 'Race'}
	else if (what == 'disc') {NatureType = 'Classe'}
	var natureID = $('option:selected', '.select'+NatureType).attr('id');
	var name = $('.'+what+'_name').val();
	var description = $('.'+what+'_description').val();
	$('.add'+What+' .addTitle').click()


	$.post({
		url: 'server/set_univers.php',
		data: {
			action: 'addPower',
			univID: univID,
			natureID: natureID,
			what: what,
			name: name,
			description: description
		},
  		dataType: 'html',

  		success: function(data, statut){
  			$('.'+what+'_name').val('');
  			$('.'+what+'_description').val('');
  			submit.after('<span class="success">ok</span>')
  			setTimeout(function(){
  				$('.success').fadeOut(200)
  			}, 3000)
  			refresh(what, natureID)
  		},
	})

})

//--------- DELETE POWER ---------

$('.delete_power').click(function(e){
	customConfirm(
		//msg
		'Tu es sûr de vouloir supprimer ce pouvoir ?',
		//yesMsg
		'Oui !',
		//noMsg
		'Ah non, en fait non...',
		function(){			
		//yesCallBack
			var univID = $('.univID-stock').html();
			var what = $(e.currentTarget).attr('powerType');
			var NatureType;
			if (what == 'capa') {NatureType = 'Race'}
			else if (what == 'disc') {NatureType = 'Classe'}
			var natureID = $('option:selected', '.select'+NatureType).attr('id');
			var What = what[0].toUpperCase() + what.substring(1);
			var powerID = $('option:selected', '.select'+What).attr('id');

			$.post({
				url: 'server/set_univers.php',
				data: {
					action: 'deletePower',
					univID: univID,
					powerID: powerID,
				},
		  		dataType: 'json',

		  		success: function(data, statut){
		  			if (data['success'] == 0) {
		  				alert(data['msg'])
		  			}else{
			  			refresh(what, natureID)
		  			}
		  		},
			})
		},
		function(){
		//noCallBack
		})

})