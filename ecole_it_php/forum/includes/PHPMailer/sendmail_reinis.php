<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';


$mail = new PHPMailer(true);
 $mail->IsSMTP();   //cest pour sepecifier le protocole smtp que phpmailer va utiliser
 $mail->Host = 'smtp.gmail.com';//specifier le serveur gmail
 $mail->SMTPAuth = true;// pour activer l'authentification
 $mail->Username = 'freakit.forum2024@gmail.com';
 $mail->Password = 'qjcvuvbykepezmpt';
 $mail->SMTPSecure = 'tls';//type decriptage
 $mail->Port = 587;
 $mail->CharSet = 'utf-8';
 $mail->setFrom('freakit.forum2024@gmail.com','freakit.forum');// expiditeur
 $mail->addAddress($_POST['email'],'freakit.forum');//destinataire
 $mail->isHTML(true);//pour activer envoie de mail sous forme html


 $mail->Subject = 'reinitialisation d\'Password';
 $mail->Body = 'hello 
      in order to renovate your password click on the following link :
    <a href= "localhost/ecole_it_php/forum/action/users/new_password.php?token='.$token.'&email='.$_POST['email'].'">confirmation email</a>';
// lien de confirmation 
 $mail->SMTPDebug = 0;//pour deactiver le debug;


 if (!$mail->Send()) {
    $error_msg = " the Mail is not sent";
    echo "Erreur:".$mail->ErrorInfo;

 }else{
    $error_msg = "an email is sent to you in order to renew your password";  
 }