<?php
    require_once "pdo.php";
    session_start();
    $sql = "SELECT nombreadjunto from foro where idForo= :idForo";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':idForo' => $_GET["idForo"]));
    foreach ($stmt as $row) {
        if ($row["nombreadjunto"]!= ''){
          $dir = "foroimg/";
          $dir.= $row["nombreadjunto"];
          unlink($dir);
        }
    }
    $sql = "CALL borrarForo(:idForo)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':idForo' => $_GET["idForo"]));
    header("Location: misForos.php");
