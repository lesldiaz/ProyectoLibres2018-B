<?php 
// MySQL database connection code

require_once "pdo.php";
$lstResultado= array();
$sql="select nombre, descargas from objetoaprendizaje ORDER BY descargas DESC LIMIT 5";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$i = 0;
while ($row = $stmt->fetch()){
	$objeto = $row['nombre'];
	$promedio = $row['descargas'];
	$lstResultado['cols'][] = array('type' => 'string'); 
    $lstResultado['rows'][] = array('c' => array( array('v'=> $objeto), array('v'=>(float)$promedio)) );
    array_push($lstResultado, $row);
}
$data = json_encode($lstResultado);
echo $data;


?>