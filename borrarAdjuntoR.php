<?php
    require_once "pdo.php";
    session_start();
    $sql = "CALL borrarAdjFR(:idRespuesta)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':idRespuesta' => $_GET["idRespuesta"]));
    $dir = "foroimg/respimg/";
    $dir.= $_GET["nombre"];
     unlink($dir);
     header("Location: editarRespuesta.php?id=".$_GET["idRespuesta"]."");
     echo '<script> Borrado exitoso </script>';
?>
