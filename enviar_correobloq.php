<?php
require_once("phpmailer/src/PHPMailer.php");
require_once("phpmailer/src/SMTP.php");
require_once("phpmailer/src/Exception.php");

//Load composer's autoloader
require 'vendor/autoload.php';

function enviarcorreobloc($receptor='')
{
   
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
        $mail->addAddress($receptor,"USUARIO BLOQUEADO");     // Add a recipient
		$asunto ='Cuenta Bloqueada';
		$cuerpo='Hola, este es el SISTEMA DE GESTION DE OBJETOS DE APRENDIZAJE<br></br>
                        Se le comunica que su cuenta ha sido bloqueada:<ul>
                        <li>Cuenta: ' . $receptor . '</li></ul>
                        Por favor espere hasta que un administrador desbloquee su cuenta.';
						
        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $asunto;
        $mail->Body    = $cuerpo;

        $mail->send();
        //echo 'Message has been sent';
		echo "<script>alert('Por favor verifique su bandeja de correo. Su cuenta ha sido bloqueada');</script>";
    } catch (Exception $e) {
        //echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
		echo "<script>alert('No se pudo enviar el mail, por favor verifique su configuracion de correo SMTP saliente.');</script>";
    }
}
?>
