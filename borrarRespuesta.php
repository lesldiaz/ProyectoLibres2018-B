<?php
    require_once "pdo.php";
    session_start();
    $sql = "SELECT nombreadjunto from resforo where idRespuesta= :idRespuesta";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':idRespuesta' => $_GET["idRespuesta"]));
    foreach ($stmt as $row) {
        if ($row["nombreadjunto"]!= ''){
          $dir = "foroimg/respimg/";
          $dir.= $row["nombreadjunto"];
          unlink($dir);
        }
    }
    $sql = "CALL borrarResp(:idRespuesta)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':idRespuesta' => $_GET["idRespuesta"]));
    $loc="Location: foroActual.php?foroID=";
    $loc.=$_GET['idForo'];
    header($loc);
