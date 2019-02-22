<?php
include("../_shared_/connectDB.php");

$avID = $_POST['avID'];

$req = $bdd->query("
	SELECT *
	FROM mas_allogm
	WHERE avID = '$avID'
	");
$allo = $req->fetchall();

foreach ($allo as $alloMsg) {
	if ($alloMsg['GM'] == 0) { ?>
		<div class="msg-user"><?=$alloMsg['content']?></div>
	<?php
	}
	if ($alloMsg['GM'] == 1) { ?>
		<div class="msg-GM"><?=$alloMsg['content']?></div>		
	<?php
	}
} ?>