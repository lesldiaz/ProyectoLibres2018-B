<?php
    require_once "pdo.php";
    function insertema($nombre,$descripcion,$autor,$userType,$filename) {
		$pdo = new PDO('mysql:host=localhost;dbname=sistemaoa;charset=utf8', 'root','');
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "CALL insertarTemaDis(:nombre, :descripcion, :autor, :userType, :ruta)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':nombre' => $nombre,
            ':descripcion' => $descripcion,
            ':autor' => $autor,
            ':userType' => $userType,
            ':ruta' => $filename));
    }

    function updatema($idforo,$asunto,$descripcion,$filename) {
		$pdo = new PDO('mysql:host=localhost;dbname=sistemaoa;charset=utf8', 'root','');
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "CALL modForo(:idForo, :asunto, :descripcion, :nombreadjunto)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':idForo' => $idforo,
            ':asunto' => $asunto,
            ':descripcion' => $descripcion,
            ':nombreadjunto' => $filename));
    }
    function updatemaF($idforo,$asunto,$descripcion) {
		$pdo = new PDO('mysql:host=localhost;dbname=sistemaoa;charset=utf8', 'root','');
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "CALL modForoF(:idForo, :asunto, :descripcion)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':idForo' => $idforo,
            ':asunto' => $asunto,
            ':descripcion' => $descripcion));
    }
