<?php
include("../_shared_/connectDB.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';


/*---------- NOUVEAU ALLO GM ----------*/
if (isset($_GET['type']) AND $_GET['type'] == "alloGM" ) {

    $avID = $_GET['avID'];
    $userID = $_GET['userID'];
    $req = $bdd->query("
            SELECT mail
            FROM mas_users
            WHERE id = '$userID'");
    $playerMail = $req->fetch()[0];
    $req = $bdd->query("
        SELECT nom_aventure
        FROM mas_aventures
        WHERE id='$avID'");
    $avName = $req->fetch()[0];
    $subject = 'AlloGM - Nouveau message !';
    $body = 'Tu as reçu un nouveau message privé sur AlloGM dans l\'aventure "'.$avName.'" !! <br><b>Découvre le en suivant ce lien : https://phptipoilroux.herokuapp.com/mascarade/aventures.php?avID='.$avID.'#replyContainer <br><br></b>A bientôôôôt =P';
    $altBody = 'Tu as reçu un nouveau message privé sur AlloGM dans l\'aventure "'.$avName.'" !! Découvre le en suivant ce lien : https://phptipoilroux.herokuapp.com/mascarade/aventures.php?avID='.$avID.'#replyContainer . A bientôôôôt =P';
    send_mail([$playerMail], $subject, $body, $altBody);
}


function send_mail ($addresses, $subject, $body, $altBody){

    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions

    try {
        //Server settings
        $mail->SMTPDebug = 2;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'sanssouci.mailer@gmail.com';                 // SMTP username
        $mail->Password = 'sGund4Ma';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to
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