<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../libraries/PHPMailer-master/src/Exception.php';
require '../libraries/PHPMailer-master/src/PHPMailer.php';
require '../libraries/PHPMailer-master/src/SMTP.php';



function randomPass($n)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $str = '';
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $str .= $characters[$index];
    }

    return $str;
}


function send_mail($recipient,$subject,$message)
{

  $mail = new PHPMailer();
  $mail->IsSMTP();

  $mail->SMTPDebug  = 0;  
  $mail->SMTPAuth   = TRUE;
  $mail->SMTPSecure = "tls";
  $mail->Port       = 587;
  $mail->Host       = "smtp.gmail.com";
  //$mail->Host       = "smtp.mail.yahoo.com";
  $mail->Username   = "edir92057@gmail.com";
  $mail->Password   = "wjfyatwoewcznuig";

  $mail->IsHTML(true);
  $mail->AddAddress($recipient, "Dear Edir Member,");
  $mail->SetFrom("edir92057@gmail.com", "Edir.com");
  //$mail->AddReplyTo("reply-to-email", "reply-to-name");
  //$mail->AddCC("cc-recipient-email", "cc-recipient-name");
  $mail->Subject = $subject;
  $content = $message;

  $mail->MsgHTML($content); 
  if(!$mail->Send()) {
    echo "Error while sending Email.";
    echo 'Mailer Error: ' . $mail->ErrorInfo;
    //echo "<pre>";
    //var_dump($mail);
    return false;
  } else {
    echo "Email sent successfully";
    return true;
  }

}


?>