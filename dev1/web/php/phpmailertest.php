<?php
require 'PHPMailer-master/class.phpmailer.php';
require 'PHPMailer-master/class.smtp.php';

$mail = new PHPMailer;

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup server
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'patricekeusch25@gmail.com';                            // SMTP username
$mail->Password = 'UserPass25';                           // SMTP password
$mail->SMTPSecure = 'tls';    
$mail->Port = 587;                        // Enable encryption, 'ssl' also accepted

$mail->From = 'patricekeusch25@gmail.com';
$mail->FromName = 'Patrice Keusch';
$mail->addAddress('yzerman.detroit@bluewin.ch', 'Josh Adams');  // Add a recipient
//$mail->addAddress('yzerman.detroit@bluewin.ch');               // Name is optional
$mail->addReplyTo('yzerman.detroit@bluewin.ch', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Here is the subject';
$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
   echo 'Message could not be sent.';
   echo 'Mailer Error: ' . $mail->ErrorInfo;
   exit;
}

echo 'Message has been sent';
?>