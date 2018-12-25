<?php
    require_once "pdo.php";
    session_start();
    $sql = "CALL borrarForo(:idForo)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':idForo' => $_GET["idForo"]));
    header("Location: misForos.php");
