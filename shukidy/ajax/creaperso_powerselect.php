<?php
include ('../_shared_/connectDB.php');

$natureID = $_GET['natureID'];

$req = $bdd->query("
	SELECT p.name
	FROM powers as p
	JOIN rel_natures2powers as n2p
	ON p.id = n2p.powerID
	WHERE n2p.natureID = '$natureID'
	");

$powers = $req->fetchall();

	foreach ($powers as $power) { ?>
		<option><?=$power['name']?></option>
	<?php
	} 

?>