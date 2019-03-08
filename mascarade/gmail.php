<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';


//Load Composer's autoloader
/*require 'vendor/autoload.php';
*/
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
    $mail->setFrom('sanssouci.mailer@gmail.com', 'Mailer');
    $mail->addAddress('ant.guillard@gmail.com');
    $mail->addAddress('elo.rainbow75@gmail.com');
    $mail->addAddress('p.garciapelayo@gmail.com');
    $mail->addAddress('juliejouette@gmail.com');
/*    $mail->addReplyTo('info@example.com', 'Information');
    $mail->addCC('cc@example.com');
    $mail->addBCC('bcc@example.com');*/

    //Attachments
/*    $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
*/
    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Eeeeeet.....ça fonctionne !! ;-)';
    $mail->Body    = "Oooookey, voici le premier mail envoyé depuis le site, j'espère que tout le monde va le recevoir, si vous pouvez me confirmer ça sur Beta-Suceurs c'est cool !! Et dites moi si vous voyez <b>ce texte en gras</b>, ce serait encore plus mieux que je puisse faire un peu de mise en forme =P Des gros poutous de love d'un néo-graineux qui code dans le train en allant à Google après avoir aménagé son camion #mavienapasdesens <3";
    $mail->AltBody = "Oooookey, voici le premier mail envoyé depuis le site, j'espère que tout le monde va le recevoir, si vous pouvez me confirmer ça sur Beta-Suceurs c'est cool !! Des gros poutous de love d'un néo-graineux qui code dans le train en allant à Google après avoir aménagé son camion #mavienapasdesens <3";

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}


?>