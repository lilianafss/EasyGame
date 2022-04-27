<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../vendor/phpmailer/phpmailer/src/SMTP.php';
require '../vendor/phpmailer/phpmailer/src/Exception.php';

/** Email de vérification
 * @param $to
 * @param $from
 * @param $from_name
 * @param $subject
 * @param $body
 * @return string
 * @throws Exception
 */
function smtpmailer($to, $from, $from_name, $subject, $body)
{
    $mail = new PHPMailer(true);
    $mail->IsSMTP();
    $mail->SMTPAuth = true;

    $mail->SMTPSecure = 'ssl';
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 465;
    $mail->Username = MAIL_USERNAME;
    $mail->Password = MAIL_PASSWORD;

    $mail->IsHTML(true);
    $mail->From = MAIL_USERNAME;
    $mail->Sender = $from;
    $mail->AddReplyTo($from, $from_name);
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->AddAddress($to);

    if ($mail->send())
    {
        return "L'email de confirmation à été envoyé";
    }
    else
    {
        return "Malheureusement l'email n'as pas pu être envoyé";
    }
}
