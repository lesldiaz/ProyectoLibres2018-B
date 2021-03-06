<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
require_once("phpmailer/src/PHPMailer.php");
require_once("phpmailer/src/SMTP.php");
require_once("phpmailer/src/Exception.php");

//Load composer's autoloader
require 'vendor/autoload.php';

function sendMailP($mailto, $nameto, $usuario, $pw) {
    $mail = new PHPMailer\PHPMailer\PHPMailer;                             // Passing `true` enables exceptions
    try {
        //Server settings
        $mail->SMTPDebug = 0;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'mailer.sistema.oa@gmail.com';                 // SMTP username
        $mail->Password = 'sistemaoa2017';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to
		$mail->SMTPOptions = array(
		'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
			)
		);

        //Recipients
        $mail->setFrom('mailer.sistema.oa@gmail.com', 'Sistema OA');
        $mail->addAddress($mailto, $nameto);     // Add a recipient

        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Registro Profesor Sistema OA';
        $mail->Body    = 'Bienvenido <strong>' . $nameto . '</strong> al SISTEMA DE GESTION DE OBJETOS DE APRENDIZAJE<br></br>
                        Sus datos de ingreso al sistema son los siguientes:<ul>
                        <li>Usuario: ' . $usuario . '</li>' . '<li>Contrasenia: ' . $pw . '</li></ul>
                        Espere a que su cuenta sea activada por el administrado del sistema.';

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
}

function sendMailA($mailto, $nameto) {
    $mail = new PHPMailer\PHPMailer\PHPMailer;                             // Passing `true` enables exceptions
    try {
        //Server settings
        $mail->SMTPDebug = 0;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'mailer.sistema.oa@gmail.com';                 // SMTP username
        $mail->Password = 'sistemaoa2017';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to
		$mail->SMTPOptions = array(
		'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
			)
		);
        //Recipients
        $mail->setFrom('mailer.sistema.oa@gmail.com', 'Sistema OA');
        $mail->addAddress('mailer.sistema.oa@gmail.com', 'Sistema OA');     // Add a recipient

        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Nuevo Registro de Profesor Sistema OA';
        $mail->Body    = 'Existe un nuevo registro en el Sistema OA con los siguientes datos:
                        <ul><li>Nombre: ' . $nameto . '</li>' . '<li>Correo: ' . $mailto . '</li></ul>
                        Ingrese al sistema para activar al usuario.';

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
}