<?php
    require_once "pdo.php";
    require_once "correoForo.php";
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

      $sql = "CALL datosAutor(:idForo)";
      $stmt = $pdo->prepare($sql);
      $stmt->execute(array(
          ':idForo' => $idforo));
      $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach ($arr as $row) {
        $correo =$row["correo"];
        $autorF=$row["persona"];
        $nomforo=$row["asunto"]; }
        $fecha=time() - (6 * 60 * 60);
        $fechaRestada=date('H:i:s - d/m/Y',$fecha);
    //necesito correo autor foro, nombre autor foro, nombre foro, fecha de grabado de respuesta.
      enviarcorreoRespuesta($autorF,$correo,$nomforo, $autor, $descripcion, $fechaRestada);
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
