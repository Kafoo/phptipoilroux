<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	/*require 'vendor/phpmailer/phpmailer/src/Exception.php';
	require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
	require 'vendor/phpmailer/phpmailer/src/SMTP.php';*/

	$root = $_SERVER['DOCUMENT_ROOT'];

	if ($root !== '/app') {
		$root = $_SERVER['DOCUMENT_ROOT'].'/phptipoilroux';
	}

	require $root.'/vendor/autoload.php';


function getRealDate(){
	return
	sprintf('%02d', getdate()['mday']) . '/' . 
	sprintf('%02d', getdate()['mon']) . '/' . 
	getdate()['year'] . '--' . 
	sprintf('%02d', (getdate()['hours']+2)) . ':' . 
	sprintf('%02d', getdate()['minutes']);
}



function showPersosList(){
	//echo une liste des noms de persos séparés par des saut de ligne, avec la possibilité de les supprimer ou de les activer. Propose d'en créer un s'il n'y en a pas, et echo "membre non connecté" le cas échéant.
	global $bdd, $membreID;
	if (!isset($_SESSION['connected'])) {
		echo "Membre non connecté";
	}
	else{
		$reqNomPerso = $bdd->query("SELECT nom FROM ss_persos WHERE membreID = '$membreID' ORDER BY id");
		$nombrePerso = $reqNomPerso->rowCount();
		if ($nombrePerso == 0) {
			echo '<a class="infoMembre" href="creaperso.php">Créer un perso</a>';
		}
		else{
			$i = 1;
			while ($row = $reqNomPerso->fetch()) {

				$reqPersoID = $bdd->query("SELECT id FROM ss_persos WHERE nom = '$row[0]'");
				$persoID = $reqPersoID->fetch()[0];

				echo '
				<a class="infoMembre" href="ficheperso.php?persoID='.$persoID.'">'.$row[0].'</a><br>
				(<a class="confirm" href="SERVER_UPDATES.php?action=supprimePerso&membreID='.$membreID.'&persoID='.$persoID.'">Supprimer</a> - 
				<a href="SERVER_UPDATES.php?action=activePerso&membreID='.$membreID.'&persoID='.$persoID.'">Activer</a>)
				';
				if ($i < $nombrePerso) {
					echo '<br><br>';
				}
				$i++;
			}
		}
	}
}


function getActivePerso(){
	global $bdd, $membreID;
	if (!isset($_SESSION['connected'])) {
		return "Non-connecté";
	}
	else{
		$reqNomPerso = $bdd->query("SELECT nom FROM ss_persos WHERE membreID = '$membreID' AND actif = '1' ");
		$nomPerso = $reqNomPerso->fetch()[0];
		$nombrePerso = $reqNomPerso->rowCount();
		if ($nombrePerso == 0) {
			return '<a class="infoMembre" href="creaperso.php">Aucun perso</a>';
		}
		else{
			return $nomPerso;
		}
	}
}

function getInfoMembre($membreID, $info){
	global $bdd;
	$reqInfoMembre = $bdd->query("SELECT $info FROM ss_membres WHERE id = '$membreID'");
	return $reqInfoMembre->fetch()[0];
}

function getInfoPerso($persoID, $info){
	global $bdd;
	$reqInfoPerso = $bdd->query("SELECT $info FROM ss_persos WHERE id = '$persoID'");
	return nl2br($reqInfoPerso->fetch()[0]);
}

function getPersoID($nomPerso){
	global $bdd;
	$reqPersoID = $bdd->query("SELECT id FROM ss_persos WHERE nom = '$nomPerso'");
	return $reqPersoID->fetch()[0];
}

function getInfoMessage($messageID, $info){
	global $bdd;
	$reqInfoMessage = $bdd->query("SELECT $info FROM ss_messages_aventure WHERE id = '$messageID'");
	return nl2br($reqInfoMessage->fetch()[0]);
}

function getClanDesc($clan){
	global $bdd;
	$reqClanDesc = $bdd->query("SELECT description FROM ss_clanshtml WHERE nom = '$clan'");
	return $reqClanDesc->fetch()[0];
}

function getInfoDisc($nomDisc){
	global $bdd;
	$reqInfoDisc = $bdd->query("SELECT description FROM ss_disciplines WHERE nom = '$nomDisc'");
	return $reqInfoDisc->fetch()[0];
}


function checkLvlPerso($persoID){
	global $bdd;

	$req = $bdd->query("
		SELECT xp, nextlvl
		FROM mas_persos
		INNER JOIN mas_leveling
		ON mas_persos.lvl=mas_leveling.lvl
		WHERE mas_persos.id='$persoID'
		");

	$leveling = $req->fetch();
	if ($leveling['xp'] >= $leveling['nextlvl']) {
		$bdd->query("UPDATE mas_persos SET lvl=lvl+1 WHERE id='$persoID' ");
	}

	$req = $bdd->query("
		SELECT xp, nextlvl
		FROM mas_persos
		INNER JOIN mas_leveling
		ON mas_persos.lvl=mas_leveling.lvl
		WHERE mas_persos.id='$persoID'
		");


	if ($leveling['xp'] >= $leveling['nextlvl']) {
		checkLvlPerso($persoID);
	}

}


function send_mail ($addresses, $subject, $body, $altBody){
	global $bdd;


/*
require("../sendgrid-php/sendgrid-php.php");

$email = new \SendGrid\Mail\Mail(); 
$email->setFrom("mailer.sanssouci@gmail.com", "Example User");
$email->setSubject("Sending with SendGrid is Fun");
$email->addTo("ant.guillard@gmail.com", "Example User");
$email->addContent("text/plain", "and easy to do anywhere, even with PHP");
$email->addContent(
    "text/html", "<strong>and easy to do anywhere, even with PHP</strong>"
);
$sendgrid = new \SendGrid(getenv('barbapapa'));

try {
    $response = $sendgrid->send($email);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: '. $e->getMessage() ."\n";
}
*/

	$req = $bdd->query("
		SELECT *
		FROM mas_smtp
		WHERE id = 1
		");
	$res = $req->fetch();
	$smtp_username = $res['username'];
	$smtp_password = $res['password'];

    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions

    try {
        //Server settings
        $mail->SMTPDebug = 0;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  					// Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = $smtp_username;                 // SMTP username
        $mail->Password = $smtp_password;                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 25;                                    // TCP port to connect to
        $mail->SMTPOptions = array(
                        'ssl' => array(
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                            'allow_self_signed' => true
                        )
                    );

        //Recipients
        $mail->setFrom('sanssouci.mailer@gmail.com', 'Sans Souci');
        $mail->addBCC('ant.guillard@gmail.com');
        if (is_array($addresses)) {
            foreach ($addresses as $address) {
              $mail->addBCC($address);
            }
        }else{
            $mail->addBCC($addresses);
        }


        //Content
        $mail->CharSet = 'UTF-8';
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;
        $mail->AltBody = $altBody;

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }

}
?>
