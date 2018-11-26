<?php

function enviarcorreobloc()
{	
/*
$receptor='mariojavier079@gmail.com';
    $emisor='stevenzambranovaca@gmail.com';
    $nombreemisor='Epn Admin';
    $asunto ='Cuenta Bloqueada';
    $cuerpo="Se le comunica \n"." Que se registró un objeto de aprendizaje de su interés    Descargar : http://localhost/buscar.php#collapseComponents";
    //  if(isset($_POST['enviar'])){
    //    $cuerpo = '
    //  <!DOCTYPE html>
    //<html>
    //<head>
    //<title></title>
    //</head>
    //<body>
    //  '.$_POST['cuerpo'].'
    //  </body>
    //  </html>';

    //para el envío en formato HTML
    $headers  = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

    //dirección del remitente
    $headers .= "From: ".$nombreemisor." <".$emisor.">\r\n";

    //Una Dirección de respuesta, si queremos que sea distinta que la del remitente
    $headers .= "Reply-To: ".$emisor."\r\n";

    //Direcciones que recibián copia
    //$headers .= "Cc: ejemplo2@gmail.com\r\n";

    //direcciones que recibirán copia oculta
    //$headers .= "Bcc: ejemplo3@yahoo.com\r\n";
    if(mail($receptor,$asunto,$cuerpo,$headers)){
        //echo "<script>alert('Funcion \"mail()\" ejecutada, por favor verifique su bandeja de correo.');</script>";
    }else{
        echo "<script>alert('No se pudo enviar el mail, por favor verifique su configuracion de correo SMTP saliente.');</script>";
    }
}

*/
	$mail = new PHPMailer\PHPMailer\PHPMailer;                             // Passing `true` enables exceptions
    try {
        //Server settings
        $mail->SMTPDebug = 2;                                 // Enable verbose debug output
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
        $mail->addAddress($receptor, $nombre);     // Add a recipient
		$asunto ='PROMOCIÓN - Nuevo Objeto de Aprendizaje';
		$cuerpo="Se le comunica \n"." Que se registró un objeto de aprendizaje de su interés    Descargar : http://localhost/buscar.php#collapseComponents";
        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $asunto;
        $mail->Body    = $cuerpo;

        $mail->send();
        //echo 'Message has been sent';
		echo "<script>alert('Funcion \"mail()\" ejecutada, por favor verifique su bandeja de correo.');</script>";
    } catch (Exception $e) {
        //echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
		echo "<script>alert('No se pudo enviar el mail, por favor verifique su configuracion de correo SMTP saliente.');</script>";
    }
}


?>
