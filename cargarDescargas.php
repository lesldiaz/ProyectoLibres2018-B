<?php
/**
 * Created by PhpStorm.
 * User: mjg70
 * Date: 24/7/2018
 * Time: 15:45
 */
require_once "pdo.php";
$lstResultado= array();
$sql="CALL cargarObj()";
$stmt = $pdo->prepare($sql);
$stmt->execute();
while ($row = $stmt->fetch()){
    array_push($lstResultado, $row);
}
echo json_encode($lstResultado);

?>