<?php
    require_once "pdo.php";
    function insertresp($idforo,$nombre,$descripcion,$autor,$userType,$filename) {
		$pdo = new PDO('mysql:host=localhost;dbname=sistemaoa;charset=utf8', 'root','');
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "CALL insertarRespDis(:idForo, :nombre, :descripcion, :autor, :userType, :ruta)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':idForo' => $idforo,
            ':nombre' => $nombre,
            ':descripcion' => $descripcion,
            ':autor' => $autor,
            ':userType' => $userType,
            ':ruta' => $filename));
    }
    //updateres($_POST["idRespuesta"],$_POST["nombreOA"],$_POST["descripcion"],$nombrearchivo,$_POST["edAutor"]);
    function updateres($idrespuesta,$asunto,$descripcion,$filename,$edautor) {
    $pdo = new PDO('mysql:host=localhost;dbname=sistemaoa;charset=utf8', 'root','');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CALL modResp(:idRespuesta, :asunto, :descripcion, :nombreadjunto, :edAutor)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':idRespuesta' => $idrespuesta,
            ':asunto' => $asunto,
            ':descripcion' => $descripcion,
            ':nombreadjunto' => $filename,
            ':edAutor' => $edautor));
    }

    function updateresF($idrespuesta,$asunto,$descripcion,$edautor) {
    $pdo = new PDO('mysql:host=localhost;dbname=sistemaoa;charset=utf8', 'root','');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CALL modRespF(:idRespuesta, :asunto, :descripcion,:edAutor)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':idRespuesta' => $idrespuesta,
            ':asunto' => $asunto,
            ':descripcion' => $descripcion,
            ':edAutor' => $edautor));
    }
