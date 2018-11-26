<?php
/**
 * Created by PhpStorm.
 * User: mjg70
 * Date: 10/6/2018
 * Time: 16:56
 */
include 'config.php';  //include the DB config file
//Retrieve form data.
$nombre=$_POST['nombre'];
$autor=$_POST['autor'];
$descripcion=$_POST['descripcion'];
$fecha=$_POST['fecha'];
$p_clave=$_POST['p_clave'];
$institucion=$_POST['institucion'];
$tamano=$_POST['tamano'];
$tipo=$_POST['tipo'];
$ruta_zip=$_POST['ruta_zip'];
$idProfesor=$_POST['idProfesor'];

$sql= "INSERT INTO objetosaprendizaje (nombre, autor, descripcion, fecha, p_clave, institucion, tamano, tipo, ruta_zip, idProfesor) 
VALUES('$nombre','$autor','$descripcion','$fecha','$p_clave', '$institucion', '$tamano', '$tipo', '$ruta_zip', '$idProfesor') ";
if ($mysqli->query($sql) === TRUE) {
    echo "1";
}
else
{
    echo "0";
}

?>