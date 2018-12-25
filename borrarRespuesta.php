<?php
    require_once "pdo.php";
    session_start();
    $sql = "CALL borrarResp(:idRespuesta)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':idRespuesta' => $_GET["idRespuesta"]));
    $loc="Location: foroActual.php?foroID=";
    $loc.=$_GET['idForo'];
    header($loc);
