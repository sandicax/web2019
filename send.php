<?php

include_once '../phpmailer/src/PHPMailer.php';

$mail = new PHPMailer\PHPMailer\PHPMailer();
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl';
$mail->Host = 'smtp.gmail.com';
$mail->Port = '465';
$mail->isHTML();
$mail->Username = 'ahmed.bannour@esprit.tn';
$mail->Password = 'rcop1g1337';
$mail->setFrom("no-reply@esprit.tn");
$mail->Subject = "Activation de compte";
$mail->Body = 'Veuillez cliquez sur ce  <a href="verification.php">lien</a> afin d\'activer votre compte';
$mail->AddAddress('ahmed.bannour@esprit.tn');
$mail->send();