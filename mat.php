<?php
/**
 * Created by PhpStorm.
 * User: mjg70
 * Date: 21/7/2018
 * Time: 23:03
 */
require_once "pdo.php";
$lstMaterias=array();
$sql="CALL cMat()";
$stmt = $pdo->prepare($sql);
$stmt->execute());
while ($row = $stmt->fetch()){
    array_push($lstMaterias, $row);
}
echo json_encode($lstMaterias);

?>