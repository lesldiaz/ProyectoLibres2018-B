<?php
    require_once "pdo.php";
    session_start();
	$ejemplo='zip/';
    $fileName = $ejemplo.$_FILES["file1"]["name"]; // The file name
    $fileTmpLoc = $_FILES["file1"]["tmp_name"]; // File in the PHP tmp folder
    $fileType = $_FILES["file1"]["type"]; // The type of file it is
    $fileSize = $_FILES["file1"]["size"]; // File size in bytes
    $fileErrorMsg = $_FILES["file1"]["error"]; // 0 for false... and 1 for true

    if (!$fileTmpLoc) { // if file not chosen
        echo "ERROR: Please browse for a file before clicking the upload button.";
        exit();
    }

    if(move_uploaded_file($fileTmpLoc,$fileName)){
        echo "$fileName upload is complete";
        $sql = "INSERT INTO objetoaprendizaje (nombre, autor, descripcion, fecha, p_clave, institucion, tamano, tipo, fecha_ing, ruta_zip, idAutor)
                VALUES (:nombre, :autor, :descripcion, :fecha, :p_clave, :institucion, :fileSize, :tipo, :fecha_ing,:ruta_zip, :idAutor)";
        $stmt = $pdo->prepare($sql);
        $size = $fileSize . ' bytes';
        $tipo = 'WinRAR ZIP';
		$prueba = "zip/"+$fileName;
		
        $stmt->execute(array(
            ':nombre' => $_POST["nombreOA"],
            ':autor' => $_POST["autorOA"],
            ':descripcion' => $_POST["descripcion"],
            ':fecha' => $_POST["fechaCreacionOA"],
            ':p_clave' => $_POST["palabraClaveOA"],
            ':institucion' => $_POST["institucionOA"],
            ':fileSize' => $size,
            ':tipo' => $tipo,
			':fecha_ing' => "2018/10/01",
            ':ruta_zip' => $fileName,
            ':idAutor' => $_SESSION['userID']));
		
		
    } else {
        echo "move_uploaded_file function failed";
    }
?>
