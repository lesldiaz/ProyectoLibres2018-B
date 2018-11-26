<?php
/**
 * Created by PhpStorm.
 * User: mjg70
 * Date: 24/7/2018
 * Time: 14:42
 */
require_once "pdo.php";
$idDescarga=$_POST["idDescargas"];
$lstResultado= array();
$sql="CALL insertarDescarga(:idDescargar)";
$stmt = $pdo->prepare($sql);
$stmt->execute(array(':idDescargar' => $idDescarga));
while ($row = $stmt->fetch()){
    array_push($lstResultado, $row);
}
echo json_encode($lstResultado);

?>