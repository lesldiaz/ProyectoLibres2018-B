<?php
    require_once "pdo.php";
    require_once "delete_files.php";

	//eliminar objetoaprendizaje de aprendizaje
	
    function deleteOA($filename, $idOA) {
        $name = basename($filename,".zip");
        $target = 'oa/' . $name . '/';
        delete_files($target);
    
        $dirZip = 'zip/' . $filename;
        unlink($dirZip);
		
		$pdo = new PDO('mysql:host=localhost;dbname=sistemaoa;charset=utf8', 'root','');
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			
		$sql = "DELETE FROM puntuacion WHERE idObjetosAprendizaje = :idOA";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(':idOA' => $idOA));
		
		$sql = "DELETE FROM objetoaprendizaje WHERE idOA = :idOA";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(':idOA' => $idOA));
		
		//eliminar comentario
        $sql = "DELETE FROM comentario WHERE idOA = :idOA";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(':idOA' => $idOA));
    }
