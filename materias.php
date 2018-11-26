<?php
/**
 * Created by PhpStorm.
 * User: mjg70
 * Date: 21/7/2018
 * Time: 16:19
 */

    require_once "pdo.php";
    $nombreCarrera=$_POST['nombreCarrera'];
    $lstMaterias= array();
    $sql="CALL consultarMaterias(:nameCarrera)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':nameCarrera' => $nombreCarrera));
    while ($row = $stmt->fetch()){
        array_push($lstMaterias, $row);
    }
    echo json_encode($lstMaterias);

?>


