/*------ INITIALIZE ------*/

const pager = new Pager()
const controller = new Controller_creaperso()

/*------ REFRESH ------*/


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
	$('.'+what+'Background').css('background-image','')	

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
					//(on met la description du premier et son icon)
					if (key == 0) {
						$('.'+what+'Description').html(value['description'])
						$('.'+what+'Background').css('background-image','url(img/gameicons/'+value['icon']+')')		
					}
					$('.select'+What).append("<option value='"+value['description']+"' id='"+value['id']+"' icon='"+value['icon']+"'>"+value['name']+"</option>")
				})
				//On affiche les boutons d'édition et suppression
				$('.edit_'+what).show();
				$('.delete_'+what).show();				
			}
		}
	})
}

// On initialise tout au chargement
refresh('race')
refresh('classe')


$('input[type=range]').on('input', function () {
	let caracID = $(this).attr('carac')
	let caracVal = $(this).val()
	controller.changeCaracDisplay(caracID, caracVal)
});


/*------ CHECK CONDITIONS PAGE ------*/

function checkPager(page){
	
	let success = 1
	let msg

	//CARAC CONDITIONS
	if (page == 3) {

		let caracGoal = $('.caracBox').length*5
		let totalCarac = controller.totalCarac

		if (totalCarac !== caracGoal) {
			debugger
			msg = 'Le total des valeurs de tes caractéristiques doit être de 25'
			success = 0
		}
	}

	//Si les conditions ne sont pas respectées, on retourne l'erreur
	if (success == 0) {
		return msg
	//Sinon on continue
	}else{
		return true
	}

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








//------------------TES6-----------


// Fonction exécutée au redimensionnement, contenu executé seulement au passage mobile/desktop et desktop/mobile
var isMobile;
var lastFormat='';
function redimensionnement(e) {
	if("matchMedia" in window) {
		var currentPage = pager.getCurrentPage()
		pageHeight = $('.pageContainer[page="'+currentPage+'"]').height()
		var pagesBigContainer = $('.pagesBigContainer')
		pagesBigContainer.height(pageHeight)
	}
}
// On lie l'événement resize à la fonction
window.addEventListener('resize', redimensionnement, false);
// Exécution de cette même fonction au démarrage pour avoir un retour initial
redimensionnement();
