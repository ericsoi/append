<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug  = 1;  
    $mail->isSMTP();         
    $mail->SMTPAuth   = TRUE;
    $mail->SMTPSecure = "tls";
    $mail->Port       = 587;
    $mail->Host       = "smtp.gmail.com";
    $mail->Username   = "matrickcredit@gmail.com";
    $mail->Password   = "fwlrhrwyygboxpqi";

    //Recipients
    $mail->setFrom('matrickcredit@gmail.com', 'Matrick Credit');
    $mail->addAddress('ericksoi3709@gmail.com', 'Erick');     //Add a recipient
    $mail->addAddress('kyalomartin1990@gmail.com', 'Matrick Credit');     //Add a recipient

    $mail->addReplyTo('matrickcredit@gmail.com', 'Matrick Credit');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'OTP';
    $mail->Body    = "Your dashboard login OTP </br> <b>$otp</b>";
    // $mail->AltBody = 'Test mail body from matrick.co.ke';
    $mail->send();
} catch (Exception $e) {
}