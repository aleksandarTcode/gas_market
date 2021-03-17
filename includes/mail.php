<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

    //Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);


    try {
        //Server settings
        $mail->SMTPDebug = '0';                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = '';                     //SMTP username
        $mail->Password   = '';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom($mail->Username, 'South Stream');
        $mail->addAddress($email2, $name);     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Forum Registration Confirmation';

        $body = "Dear ".$name.", thanks for registering!"."<br><br>";

        $mail->Body = $body;

        $mail->send();
        header("Location: show.php");
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "<div class='alert alert-danger text-center'>
            <strong>Error: </strong> Message could not be sent. Mailer Error: {$mail->ErrorInfo}</div>";
    }


?>