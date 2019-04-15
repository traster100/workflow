<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function send_email_smtp($email, $message) {

  $mail = new PHPMailer(true); // Passing `true` enables exceptions

  try {

    //Server settings
    $mail->SMTPDebug = 4; // Enable verbose debug output
    $mail->isSMTP(); // Set mailer to use SMTP
    $mail->Host = 'mail.domain.com'; // Specify main and backup SMTP servers
    $mail->SMTPAuth = true; // Enable SMTP authentication
    $mail->Username = 'Username'; // SMTP username
    $mail->Password = 'Password'; // SMTP password
    $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587; // TCP port to connect to
    $mail->CharSet = 'UTF-8';

    //Recipients
    $mail->setFrom('robot@domain.com');
    $mail->addAddress($email); // Add a recipient
    $mail->addReplyTo('robot@domain.com');
    $mail->addCC('robot@domain.com');
    $mail->addBCC('robot@domain.com');

    //Content
    $mail->isHTML(true); // Set email format to HTML
    $mail->Subject = 'Проверка(smtp) ' . date('H:i:s');
    $mail->Body = $message;
    $mail->AltBody = $message;

    $mail->send();
  } catch (Exception $e) {
//    echo $mail->ErrorInfo;
    echo 'не отправлено';
  }
}

foreach (['mail1@mail.com', 'mail2@mail.com'] as $v) {
  send_email_smtp($v, 'код 123456');
  echo $v . ' отправлено' . '<br>';
}


//--------------------------------------------

foreach (['mail1@mail.com', 'mail2@mail.com'] as $v) {

  $headers =
    'From: robot@domain.com' . "\r\n"
    . 'Reply-To: robot@domain.com' . "\r\n"
    . 'Cc: robot@domain.com' . "\r\n"
    . 'Bcc: robot@domain.com' . "\r\n"
    . 'X-Mailer: PHP/' . phpversion();

  mail($v, 'Проверка(mail) ' . date('H:i:s'), 'tratata', $headers);

  echo $v . ' отправлено' . '<br>';

}