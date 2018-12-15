<?php
    require_once "pdo.php";
    function insertema($nombre,$descripcion,$autor,$userType,$fecha,$filename) {
		$pdo = new PDO('mysql:host=localhost;dbname=sistemaoa;charset=utf8', 'root','');
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "CALL insertarTemaDis(:nombre, :descripcion, :autor, :userType, :fecha, :ruta)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':nombre' => $nombre,
            ':descripcion' => $descripcion,
            ':autor' => $autor,
            ':userType' => $userType,
            ':fecha' => $fecha,
            ':ruta' => $fileName));
    }
