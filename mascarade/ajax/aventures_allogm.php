<?php
session_start();
include("../_shared_/connectDB.php");

$avID = $_POST['avID'];
$userID = $_POST['userID'];

$req = $bdd->query("
	SELECT *
	FROM mas_allogm
	WHERE avID = '$avID'
	AND userID = '$userID'
	");
$allo = $req->fetchall();

foreach ($allo as $alloMsg) {
	//Si user est GM
	if ($_SESSION['GM'] == 0) {
		if ($alloMsg['GM'] == 0) { ?>
			<div class="alloGM-msg msg-user" id="<?=$alloMsg['id']?>"><?=$alloMsg['content']?></div>
		<?php
		}
		if ($alloMsg['GM'] == 1) { ?>
			<div class="alloGM-msg msg-other" id="<?=$alloMsg['id']?>"><?=$alloMsg['content']?></div>		
		<?php
		}
	}
	//Si user est player
	if ($_SESSION['GM'] == 1) {
		if ($alloMsg['GM'] == 1) { ?>
			<div class="alloGM-msg msg-user" id="<?=$alloMsg['id']?>"><?=$alloMsg['content']?></div>
		<?php
		}
		if ($alloMsg['GM'] == 0) { ?>
			<div class="alloGM-msg msg-other" id="<?=$alloMsg['id']?>"><?=$alloMsg['content']?></div>		
		<?php
		}
	}
} ?>
<div id="alloGM-userID" userID="<?=$userID?>" hidden></div>

<script type="text/javascript">
	
	$('.alloGM-content').scrollTop(9999);

/*REFRESH*/

	setInterval(function(){

		var lastMsgID = $(".alloGM-msg.msg-other").last().attr('id');
	    var userID = $('#alloGM-userID').attr('userID');
	    var avID = $('#avID').html();
    	var GM = $('#GMStock').attr('gm');

		var http = new XMLHttpRequest;
	    http.onreadystatechange = function() {
	        if (this.readyState == 4 && this.status == 200) {
            	/*if new message*/
            	if (http.responseText.length > 0){
	            	$('.alloGM-content').append(http.responseText);
					$(".alloGM-content").scrollTop(9999);
				}
	       }
	    };

	    var refine = "?action=alloRefresh"+"&lastMsgID="+lastMsgID+"&userID="+userID+"&avID="+avID+"&GM="+GM;

		http.open('GET','server/HTTP_REQUEST.php'+refine, true);
		http.send();


	}, 5000)

</script>