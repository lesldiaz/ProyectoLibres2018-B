<?php
/**
 * Created by PhpStorm.
 * User: mjg70
 * Date: 23/7/2018
 * Time: 23:28
 */
require_once "pdo.php";
$lstResultado= array();
$sql="CALL cargarPuntuacion()";
$stmt = $pdo->prepare($sql);
$stmt->execute();
while ($row = $stmt->fetch()){
    array_push($lstResultado, $row);
}
echo json_encode($lstResultado);

?>

