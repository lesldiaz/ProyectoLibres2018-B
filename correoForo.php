<?php
require_once("phpmailer/src/PHPMailer.php");
require_once("phpmailer/src/SMTP.php");
require_once("phpmailer/src/Exception.php");

//Load composer's autoloader
require 'vendor/autoload.php';

function enviarcorreoRespuesta($nomapa,$correo,$nomforo, $autores,$descripcion,$fecha)
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
        $mail->addAddress($correo, $nomapa);     // Add a recipient
		    $asunto = 'Nueva Respuesta a Foro: ';
				$asunto.=$nomforo;

        //Content
				$cuerpo	= 'Hola <strong>' . $nomapa.'</strong>, se ha registrado una nueva respuesta a tu foro <i><u>'.$nomforo.'</i></u> por parte de '.$autores.' a las '.$fecha.'.<br/>
                  <b>Comentario añadido:</b> <br/>
									<p>'.$descripcion.'</p><br/>
									Revisa el apartado mis foros para más información. <br/>
									<br/>
									<br/>
									<br/>
									<small>Este mensaje se ha enviado de forma automatica, por favor no responda a este correo.</small>';
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $asunto;
        $mail->Body    = $cuerpo;

        $mail->send();
				echo "Estuvo bien";
    } catch (Exception $e) {
		echo "<script>alert('No se pudo enviar el mail, por favor verifique su configuracion de correo SMTP saliente.');</script>";
    }
}
?>
