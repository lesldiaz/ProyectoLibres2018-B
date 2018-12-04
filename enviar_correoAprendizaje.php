<?php

function enviarcorreointeresOA(){	
	$mail = new PHPMailer\PHPMailer\PHPMailer;                             
    	try {
        //Configuracion del servidor
        	$mail->SMTPDebug = 0;                                 
        	$mail->isSMTP();                                      
        	$mail->Host = 'smtp.gmail.com';  
        	$mail->SMTPAuth = true;                               
        	$mail->Username = 'mailer.sistema.oa@gmail.com';                 
        	$mail->Password = 'sistemaoa2017';                           
        	$mail->SMTPSecure = 'tls';                            
        	$mail->Port = 587;                                    
		$mail->SMTPOptions = array(
			'ssl' => array(
        		'verify_peer' => false,
        		'verify_peer_name' => false,
        		'allow_self_signed' => true
			)
		);

        //Configuracion del Emisor
       		$mail->setFrom('mailer.sistema.oa@gmail.com', 'Sistema OA');
        	$mail->addAddress($receptor, $nombre);
		$asunto ='PROMOCIÓN - Nuevo Objeto de Aprendizaje';
		$cuerpo="Se le comunica \n"." Que se registró un objeto de aprendizaje de su interés";
        //Contenido del Correo a Enviar
        	$mail->isHTML(true);                                  
        	$mail->Subject = $asunto;
        	$mail->Body = $cuerpo;

        	$mail->send();
		
    	} catch (Exception $e) {
       		echo "<script>alert('No se pudo enviar el mail, por favor verifique su configuracion de correo SMTP saliente.');</script>";
    	}
}


?>
