<?php
require_once "pdo.php";

$nombre = $_FILES['imagen']['name'];
$nombrer = strtolower($nombre);
$cd=$_FILES['imagen']['tmp_name'];
$ruta = "img/" . $_FILES['imagen']['name'];
$destino = "img/".$nombrer;
$resultado = @move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta);
$variable=$_POST['nombre'];

if (!empty($resultado)){

    /*$sql ="INSERT INTO imagen(rutaImagen) VALUES (:ruta)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':ruta' => $destino));*/
    echo "el archivo ha sido movido exitosamente";
    echo $variable;
    echo $destino;

}else{

    echo "Error al subir el archivo";

}
?>