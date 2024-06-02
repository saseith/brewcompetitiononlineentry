<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require (CLASSES.'phpmailer/src/Exception.php');
require (CLASSES.'phpmailer/src/PHPMailer.php');
require (CLASSES.'phpmailer/src/SMTP.php');

function sendPHPMailerMessage($mail) {
// echo "in fn to send mail";
file_put_contents('php://stderr', print_r("in fn to send mail", TRUE));
// error_log("in fn to send mail");

    require (CONFIG.'config.php');
    require (CONFIG.'config.mail.php');

    try {
        //Server settings
        $mail->SMTPDebug  = $smtp_debug_level;
        $mail->isSMTP();
        $mail->Host       = $smtp_host;
        $mail->SMTPAuth   = $smtp_auth; 
        $mail->Username   = $smtp_username; 
        $mail->Password   = $smtp_password; 
        $mail->SMTPSecure = $smtp_secure; 
        $mail->Port       = $smtp_port;

        $mail->isHTML(true);

// echo "about to send mail";
error_log("about to send email with these custom and MIME headers: ");

foreach($mail->getCustomHeaders() as $value){
    error_log($value . "<br>");
}
//error_log($mail->getCustomHeaders());
error_log($mail->getMailMIME());

        $mail->send();
// echo "sent mail";
error_log("sent mail...");
// error_log($mail);
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
error_log("Message could not be sent: ");
error_log($e->getMessage());
    }
}

?>