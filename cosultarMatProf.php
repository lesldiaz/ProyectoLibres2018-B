<?php
/**
 * Created by PhpStorm.
 * User: mjg70
 * Date: 21/7/2018
 * Time: 23:03
 */
require_once "pdo.php";
$idMat=$_POST['idMat'];
$lstMaterias=array();
$sql="CALL consultarMatProf(:idMat)";
$stmt = $pdo->prepare($sql);
$stmt->execute(array(':idMat' => $idMat));
while ($row = $stmt->fetch()){
    array_push($lstMaterias, $row);
}
echo json_encode($lstMaterias);

?>