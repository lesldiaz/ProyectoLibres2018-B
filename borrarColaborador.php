<?php
    require_once "pdo.php";
    session_start();
    if ($_SESSION["idColaborador"]!=0){
    $sql = "SELECT adjFoto from colaborador where idColaborador= :idC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':idC' => $_SESSION["idColaborador"]));
    foreach ($stmt as $row) {
        if ($row["adjFoto"]!= ''){
          $dir = "fotoperfil/";
          $dir.= $row["adjFoto"];
          unlink($dir);
        }
    }
    $sql = "CALL borrarColaborador(:idColaborador)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':idColaborador' => $_SESSION["idColaborador"]));
    $_SESSION["idColaborador"]=0;
    $_SESSION["isColab"]="NO";
    header("Location: index.php");
  }
