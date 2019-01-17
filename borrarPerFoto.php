<?php
    require_once "pdo.php";
    session_start();
    $sql = "CALL borrarPerfilF(:idColab)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':idColab' => $_SESSION["idColaborador"]));
    $dir = "fotoperfil/";
    $dir.= $_GET["adjFoto"];
    unlink($dir);
    header("Location: datosColab.php");
    echo '<script> Borrado exitoso </script>';
?>
