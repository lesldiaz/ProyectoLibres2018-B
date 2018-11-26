<?php
   ## method to file upload in db
    require_once "pdo.php";
    session_start();

    $fileName = $_FILES["file1"]["name"]; // The file name
    $fileTmpLoc = $_FILES["file1"]["tmp_name"]; // File in the PHP tmp folder
    $fileType = $_FILES["file1"]["type"]; // The type of file it is
    $fileSize = $_FILES["file1"]["size"]; // File size in bytes
    $fileErrorMsg = $_FILES["file1"]["error"]; // 0 for false... and 1 for true

    if (!$fileTmpLoc) { // if file not chosen
        echo "ERROR: Please browse for a file before clicking the upload button.";
        exit();
    }

    if(move_uploaded_file($fileTmpLoc, "zip/$fileName")){
        echo "$fileName upload is complete";
        $sql = "INSERT INTO objetoaprendizaje (nombre, autor, descripcion, fecha, p_clave, institucion, tamano, tipo, ruta_zip, idProfesor)
                VALUES (:nombre, :autor, :descripcion, :fecha, :p_clave, :institucion, :fileSize, :tipo, :ruta_zip, :idProfesor)";
        $stmt = $pdo->prepare($sql);
        $size = $fileSize . ' bytes';
        $tipo = 'WinRAR ZIP';
        $stmt->execute(array(
            ':nombre' => $_POST["nombreOA"],
            ':autor' => $_POST["autorOA"],
            ':descripcion' => $_POST["descripcion"],
            ':fecha' => $_POST["fechaCreacionOA"],
            ':p_clave' => $_POST["palabraClaveOA"],
            ':institucion' => $_POST["institucionOA"],
            ':fileSize' => $size,
            ':tipo' => $tipo,
            ':ruta_zip' => $fileName,
            ':idProfesor' => $_SESSION['userID']));
    } else {
        echo "move_uploaded_file function failed";
    }
?>
