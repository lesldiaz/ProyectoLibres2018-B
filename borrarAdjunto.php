<?php
    require_once "pdo.php";
    session_start();
    $sql = "CALL borrarAdjF(:idForo)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':idForo' => $_GET["idForo"]));
    $dir = "foroimg/";
    $dir.= $_GET["nombre"];
     unlink($dir);
     header("Location: editarTema.php?id=".$_GET["idForo"]."");
     echo '<script> Borrado exitoso </script>';
?>
