<?php
/**
 * Created by PhpStorm.
 * User: mjg70
 * Date: 23/7/2018
 * Time: 22:38
 */
$idObjeto=$_POST['idObjetoAprendizaje'];
$puntuacion=$_POST['puntuacion'];
$idUser=$_POST['idUsuario'];

require_once "pdo.php";
$lstResultado= array();
$sql="CALL insertarCalificacion(:idObjetoAprendizaje, :valorObjeto, :idUsuario)";
$stmt = $pdo->prepare($sql);
$stmt->execute(array(':idObjetoAprendizaje' => $idObjeto,
    ':valorObjeto' => $puntuacion,
    ':idUsuario' => $idUser));
while ($row = $stmt->fetch()){
    array_push($lstResultado, $row);
}
echo json_encode($lstResultado);

?>

