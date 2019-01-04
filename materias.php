<?php
    require_once "pdo.php";
    $nombreCarrera=$_POST['nombreCarrera'];
    $lstMaterias= array();               // <array para la lista de materias-->
    $sql="CALL consultarMaterias(:nameCarrera)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':nameCarrera' => $nombreCarrera)); 
    while ($row = $stmt->fetch()){    
        array_push($lstMaterias, $row);
    }
    echo json_encode($lstMaterias);

?>


