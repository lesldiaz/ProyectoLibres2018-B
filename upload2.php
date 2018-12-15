<?php
    require_once "pdo.php";
    include_once "regTema.php";
    session_start();
	$ejemplo='foroimg/';
    $fileName = $ejemplo.$_FILES["file1"]["name"]; // The file name
    $fileTmpLoc = $_FILES["file1"]["tmp_name"]; // File in the PHP tmp folder
    $fileType = $_FILES["file1"]["type"]; // The type of file it is
    $fileSize = $_FILES["file1"]["size"]; // File size in bytes
    $fileErrorMsg = $_FILES["file1"]["error"]; // 0 for false... and 1 for true

    if (!$fileTmpLoc) { // if file not chosen
        echo "ERROR: Please browse for a file before clicking the upload button.";
        insertema($_POST["nombreOA"],$_POST["descripcion"],$_POST["autorOA"],$_SESSION['userType'],$_POST["fechaCreacionOA"],'');
        exit();
    }

    if(move_uploaded_file($fileTmpLoc,$fileName)){
        echo "sucessful";
        insertema($_POST["nombreOA"],$_POST["descripcion"],$_POST["autorOA"],$_SESSION['userType'],$_POST["fechaCreacionOA"],$fileName);

    } else {
        echo "move_uploaded_file function failed";
    }
?>
