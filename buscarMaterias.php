<?php
/**
 * Created by Grupo 6 Proyecto Libres.
 * User: mjg70
 * Date: 21/7/2018
 * Time: 23:03
 */

//Gestion de objetos de aprendizajee — >
require_once "pdo.php";
$nombreMateria=$_POST['nombreMateria'];
$lstMaterias=array();
$sql="CALL consultarMat(:nameMateria)";
$stmt = $pdo->prepare($sql);
$stmt->execute(array(':nameMateria' => $nombreMateria));
while ($row = $stmt->fetch()){
    array_push($lstMaterias, $row);
}
echo json_encode($lstMaterias);

?>
