<?php
    require_once "pdo.php";
    function insertOA($nombre,$autor,$descripcion,$fecha,$pclave,$institucion,$tamanio,$tipo,$fechaing,$rutazip,$idautor,$fileSize) {
		$pdo = new PDO('mysql:host=localhost;dbname=sistemaoa;charset=utf8', 'root','');
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO objetoaprendizaje (nombre, autor, descripcion, fecha, p_clave, institucion, tamano, tipo, fecha_ing, ruta_zip, idAutor)
            VALUES (:nombre, :autor, :descripcion, :fecha, :p_clave, :institucion, :fileSize, :tipo, :fecha_ing,:ruta_zip, :idAutor)";
    $stmt = $pdo->prepare($sql);
    $size = $fileSize . ' bytes';
    $tipo = 'WinRAR ZIP';
$prueba = "zip/"+$fileName;

    $stmt->execute(array(
        ':nombre' => $nombre,
        ':autor' => $autor,
        ':descripcion' => $descripcion,
        ':fecha' => $fecha,
        ':p_clave' => $pclave,
        ':institucion' => $institucion,
        ':fileSize' => $size,
        ':tipo' => $tipo,
        ':fecha_ing' => "2018/10/01",
        ':ruta_zip' => $fileName,
        ':idAutor' => $_SESSION['userID']));
    }
