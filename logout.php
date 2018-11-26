<?php
    require_once "pdo.php";
    require_once "delete_files.php";

    session_start();
    $target = 'oa/' . $_SESSION["userID"] . '-' . $_SESSION["userType"] . '/';
    delete_files($target);
    $sql = "DELETE FROM rutaoa WHERE idUser = :idUser AND username = :userName";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array('idUser' => $_SESSION["userID"], 'userName' => $_SESSION["userName"]));
    session_destroy();
    header("Location: index.php");
