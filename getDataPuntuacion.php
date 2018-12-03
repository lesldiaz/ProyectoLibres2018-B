<?php 
// MySQL database connection code

require_once "pdo.php";
$lstResultado= array();
$sql="select o.nombre, AVG(p.calificacionObjeto) as promedio from puntuacion p, objetoaprendizaje o where o.idOA=p.idObjetosAprendizaje GROUP BY p.idObjetosAprendizaje;";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$i = 0;
while ($row = $stmt->fetch()){
	$objeto = $row['nombre'];
	$promedio = $row['promedio'];
	$lstResultado['cols'][] = array('type' => 'string'); 
    $lstResultado['rows'][] = array('c' => array( array('v'=> $objeto), array('v'=>(float)$promedio)) );
    array_push($lstResultado, $row);
}
$data = json_encode($lstResultado);
echo $data;


?>