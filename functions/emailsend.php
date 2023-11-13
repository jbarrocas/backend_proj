<?php

use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;

function sendEmail($to_adress, $to_firstName, $to_lastName, $subject, $message) {

    require('./vendor/autoload.php');

    $mail = new PHPMailer();

    $mail->isSMTP();

    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;

    $mail->Host = 'smtp.gmail.com';

    $mail->Port = 465;

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

    $mail->SMTPAuth = true;

    $mail->Username = ENV["SMTP_USERNAME"];

    $mail->Password = ENV["SMTP_PASSWORD"];

    $mail->setFrom('postapol.contact@gmail.com', 'Postapol');

    $mail->addReplyTo('postapol.contact@gmail.com', 'Postapol');

    $mail->addAddress($to_adress, $to_firstName . " " . $to_lastName);

    $mail->Subject = $subject;

    $mail->msgHTML($message);

    if (!$mail->send()) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } 
}

